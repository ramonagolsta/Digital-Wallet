<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['wallet_id', 'description', 'amount', 'is_fraudulent'];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
    public function walletId()
    {
        return $this->belongsTo(Wallet::class, 'wallet_id');
    }

    public function destinationWallet()
    {
        return $this->belongsTo(Wallet::class, 'destination_wallet_id');
    }

}
