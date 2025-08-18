<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Deposit;
use App\Models\Transaction;
use App\Models\Withdrawal;
use App\Models\InvestmentPlan;
use App\Models\UserLockedPlan;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
class AdminController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;
    public function __construct()
    {
       // $this->middleware(['auth', 'verified']);
       // $this->middleware('role:admin');
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'roles' => 'required|array',
        ]);

        $user->update($request->only(['name', 'email']));
        $user->syncRoles($request->roles);

        return redirect()->route('admin.users')->with('success', 'User updated successfully');
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
        $withdrawals = Transaction::where('type', 'withdrawal')
                        ->with('user')
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

// Settings
public function settings()
{
    return view('admin.settings');
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
}