<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Renter extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'bank_account_id',
        'first_name',
        'middle_name',
        'last_name',
        'status',
        'phone_number',
        'email',
        'passport',
    ];

    protected $hidden = [
        'bank_account_id',
        'email',
        'phone_number',
        'passport',
    ];

    public function bankAccounts()
    {
        return $this->belongsToMany(BankAccount::class, 'renters_bank_accounts', 'renter_id', 'bank_account_id');
    }

    public function fullname()
    {
        return $this->middle_name . ' ' . $this->first_name . ' ' . $this->last_name;
    }

    public function scopeOfType($query, $type)
    {
        return $query->whereHas('BankAccount', function ($q) use ($type) {
            $q->where('type', $type);
        });
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($renter) {
            $bankAccount = BankAccount::ofType('personal')->first();

            if ($bankAccount && $bankAccount->renters->count() >= 1) {
                return false;
            }

            $renter->bank_account_id = $bankAccount->id;
        });
    }
}
