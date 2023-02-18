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

    public function bills()
    {
        return $this->belongsToMany(Bill::class, 'bill_renter', 'renter_id', 'bill_id');
    }

    public function fullname()
    {
        return $this->middle_name . ' ' . $this->first_name . ' ' . $this->last_name;
    }
}