<?php

namespace Database\Seeders;

use App\Models\RenterBankAccount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RenterBankAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        RenterBankAccount::factory(150)->create();
    }
}
