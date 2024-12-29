<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TransactionCategoryController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 200,
            'data' => TransactionCategory::all(),
            'message' => 'Data retrieved successfully',
        ]);
    }

    public function show($id)
    {
        $transactionCategory = TransactionCategory::find($id);

        if (!$transactionCategory) {
            return response()->json([
                'status' => 404,
                'message' => 'Data not found'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => $transactionCategory,
            'message' => 'Data retrieved successfully'
        ], 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'transaction_type_id' => 'required|integer',
            'is_show' => 'integer',
            'default' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors(),
                'message' => 'Invalid data provided'
            ], 422);
        }

        $transactionCategory = TransactionCategory::create([
            'name' => $request->name,
            'transaction_type_id' => $request->transaction_type_id,
            'user_id' => Auth::user()->id,
            'is_show' => $request->is_show,
            'default' => $request->default,
        ]);

        return response()->json([
            'status' => 201,
            'data' => $transactionCategory,
            'message' => 'Transaction category created successfully'
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $transactionCategory = TransactionCategory::find($id);

        if (!$transactionCategory) {
            return response()->json([
                'status' => 404,
                'message' => 'Transaction category not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'transaction_type_id' => 'required|integer',
            'is_show' => 'integer',
            'default' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors(),
                'message' => 'Invalid data provided'
            ], 422);
        }

        $transactionCategory->update([
            'name' => $request->name,
            'transaction_type_id' => $request->transaction_type_id,
            'is_show' => $request->is_show,
            'default' => $request->default,
        ]);

        return response()->json([
            'status' => 200,
            'data' => $transactionCategory,
            'message' => 'Transaction category updated successfully'
        ], 200);
    }

    public function delete($id)
    {
        $transactionCategory = TransactionCategory::find($id);

        if (!$transactionCategory) {
            return response()->json([
                'status' => 404,
                'message' => 'Transaction category not found'
            ], 404);
        }

        $transactionCategory->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Transaction category deleted successfully'
        ], 200);
    }
}
