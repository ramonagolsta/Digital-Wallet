
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Wallet') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h1 class="card-title">Create Wallet</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('wallets.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Wallet Name:</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Initial Amount:</label>
                        <input type="number" name="amount" class="form-control" step="0.01" value="0.00" required>
                    </div>
                    <button type="submit" class="btn btn-secondary" style="color: #4299e1; background-color: #cbd5e0;">Create Wallet</button>
                </form>
            </div>
        </div>
        @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
    </div>
</x-app-layout>


