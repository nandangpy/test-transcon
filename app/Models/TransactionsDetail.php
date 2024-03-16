<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionsDetail extends Model
{
    use HasFactory;
    protected $fillable = ['transactions_id', 'item', 'quantity'];

    public function transaction()
    {
        return $this->belongsTo(Transactions::class);
    }
}
