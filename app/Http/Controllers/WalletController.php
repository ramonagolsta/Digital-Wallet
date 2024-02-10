<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $wallets = $user->wallets; // This assumes you have defined the relationship in your User model.

        return view('wallets.index', compact('wallets'));
    }

    public function create()
    {
        return view('wallets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
        ]);

        info('Request Data:', $request->all());

        $wallet = Auth::user()->wallets()->create([
            'name' => $request->input('name'),
            'amount' => $request->input('amount'),
        ]);

        info('Wallet created:', $wallet->toArray());

        session()->flash('success', 'Wallet created successfully!');

        return redirect()->route('wallets.index');
    }



    public function show(Wallet $wallet)
    {
        // Ensure the requested wallet belongs to the authenticated user
        abort_if($wallet->user_id !== Auth::id(), 403);

        return view('wallets.show', compact('wallet'));
    }

    public function edit(Wallet $wallet)
    {
        // Ensure the requested wallet belongs to the authenticated user
        abort_if($wallet->user_id !== Auth::id(), 403);

        //session()->flash('success', 'Wallet updated successfully!');

        return view('wallets.edit', compact('wallet'));
    }

    public function update(Request $request, Wallet $wallet)
    {
        // Ensure the requested wallet belongs to the authenticated user
        abort_if($wallet->user_id !== Auth::id(), 403);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $wallet->update($request->only('name'));

        session()->flash('success', 'Wallet updated successfully!');

        return redirect()->route('wallets.show', $wallet);
    }

    public function destroy(Wallet $wallet)
    {
        // Ensure the requested wallet belongs to the authenticated user
        abort_if($wallet->user_id !== Auth::id(), 403);

        $wallet->delete();

        return redirect()->route('wallets.index');
    }
}
