<?php

use App\Http\Controllers\BudgetingCategoryController;
use App\Http\Controllers\TransactionCategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionTypeController;
use App\Http\Controllers\BudgetingController;
use App\Models\Budgeting;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);

    return ['token' => $token->plainTextToken];
});


Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);



Route::middleware(['auth:sanctum'])->group(function() {


    Route::prefix('transactions')->group(function () {
        Route::controller(TransactionController::class)->group(function () {
            Route::get('', 'index');
            Route::post('', 'create');
            Route::get('{uuid}', 'show');
            Route::put('{uuid}', 'update');    // Route for updating a transaction
            Route::delete('{uuid}', 'delete'); // Route for deleting a transaction
        });
    });


    Route::prefix('transaction-type')->group(function() {
        Route::controller(TransactionTypeController::class)->group(function() {
            Route::get('', 'index');
        });
    });

    Route::prefix('transaction-category')->group(function() {
        Route::controller(TransactionCategoryController::class)->group(function() {
            Route::get('', 'index');
            Route::post('', 'create');
            Route::get('{id}', 'show');
            Route::put('{id}', 'update');    // Rute untuk update
            Route::delete('{id}', 'delete'); // Rute untuk delete
        });
    });

    Route::prefix('category-budgetting')->group(function() {
        Route::controller(BudgetingCategoryController::class)->group(function() {
            Route::get('', 'index');
            Route::post('', 'create');
            Route::get('{id}', 'show');
            Route::put('{id}', 'update');
            Route::delete('{id}', 'delete');
        });
    });

    Route::prefix('budgetings')->group(function() {
        Route::controller(BudgetingController::class)->group(function() {
            Route::get('', 'index');
            Route::get('/by-transaction-type', 'getBudgetingsByTransactionType');
        });
    });
});
