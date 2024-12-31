<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid();
            $table->date('date');
            $table->string('no_transactions');
            $table->integer('amount');
            $table->string('descriptions')->nullable();
            $table->foreignId('user_id');
            $table->string('payment_id')->nullable();
            $table->boolean('is_void')->default(false);
            $table->foreignId('transaction_category_id');
            $table->foreignId('vendor_id')->nullable();
            $table->boolean('is_budget')->default(false);
            $table->foreignId('transaction_type_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
