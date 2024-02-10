<!-- resources/views/wallets/show.blade.php -->

@if(session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
@endif
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $wallet->name }} Wallet
        </h2>
    </x-slot>

    <div class="container mt-5">
        <a href="{{ route('wallets.index')}}" class="btn btn-secondary mb-3">Back to Wallet List</a>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Wallet Details</h5>
                <p>Wallet ID: {{ $wallet->id }}</p>
                <p>Money in wallet: {{ $wallet->amount }}</p>

                <h2>Transactions</h2>
                <p>Total Incoming: {{ $wallet->totalIncomingAmount() }}</p>
                <p>Total Outgoing: {{ $wallet->totalOutgoingAmount() }}</p>

            </div>
        </div>

        <h2 class="mt-4 mb-3">Transactions</h2>
        <ul class="list-group">
            @foreach ($wallet->transactions as $transaction)
                <li class="list-group-item">
                    <p><strong>Description:</strong> {{ $transaction->description }}</p>
                    <p><strong>Amount Sent:</strong> {{ $transaction->amount }}</p>
                    <p><strong>Sent To:</strong> {{ $wallet->name }} wallet</p>

                    <form action="{{ route('wallets.transactions.destroy', [$wallet, $transaction]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this transaction?');" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="color: #fff; background-color: #dc3545;">Delete</button>
                    </form>


                @if (!$transaction->is_fraudulent)
                        <form action="{{ route('transactions.mark-fraudulent', $transaction) }}" method="POST" onsubmit="return confirm('Are you sure you want to mark this transaction as fraudulent?');" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-warning">Mark as Fraudulent</button>
                        </form>
                    @endif

                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
