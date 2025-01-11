<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budgeting;
use Illuminate\Support\Facades\Auth;
use App\Models\Transactions;

class BudgetingController extends Controller
{
    public function index()
    {
        $budgetingData = Budgeting::where('user_id', Auth::user()->id)
            ->with('transactionCategory')
            ->get();

        $transactionData = Transactions::selectRaw('transaction_category_id, SUM(amount) as total_amount')
            ->where('user_id', Auth::user()->id)
            ->whereIn('transaction_type_id', [3, 4])
            ->groupBy('transaction_category_id')
            ->get()
            ->keyBy('transaction_category_id'); // Index data berdasarkan `transaction_category_id`

        $mergedData = $budgetingData->map(function ($item) use ($transactionData) {
            $transactionCategoryId = $item->transaction_category_id;
            $totalAmount = $transactionData->has($transactionCategoryId)
                ? $transactionData->get($transactionCategoryId)->total_amount
                : 0; // Default ke 0 jika tidak ada

            $item->total_amount = $totalAmount;
            $item->percentage = $item->amount > 0
                ? round(($totalAmount / $item->amount) * 100) // Persentase dengan 2 desimal
                : 0; // Jika amount 0, persentase juga 0
            return $item;
        });

        return response()->json([
            'status' => 200,
            'data' => $mergedData,
            'message' => 'Data combined successfully with percentages',
        ]);
    }

    public function getBudgetingsByTransactionType()
    {


        return response()->json([
            'status' => 200,
            'data' => Budgeting::where('user_id', Auth::user()->id)->with('transactionCategory')->get(),
            'message' => 'Budgeting data retrieved successfully',
        ]);
    }
}
