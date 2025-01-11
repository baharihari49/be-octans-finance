<?php

namespace App\Http\Controllers;

use App\Models\Budgeting;
use Illuminate\Http\Request;
use App\Models\BudgetingCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BudgetingCategoryController extends Controller
{
    // Get all categories for the authenticated user
    public function index()
    {
        return response()->json([
            'status' => 200,
            'data' => BudgetingCategory::where('user_id', Auth::id())->get(),
            'message' => 'Data retrieved successfully',
        ]);
    }

    // Show a specific category by ID
    public function show($id)
    {
        $category = BudgetingCategory::where('user_id', Auth::id())->find($id);

        if (!$category) {
            return response()->json([
                'status' => 404,
                'message' => 'Category not found',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => $category,
            'message' => 'Data retrieved successfully',
        ]);
    }

    // Create a new category
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'value' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors(),
                'message' => 'Invalid data provided',
            ], 422);
        }


        // calculation before cerate, if value more than 100, thats fails

        $value = BudgetingCategory::where('user_id', Auth::user()->id)->sum('value');
        $sumOfValue = number_format((float) $value);

        if (($sumOfValue + $request->value) > 100) {
            return response()->json([
                'status' => 200,
                'data' => [],
                'message' => 'Jumlah maksimal budgeting telah terpenuhi',
            ], 200);
        }


        $category = BudgetingCategory::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'value' => $request->value,
        ]);

        return response()->json([
            'status' => 201,
            'data' => $category,
            'message' => 'Category created successfully',
        ], 201);
    }

    // Update an existing category
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'value' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors(),
                'message' => 'Invalid data provided',
            ], 422);
        }

        // calculation before update, if value more than 100, thats fails

        $value = BudgetingCategory::where('user_id', Auth::user()->id)->sum('value');
        $category = BudgetingCategory::where('user_id', Auth::id())->find($id);
        $sumOfValue = number_format((float) $value);

        if (($sumOfValue + $request->value - $category->value) > 100) {
            return response()->json([
                'status' => 200,
                'data' => [],
                'message' => 'Jumlah maksimal budgeting telah terpenuhi',
            ], 200);
        }

        if (!$category) {
            return response()->json([
                'status' => 404,
                'message' => 'Category not found',
            ], 404);
        }

        $category->update([
            'name' => $request->name,
            'value' => $request->value,
        ]);

        return response()->json([
            'status' => 200,
            'data' => $category,
            'message' => 'Category updated successfully',
        ]);
    }

    // Delete a category
    public function delete($id)
    {
        $category = BudgetingCategory::where('user_id', Auth::id())->find($id);

        if (!$category) {
            return response()->json([
                'status' => 404,
                'message' => 'Category not found',
            ], 404);
        }

        $category->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Category deleted successfully',
        ]);
    }
}
