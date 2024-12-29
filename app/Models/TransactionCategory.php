<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionCategory extends Model
{
    protected $fillable = [
        'name',
        'transaction_type_id',
        'user_id',
        'is_show',
        'default',
    ];
}
