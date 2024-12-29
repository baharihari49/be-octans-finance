<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\TransactionType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\TransactionCategory;

class Transactions extends Model
{
    use HasUuids;
    use HasFactory;

    public function uniqueIds(): array
    {
        return ['uuid', 'uuid'];
    }

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'date',
        'no_transactions',
        'amount',
        'descriptions',
        'user_id',
        'payment_id',
        'transaction_category_id',
        'is_void',
        'is_budget',
        'transaction_type_id',
        'vendor_id'
    ];

    public function transactionType(): BelongsTo
    {
        return $this->belongsTo(TransactionType::class);
    }

    public function transactionCategory(): BelongsTo
    {
        return $this->belongsTo(TransactionCategory::class);
    }
}
