<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BudgetingCategory extends Model
{
    protected $table = 'budgetings_category';

    protected $fillable = [
        'user_id',
        'name',
        'value',
        'transaction_type_id'
    ];
}
