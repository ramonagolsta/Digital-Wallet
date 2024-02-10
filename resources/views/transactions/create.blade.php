<!-- resources/views/transactions/create.blade.php -->
@if(session('error'))
    <div class="alert alert-danger mt-3">
        {{ session('error') }}
    </div>
@endif
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Transaction to {{ $wallet->name }} Wallet
        </h2>
    </x-slot>

    <div class="container">

        <form action="{{ route('wallets.transactions.store', $wallet) }}" method="POST">
            @csrf
            <label for="description">Description:</label>
            <input type="text" name="description" required>

            <label for="amount">Amount:</label>
            <input type="number" name="amount" step="0.01" required>

            <label for="destination_wallet_id">Destination Wallet:</label>
            <select name="destination_wallet_id" required>
                @foreach($wallets as $otherWallet)
                    <option value="{{ $otherWallet->id }}">{{ $otherWallet->id }}</option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-secondary" style="color: #4299e1; background-color: #cbd5e0;">Add Transaction</button>
        </form>
    </div>
</x-app-layout>

