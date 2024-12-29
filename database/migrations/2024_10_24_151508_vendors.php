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
        Schema::create('vendors', function(Blueprint $table) {
            $table->id();
            $table->string('name_of_bisnis');
            $table->string('address');
            $table->string('email');
            $table->string('no_hp');
            $table->foreignId('transaction_type_id');
            $table->foreignId('user_id');
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
