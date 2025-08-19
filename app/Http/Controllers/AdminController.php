<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Deposit;
use App\Models\Transaction;
use App\Models\Withdrawal;
use App\Models\InvestmentPlan;
use App\Models\UserLockedPlan;
use App\Models\DepositWallet;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\WalletSetting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Mail\KYCApprovedNotification;
use App\Mail\KYCRejectedNotification;
use Illuminate\Support\Facades\Mail;
use Log;

class AdminController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;
    public function __construct()
    {
       // $this->middleware(['auth', 'verified']);
       // $this->middleware('role:admin');
    }

    public function index(Request $request)
    {
        $query = User::whereNotNull('id_front_path')
                    ->orderBy('kyc_submitted_at', 'desc');
        
        if ($request->filled('status')) {
            $query->where('kyc_status', $request->status);
        }
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
            });
        }
        
        if ($request->filled('user_id')) {
            $query->where('id', $request->user_id);
        }
        
        $users = $query->paginate(15);
        
        return view('admin.users.kyc', compact('users'));
    }
    
    public function approve($userId)
    {

        // dd($userId);
        $user = User::findOrFail($userId);

        // dd($user);
        try{

            $user->kyc_status = 'approved'; 
            $user->kyc_verified_at = now();
            // Exact case match from ENUM definition
            $user->save(); // More reliable for ENUM updates
           
        }catch(Exception $e){
            dd($e->getMessage);
        }
        
        // Mail::to($user->email)->send(new KYCApprovedNotification($user));
        // dd($user->fresh());
    
    return back()->with('success', 'KYC approved successfully');
       
       
        // Send approval notification
        
    }
    
    public function reject(Request $request, $userId)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);
        
        $user = User::findOrFail($userId);
        
        $user->update([
            'kyc_status' => 'rejected',
            'kyc_rejection_reason' => $request->rejection_reason,
        ]);
        
        // Send rejection notification
        Mail::to($user->email)->send(new KYCRejectedNotification($user, $request->rejection_reason));
        
        return back()->with('success', 'KYC rejected successfully');
    }

    public function dashboard()
    {
        $stats = [
            'users' => User::count(),
            'deposits' => Deposit::count(),
          
            'active_plans' => UserLockedPlan::where('status', 'active')->count(),
            'pending_deposits' => Deposit::where('status', 'pending')->count(),
          
            'total_deposits' => Deposit::sum('amount'),
            'withdrawals' => Transaction::where('type', 'withdrawal')->count(),
'pending_withdrawals' => Transaction::where('type', 'withdrawal')->where('status', 'pending')->count(),
'total_withdrawals' => Transaction::where('type', 'withdrawal')->sum('amount'),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function users()
    {
        $users = User::with('roles')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function editUser(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function updateUser(Request $request, User $user)
    {

        // dd($user);
        $request->validate([
            'name' => 'required|string|max:255',
            // 'balance_usd'=>'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            // 'roles' => 'required',
        ]);

        try {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->balance_usd = number_format((float)$request->balance_usd, 2, '.', '');
            $user->save();
            
            $user->syncRoles($request->roles);
        
            return redirect()->route('admin.users')->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error updating user: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            // You can also dump the error to the screen temporarily for debugging
            // dd($e->getMessage(), $e->getTrace());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error updating user: ' . $e->getMessage());
        }
    }

    public function deposits()
    {
        $deposits = Deposit::with('user')->latest()->paginate(10);
        return view('admin.deposits.index', compact('deposits'));
    }

    public function updateDepositStatus(Request $request, Deposit $deposit)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,rejected',
        ]);

        $deposit->update(['status' => $request->status]);

        if ($request->status === 'completed') {
            $deposit->user->increment('balance_usd', $deposit->amount);
        }

        return back()->with('success', 'Deposit status updated');
    }

    public function withdrawals()
    {
        $withdrawals = Withdrawal::orderBy('ID','DESC')->with('user')
                        ->latest()
                        ->paginate(10);
        return view('admin.withdrawals.index', compact('withdrawals'));
    }

    public function updateWithdrawalStatus(Request $request, Transaction $withdrawal)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,rejected',
        ]);

        $withdrawal->update(['status' => $request->status]);

        return back()->with('success', 'Withdrawal status updated');
    }

    public function investmentPlans()
    {
        $plans = InvestmentPlan::latest()->paginate(10);
        return view('admin.plans.index', compact('plans'));
    }

    public function createPlan()
    {
        return view('admin.plans.create');
    }

    public function storePlan(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:investment_plans,slug',
            'min_amount' => 'required|numeric|min:0',
            'yield_percentage' => 'required|numeric|min:0',
            'penalty_percentage' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'apy' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        InvestmentPlan::create($request->all());

        return redirect()->route('admin.plans')->with('success', 'Plan created successfully');
    }

    public function editPlan(InvestmentPlan $plan)
    {
        return view('admin.plans.edit', compact('plan'));
    }

    public function updatePlan(Request $request, InvestmentPlan $plan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:investment_plans,slug,'.$plan->id,
            'min_amount' => 'required|numeric|min:0',
            'yield_percentage' => 'required|numeric|min:0',
            'penalty_percentage' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'apy' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $plan->update($request->all());

        return redirect()->route('admin.plans')->with('success', 'Plan updated successfully');
    }

    public function activeInvestments()
    {
        $investments = UserLockedPlan::with(['user', 'plan'])
                        ->latest()
                        ->paginate(10);
        return view('admin.investments.index', compact('investments'));
    }

    // User Management
public function createUser()
{
    $roles = Role::all();
    return view('admin.users.create', compact('roles'));
}

// Transactions
public function transactions()
{
    $transactions = Transaction::with('user')->latest()->paginate(25);
    return view('admin.transactions.index', compact('transactions'));
}

// Reports
public function reports()
{
    // Add your report data logic here
    return view('admin.reports');
}


public function storeUser(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'roles' => 'required|array',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    $user->assignRole($request->roles);

    return redirect()->route('admin.users')->with('success', 'User created successfully');
}
public function settings()
{
    $wallets = WalletSetting::all();
    return view('admin.settings.wallets', compact('wallets'));
}



public function toggleWalletStatus($id)
{
    $wallet = WalletSetting::findOrFail($id);
    $wallet->update(['is_active' => !$wallet->is_active]);

    return back()->with('success', 'Wallet status updated');
}
public function walletSettings()
{
    $wallets = DepositWallet::all();
    return view('admin.settings.wallet', compact('wallets'));
}

public function storeWallet(Request $request)
{
    $request->validate([
        'wallet_address' => 'required|string|max:255|unique:deposit_wallets',
        'network' => 'required|string|in:TRC20,ERC20,BEP20'
    ]);

    // Deactivate all other wallets first
    DepositWallet::query()->update(['is_active' => false]);

    // Create new active wallet
    DepositWallet::create([
        'wallet_address' => $request->wallet_address,
        'network' => $request->network,
        'is_active' => true
    ]);

    return back()->with('success', 'Wallet address updated successfully');
}

}