<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class WithdrawalController extends Controller
{

    public function showform(){
        return view('withdrawals');
    }
    public function processWithdrawal(Request $request)
    {

        // dd($request);
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1|max:' . auth()->user()->balance_usd,
            'destination' => 'required',
            'bank_name' => 'required_if:destination,bank',
            'account_number' => 'required_if:destination,bank',
            'mpesa_phone' => 'required_if:destination,mpesa|regex:/^[17]\d{8}$/',
            'wallet_address' => 'required_if:destination,crypto',
            'network' => 'required_if:destination,crypto|in:ethereum,bitcoin,TRC20,binance',
            'notes' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        
        try {
            $user = auth()->user();
            $amount = $validated['amount'];
            
            // Check if user has sufficient balance
            if ($user->balance_usd < $amount) {
                return back()->withErrors(['amount' => 'Insufficient balance'])->withInput();
            }
            
            // Deduct from balance
            $user->decrement('balance_usd', $amount);
            
            // Create withdrawal transaction
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'type' => 'withdrawal',
                'amount' => $amount,
                'status' => 'pending',
                'method' => $validated['destination'],
                'details' => $this->getWithdrawalDetails($validated),
                'reference' => 'WD-' . strtoupper(uniqid()),
            ]);
            
            // Process the withdrawal based on method
            $processed = $this->processWithdrawalByMethod($transaction);

            // dd($processed);
            
            if (true) {
                DB::commit();
                return redirect()->route('transactions')
                    ->with('success', 'Withdrawal request submitted successfully');
            } else {
                DB::rollBack();
                return back()->withErrors(['error' => 'Withdrawal processing failed'])->withInput();
            }
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Withdrawal error: ' . $e->getMessage());
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
    
    private function getWithdrawalDetails(array $data): array
    {
        $details = [];
        
        switch ($data['destination']) {
            case 'bank':
                $details = [
                    'bank_name' => $data['bank_name'],
                    'account_number' => $data['account_number'],
                ];
                break;
                
            case 'mpesa':
                $details = [
                    'phone' => $data['mpesa_phone'],
                ];
                break;
                
            case 'crypto':
                $details = [
                    'wallet_address' => $data['wallet_address'],
                    'network' => $data['network'],
                ];
                break;
        }
        
        if (!empty($data['notes'])) {
            $details['notes'] = $data['notes'];
        }
        
        return $details;
    }
    
    private function processWithdrawalByMethod(Transaction $transaction): bool
    {

        
        $transaction->method="crypto";

        // dd($transaction->method);
        try {
            switch ($transaction->method) {
                case 'mpesa':
                    return $this->processMpesaWithdrawal($transaction);
                    
                case 'bank':
                    return $this->processBankWithdrawal($transaction);
                    
                case 'crypto':
                    // dd($transaction);
                    return $this->processCryptoWithdrawal($transaction);
                    
                default:
                    return false;
            }
        } catch (\Exception $e) {
            Log::error("Withdrawal processing failed: " . $e->getMessage());
            return false;
        }
    }
    
    private function processMpesaWithdrawal(Transaction $transaction): bool
    {
        // Implement MPESA API integration here
        // This is a mock implementation
        
        $phone = $transaction->details['phone'];
        $amount = $transaction->amount;
        
        try {
            // Simulate MPESA API call
            // $response = MpesaService::sendSTKPush($phone, $amount);
            
            // For demo purposes, we'll assume success
            $transaction->update([
                'status' => 'processing',
                'external_reference' => 'MPESA' . time(),
            ]);
            
            return true;
            
        } catch (\Exception $e) {
            Log::error("MPESA withdrawal failed: " . $e->getMessage());
            return false;
        }
    }
    
    private function processBankWithdrawal(Transaction $transaction): bool
    {
        // Implement bank transfer processing
        $transaction->update([
            'status' => 'processing',
            'external_reference' => 'BANK' . time(),
        ]);
        
        return true;
    }
    
    private function processCryptoWithdrawal(Transaction $transaction): bool
    {
        // dd($transaction);
        // Implement crypto withdrawal processing
        $transaction->update([
            'status' => 'pending',
        ]);
        
        return true;
    }
}
