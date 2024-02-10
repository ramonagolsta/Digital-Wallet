<!-- resources/views/wallets/edit.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Wallet') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Wallet</h5>
                <form action="{{ route('wallets.update', $wallet) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Wallet Name:</label>
                        <input type="text" name="name" value="{{ $wallet->name }}" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary" style="color: #4299e1; background-color: #cbd5e0;">Update Wallet</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
