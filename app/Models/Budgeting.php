<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\TransactionCategory;

class Budgeting extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'transaction_category_id',
        'budgeting_category_id',
        'upser_id',
        'adjust',
    ];

    public function transactionCategory(): BelongsTo
    {
        return $this->belongsTo(TransactionCategory::class);
    }
}
