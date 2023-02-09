<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankAccount extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'balance',
        'status',
        'type',
    ];

    protected $hidden = [
        'balance',
    ];

    public function renters()
    {
        return $this->belongsToMany(Renter::class, 'renters_bank_accounts', 'bank_account_id', 'renter_id');
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }
}
