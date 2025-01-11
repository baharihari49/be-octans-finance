<?php

namespace App\Helpers;

use App\Models\Budgeting;
use App\Models\Transactions;
use App\Models\TransactionCategory;
use App\Models\BudgetingCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use  Illuminate\Support\Facades\Auth;

class Services
{

    public static function getValueBudgeting($id)
    {
        // first, sum all amount in transaction where transaction_type_id is [1,2]
        $amount = Transactions::whereIn('transaction_type_id', [1, 2])->where('user_id', Auth::user()->id)->sum('amount');

        // seconds, count al column in transanction category where transaction_type is [1,2]
        $categories = TransactionCategory::where('transaction_type_id', $id)->count();


        // Third, get value from category_budgeting

        $budgeting = BudgetingCategory::where('transaction_type_id', $id)
            ->where('user_id', Auth::user()->id)
            ->get('value');

        // fourth, calculation amount with value of budgetings

        $budgetingFinal = $amount * $budgeting[0]->value / 100;


        // fiveth, divide amount with value of budgetings

        $budgetingFinalResult = $budgetingFinal / $categories;

        return $budgetingFinalResult;
    }

    public static function getBudgetingCategoryId($id)
    {
        $budgetingCategory = BudgetingCategory::where('transaction_type_id', $id)
            ->where('user_id', Auth::id())
            ->pluck('id'); // Ambil hanya id sebagai array

        return $budgetingCategory;
    }

    public static function storeBudgeting($id)
    {

        $kategoriTransaksi = TransactionCategory::where('transaction_type_id', $id)->get();

        // Ambil semua budgeting category dalam bentuk array
        $budgetingCategoryIds = self::getBudgetingCategoryId($id);

        $valueOfBudgeting = $kategoriTransaksi->map(function ($item, $index) use ($budgetingCategoryIds, $id) {
            return [
                'upsert_id' =>  intval($index + 1) . $budgetingCategoryIds->first() . intval(Auth::user()->id), // Pastikan upser_id benar-benar unik
                'transaction_category_id' => $item->id,
                'amount' => Services::getValueBudgeting($id),
                'user_id' => Auth::id(),
                'budgeting_category_id' => $budgetingCategoryIds->first() ?? null, // Ambil ID pertama atau null jika kosong
                'adjust' => 0
            ];
        })->toArray();

        Budgeting::upsert(
            $valueOfBudgeting,
            ['upsert_id'],
            ['amount'],
        );
    }
}
