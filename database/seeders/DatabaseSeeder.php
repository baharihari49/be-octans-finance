<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\TransactionTypeSeeder;
use Database\Seeders\CategoryTransactionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TransactionTypeSeeder::class,
            CategoryTransactionSeeder::class,
        ]);
    }
}
