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

    protected static function boot()
    {
        parent::boot();

        // При сохранении в модель
        static::saving(function ($renter) {
        });
    }

    /**
     * Изменяет поле 'default_bill'
     *
     * @return void
     */
    public function setDefaultBill($billId) {
        $this->default_bill = $billId;
    }
}
