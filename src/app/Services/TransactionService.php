<?php

namespace App\Services;

use App\Models\Bill;
use App\Models\Renter;
use App\Models\Transaction;
use Carbon\Carbon;

class TransactionService
{
     /**
     * Создает запись в истории со счетами
     *
     * @param Bill $bill Связанный счет
     * @param Renter $renter Инициатор транзакции
     * @param int $modification Изменение (положительное или отрицатеьлное число) в копейках
     * @param string $reason Причина (описание) транзакции
     */
    public function createRecord(Bill $bill, Renter $renter, int $modification, string $reason) {
        $transaction = new Transaction();
        $transaction->createRecord(
            $bill,
            $renter,
            $modification,
            $reason,
        );
    }
}
