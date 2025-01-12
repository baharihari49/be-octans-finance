<?php

namespace App\Helpers;

use App\Models\Budgeting;
use App\Models\Transactions;
use App\Models\TransactionCategory;
use App\Models\BudgetingCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class Services
{

    public static function getValueBudgeting($id)
    {
        // Pertama, jumlahkan semua amount dalam transaksi di mana transaction_type_id adalah [1,2]
        $amount = Transactions::whereIn('transaction_type_id', [1, 2])
            ->where('user_id', Auth::user()->id)
            ->sum('amount');

        // Kedua, hitung jumlah kolom dalam kategori transaksi di mana transaction_type_id adalah $id
        $categories = TransactionCategory::where('transaction_type_id', $id)->count();

        // Ketiga, ambil nilai dari category_budgeting
        $budgeting = BudgetingCategory::where('transaction_type_id', $id)
            ->where('user_id', Auth::user()->id)
            ->pluck('value'); // Ambil hanya kolom `value`

        // Periksa apakah budgeting memiliki elemen sebelum mengakses indeks [0]
        $budgetingValue = $budgeting->isNotEmpty() ? $budgeting[0] : 0;

        // Keempat, hitung amount dengan nilai dari budgeting
        $budgetingFinal = ($amount * $budgetingValue) / 100;

        // Kelima, bagi amount dengan jumlah kategori
        $budgetingFinalResult = $categories > 0 ? $budgetingFinal / $categories : 0;

        return $budgetingFinalResult;
    }

    public static function getBudgetingCategoryId($id)
    {
        $budgetingCategory = BudgetingCategory::where('transaction_type_id', $id)
            ->where('user_id', Auth::id())
            ->pluck('id'); // Ambil hanya id sebagai array

        return $budgetingCategory ?? [];
    }

    public static function storeBudgeting($id)
{
    // Ambil semua budgeting category dalam bentuk array
    $budgetingCategoryIds = self::getBudgetingCategoryId($id);

    // Jika budgeting category kosong, hentikan eksekusi fungsi
    if ($budgetingCategoryIds->isEmpty()) {
        return; // Tidak melakukan apa-apa
    }

    $kategoriTransaksi = TransactionCategory::where('transaction_type_id', $id)->get();

    $valueOfBudgeting = $kategoriTransaksi->map(function ($item, $index) use ($budgetingCategoryIds, $id) {
        return [
            'upsert_id' => intval($index + 1) . ($budgetingCategoryIds->first() ?? 0) . intval(Auth::user()->id), // Pastikan upser_id benar-benar unik
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
