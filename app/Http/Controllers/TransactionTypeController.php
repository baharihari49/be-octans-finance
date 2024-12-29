<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionType;

class TransactionTypeController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 200,
            'data' => TransactionType::all(),
            'message' => 'data retrived successfully',
        ]);
    }
}
