<?php

namespace App\Services;

use App\Models\Bill;
use App\Models\Renter;
use App\Models\Transaction;
use Carbon\Carbon;

class TransactionService
{
    public function createRecord(Bill $bill, Renter $renter, int $modification) {
        $transaction = new Transaction();
        $transaction->createRecord(
            $bill,
            $renter,
            $modification
        );
    }
}
