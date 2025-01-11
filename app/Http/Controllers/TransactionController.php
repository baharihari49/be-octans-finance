<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transactions;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Helpers;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 200,
            'data' => Transactions::where('user_id', Auth::user()->id)->with('transactionType')->get(),
            'message' => 'Transaction data retrieved successfully'
        ]);
    }

    public function create(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric',
            'descriptions' => 'required|string|max:255',
            'date' => 'required|date',
            'transaction_category_id' => 'required|integer',
            'vendor_id' => '',
            'transaction_type_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors(),
                'message' => 'Invalid data provided',
            ], 422);
        }

        // Get the count of transactions for the authenticated user
        $lastTransactionCount = Transactions::where('user_id', Auth::user()->id)->count();

        // Generate a unique transaction number
        $prefix = match ($request->transaction_type_id) {
            1, 2 => 'ITR-', // Prefix for type 1 and 2
            3, 4 => 'OTR-', // Prefix for type 3 and 4
            default => 'STR-', // Default prefix
        };

        $transactionNumber = $prefix . Helpers::getYear() . '-' . Helpers::getMonth() . '-' . str_pad($lastTransactionCount + 1, 6, '0', STR_PAD_LEFT);

        // Create a new transaction
        $transaction = Transactions::create([
            'amount' => $request->amount,
            'descriptions' => $request->descriptions,
            'date' => $request->date,
            'transaction_category_id' => $request->transaction_category_id,
            'vendor_id' => $request->vendor_id,
            'transaction_type_id' => $request->transaction_type_id,
            'user_id' => Auth::user()->id, // Use the authenticated user's ID
            'no_transactions' => $transactionNumber, // Save the generated transaction number
        ]);

        // Return success response
        return response()->json([
            'status' => 201,
            'data' => $transaction,
            'message' => 'Transaction created successfully',
        ], 201);
    }


    public function show($uuid)
    {
        $transaction = Transactions::where('uuid', $uuid)->with(['transactionType', 'transactionCategory'])->first();

        if (!$transaction) {
            return response()->json([
                'status' => 404,
                'message' => 'Transaction not found'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => $transaction,
            'message' => 'Transaction retrieved successfully'
        ], 200);
    }

    public function update(Request $request, $uuid)
    {
        $transaction = Transactions::find($uuid);

        if (!$transaction) {
            return response()->json([
                'status' => 404,
                'message' => 'Transaction not found'
            ], 404);
        }

        // Validate request data
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric',
            'descriptions' => 'required|string|max:255',
            'date' => 'required|date',
            'transaction_category_id' => 'required|integer',
            'vendor_id' => 'required|integer',
            'transaction_type_id' => 'required|integer',
            // Add other fields here as needed
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors(),
                'message' => 'Invalid data provided'
            ], 422);
        }

        // Update transaction
        $transaction->update([
            'amount' => $request->amount,
            'descriptions' => $request->descriptions,
            'date' => $request->date,
            'transaction_category_id' => $request->transaction_category_id,
            'vendor_id' => $request->vendor_id,
            'transaction_type_id' => $request->transaction_type_id,
            // Add other fields here as needed
        ]);

        return response()->json([
            'status' => 200,
            'data' => $transaction,
            'message' => 'Transaction updated successfully'
        ], 200);
    }

    public function delete($uuid)
    {
        $transaction = Transactions::find($uuid);

        if (!$transaction) {
            return response()->json([
                'status' => 404,
                'message' => 'Transaction not found'
            ], 404);
        }

        $transaction->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Transaction deleted successfully'
        ], 200);
    }
}
