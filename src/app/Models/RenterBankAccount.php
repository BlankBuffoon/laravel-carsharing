<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RenterBankAccount extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'renters_bank_accounts';

    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class);
    }

    public function renter()
    {
        return $this->belongsTo(Renter::class);
    }
}
