<!-- resources/views/wallets/index.blade.php -->

@if(session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
@endif
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Wallets') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <div class="row">
            @foreach ($wallets as $wallet)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $wallet->name }}</h5>
                            <p class="card-text">
                                Wallet ID: {{ $wallet->id }} <br>
                                Money in wallet: {{ $wallet->amount }}
                            </p>
                            <div class="btn-group" role="group">
                                <a href="{{ route('wallets.show', $wallet) }}" class="btn btn-info">View</a>
                                <a href="{{ route('wallets.edit', $wallet) }}" class="btn btn-warning">Edit</a>
                                <a href="{{ route('wallets.transactions.create', $wallet) }}" class="btn btn-success">Make a Transaction</a>
                                <form action="{{ route('wallets.destroy', $wallet) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this wallet?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="color: #fff; background-color: #dc3545;">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>


