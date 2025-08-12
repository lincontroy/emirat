<?php

// app/Http/Controllers/DepositController.php
namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DepositController extends Controller
{
    public function index(){
        return view('deposit');
    }
    public function create()
    {
        // Generate a unique wallet address for the user
        $walletAddress = 'USDT-' . Str::upper(Str::random(8)) . '-' . Auth::id();
        
        return view('deposit', [
            'walletAddress' => $walletAddress
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:10',
            'source' => 'required|string'
        ]);

        // Create deposit
        $deposit = Deposit::create([
            'user_id' => Auth::id(),
            'wallet_address' => $request->wallet_address,
            'amount' => $validated['amount'],
            'currency' => 'USDT',
            'status' => 'pending',
            'source' => $validated['source'],
            'metadata' => [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]
        ]);

        // Create associated transaction
        $deposit->transaction()->create([
            'user_id' => Auth::id(),
            'type' => 'deposit',
            'amount' => $validated['amount'],
            'currency' => 'USDT',
            'status' => 'pending',
            'notes' => 'Deposit initiated from ' . $validated['source']
        ]);

        return redirect()->route('deposit.confirmation', $deposit);
    }

    public function confirmation(Deposit $deposit)
    {
        return view('deposit-confirmation', compact('deposit'));
    }

    // Webhook for blockchain confirmation
    public function webhook(Request $request)
    {
        // Validate webhook signature
        // Process blockchain confirmation
        // Update deposit and transaction status
    }
}