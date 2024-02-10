<!-- resources/views/transactions/edit.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Transaction
        </h2>
    </x-slot>

    <div class="container">
        <h1>Edit Transaction</h1>
        <form action="{{ route('transactions.update', [$wallet, $transaction]) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="description">Description:</label>
            <input type="text" name="description" value="{{ $transaction->description }}" required>
            <label for="amount">Amount:</label>
            <input type="number" name="amount" step="0.01" value="{{ $transaction->amount }}" required>
            <label for="is_fraudulent">Mark as Fraudulent:</label>
            <input type="checkbox" name="is_fraudulent" {{ $transaction->is_fraudulent ? 'checked' : '' }}>
            <button type="submit">Update Transaction</button>
        </form>
    </div>
</x-app-layout>
