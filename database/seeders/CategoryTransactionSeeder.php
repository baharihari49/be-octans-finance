<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transaction_categories')->insert([
            'name' => 'Gaji',
            'transaction_type_id' => 1,
            'user_id' => 0,
            'default' => 1
        ]);

        DB::table('transaction_categories')->insert([
            'name' => 'Tunjangan',
            'transaction_type_id' => 1,
            'user_id' => 0,
            'default' => 1
        ]);

        DB::table('transaction_categories')->insert([
            'name' => 'Pensiun',
            'transaction_type_id' => 1,
            'user_id' => 0,
            'default' => 1
        ]);

        DB::table('transaction_categories')->insert([
            'name' => 'Bisnis',
            'transaction_type_id' => 2,
            'user_id' => 0,
            'default' => 1
        ]);

        DB::table('transaction_categories')->insert([
            'name' => 'Pekerjaan Sampingan',
            'transaction_type_id' => 2,
            'user_id' => 0,
            'default' => 1
        ]);

        DB::table('transaction_categories')->insert([
            'name' => 'Investasi',
            'transaction_type_id' => 2,
            'user_id' => 0,
            'default' => 1
        ]);

        DB::table('transaction_categories')->insert([
            'name' => 'Uang Makan',
            'transaction_type_id' => 3,
            'user_id' => 0,
            'default' => 1
        ]);

        DB::table('transaction_categories')->insert([
            'name' => 'Transportasi',
            'transaction_type_id' => 3,
            'user_id' => 0,
            'default' => 1
        ]);

        DB::table('transaction_categories')->insert([
            'name' => 'Tagihan (Listrik, Air, Telepon, Internet, dll)',
            'transaction_type_id' => 3,
            'user_id' => 0,
            'default' => 1
        ]);

        DB::table('transaction_categories')->insert([
            'name' => 'Sewa atau KPR',
            'transaction_type_id' => 3,
            'user_id' => 0,
            'default' => 1
        ]);

        DB::table('transaction_categories')->insert([
            'name' => 'Asuransi',
            'transaction_type_id' => 3,
            'user_id' => 0,
            'default' => 1
        ]);

        DB::table('transaction_categories')->insert([
            'name' => 'Kesehatan',
            'transaction_type_id' => 3,
            'user_id' => 0,
            'default' => 1
        ]);

        DB::table('transaction_categories')->insert([
            'name' => 'Pendidikan',
            'transaction_type_id' => 3,
            'user_id' => 0,
            'default' => 1
        ]);

        DB::table('transaction_categories')->insert([
            'name' => 'Belanja',
            'transaction_type_id' => 4,
            'user_id' => 0,
            'default' => 1
        ]);

        DB::table('transaction_categories')->insert([
            'name' => 'Hiburan',
            'transaction_type_id' => 4,
            'user_id' => 0,
            'default' => 1
        ]);

        DB::table('transaction_categories')->insert([
            'name' => 'Kebutuhan Lainnya (Olahraga, Hobi, Donasi, dll)',
            'transaction_type_id' => 4,
            'user_id' => 0,
            'default' => 1
        ]);
        DB::table('transaction_categories')->insert([
            'name' => 'Tabungan',
            'transaction_type_id' => 5,
            'user_id' => 0,
            'default' => 1
        ]);

    }
}
