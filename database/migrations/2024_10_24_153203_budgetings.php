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
        Schema::create('budgetings', function(Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->integer('amount');
            $table->foreignId('transaction_category_id');
            $table->foreignId('budgeting_category_id');
            $table->unique('upsert_id');
            $table->integer('adjust');
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
