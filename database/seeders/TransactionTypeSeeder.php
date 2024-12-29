<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transaction_types')->insert([
            'name' => 'Pendapatan Tetap',
        ]);
        DB::table('transaction_types')->insert([
            'name' => 'Pendapatan Tidak Tetap',
        ]);
        DB::table('transaction_types')->insert([
            'name' => 'Pengeluaran Pokok',
        ]);
        DB::table('transaction_types')->insert([
            'name' => 'Pengeluaran Tambahan',
        ]);
        DB::table('transaction_types')->insert([
            'name' => 'Tabungan',
        ]);
    }
}
