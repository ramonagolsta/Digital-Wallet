<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return view('transactions.index');
    }

    /**public function create(Wallet $wallet)
    {
        $wallets = Wallet::where('user_id', auth()->id())->get(); // Adjust the condition based on your logic
        return view('transactions.create', compact('wallet', 'wallets'));
    }*/
    public function create(Wallet $wallet)
    {
        // Get all wallets except the current wallet
        $wallets = Wallet::where('user_id', '!=', auth()->id())->get();

        session()->flash('success', 'Transaction created successfully!');

        return view('transactions.create', compact('wallet', 'wallets'));
    }

    public function store(Request $request, Wallet $wallet)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'destination_wallet_id' => 'required|exists:wallets,id',
        ]);

        info('Request Data:', $request->all());

        // Check if the wallet has sufficient funds
        if ($wallet->amount < $request->input('amount')) {
            // If not, redirect back with an error message
            return redirect()->back()->with('error', 'Insufficient funds in the wallet to make this transaction.');
        }

        // Create a new transaction with the provided data
        $transaction = new Transaction([
            'description' => $request->input('description'),
            'amount' => $request->input('amount'),
        ]);

        $transaction->wallet()->associate($wallet);
        $transaction->destinationWallet()->associate($request->input('destination_wallet_id'));
        $transaction->save();

        info('Transaction created:', $transaction->toArray());

        // Update wallet amounts
        $wallet->amount -= $request->input('amount');
        $wallet->save();

        $destinationWallet = Wallet::find($request->input('destination_wallet_id'));
        $destinationWallet->amount += $request->input('amount');
        $destinationWallet->save();

        session()->flash('success', 'Transaction created successfully!');
        session()->flash('error', 'You do not have enough funds in your wallet');

        return redirect()->route('wallets.show', $wallet);
    }



    public function edit(Wallet $wallet, Transaction $transaction)
    {
        return view('transactions.edit', compact('wallet', 'transaction'));
    }

    public function update(Request $request, Wallet $wallet, Transaction $transaction)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'is_fraudulent' => 'boolean',
        ]);

        $transaction->update($request->only('description', 'amount', 'is_fraudulent'));

        return redirect()->route('wallets.show', $wallet);
    }

    public function destroy(Wallet $wallet, Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('wallets.show', $wallet);
    }

    public function markFraudulent(Transaction $transaction)
    {
        // Assuming you have an 'is_fraudulent' column in the transactions table
        $transaction->update(['is_fraudulent' => true]);

        // You may redirect back to the wallet's transactions page or any other route
        return redirect()->back()->with('success', 'Transaction marked as fraudulent successfully.');
    }
}
