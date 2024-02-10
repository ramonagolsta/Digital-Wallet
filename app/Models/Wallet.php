<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = ['user_id', 'name', 'amount'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function destinationTransactions()
    {
        return $this->hasMany(Transaction::class, 'destination_wallet_id');
    }
    // Wallet.php

    public function totalIncomingAmount()
    {
        return $this->transactions()->where('amount', '>', 0)->sum('amount');
    }

    public function totalOutgoingAmount()
    {
        return $this->transactions()->where('amount', '<', 0)->sum('amount');
    }


}
