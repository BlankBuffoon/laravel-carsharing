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
        'bill_id',
        'first_name',
        'default_bill',
        'middle_name',
        'last_name',
        'status',
        'phone_number',
        'email',
        'passport',
    ];

    protected $hidden = [
        'bill_id',
        'email',
        'phone_number',
        'passport',
    ];

    public function bills()
    {
        return $this->belongsToMany(Bill::class, 'bill_renter', 'renter_id', 'bill_id');
    }

    public function default_bill() {
        return $this->belongsTo(Bill::class);
    }

    protected static function boot()
    {
        parent::boot();

        // При сохранении в модель
        static::saving(function ($renter) {
        });
    }

    public function getFullname()
    {
        return $this->middle_name . ' ' . $this->first_name . ' ' . $this->last_name;
    }

    public function setDefaultBill($billId) {
        $this->default_bill = $billId;
    }
}
