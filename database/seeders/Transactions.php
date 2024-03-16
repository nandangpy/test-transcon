<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class Transactions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('transactions')->insert([
            [
                'id' => 1,
                'no_transaction' => 001,
                'transaction_date' => Carbon::parse('2000-7-14'),
            ], [
                'id' => 2,
                'no_transaction' => 002,
                'transaction_date' => Carbon::parse('2000-7-14')
            ]
        ]);

        DB::table('transactions_details')->insert([
            [
                'id' => 1,
                'transactions_id' => 1,
                'item' => 'Kopi',
                'quantity' => 2,
            ], [
                'id' => 2,
                'transactions_id' => 1,
                'item' => 'Gula',
                'quantity' => 3,
            ], [
                'id' => 3,
                'transactions_id' => 2,
                'item' => 'Susu',
                'quantity' => 7,
            ], [
                'id' => 4,
                'transactions_id' => 2,
                'item' => 'Kopi',
                'quantity' => 5,
            ],
        ]);
    }
}
