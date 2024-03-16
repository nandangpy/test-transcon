<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
    protected $fillable = ['no_transaction', 'transaction_date'];

    public function details()
    {
        return $this->hasMany(TransactionsDetail::class);
    }
}
