<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'bank_account_id',
        'renter_id',
        'modification',
        'transaction_datetime',
        'status',
        'reason',
    ];

    protected $hidden = [
        'modification',
    ];
}
