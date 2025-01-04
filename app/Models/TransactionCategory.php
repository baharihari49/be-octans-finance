<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\TransactionType;

class TransactionCategory extends Model
{
    protected $fillable = [
        'name',
        'transaction_type_id',
        'user_id',
        'is_show',
        'default',
    ];


    public function transactionType(): BelongsTo
    {
        return $this->belongsTo(TransactionType::class);
    }
}
