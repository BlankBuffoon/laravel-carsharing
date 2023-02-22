<?php

namespace Database\Seeders;

use App\Models\Rent;
use App\Models\Renter;
use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Rent::all()->where('status', 'closed') as $rent) {
            Transaction::create([
                "bill_id" => Renter::find($rent->renter_id)->default_bill,
                "renter_id" => $rent->renter_id,
                "modification" => $rent->total_price * -1,
                "transaction_datetime" => $rent->end_datetime,
                "reason" => 'payment for rent №' . $rent->id,
            ]);
        }
    }
}
