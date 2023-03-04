<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Renter extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUuids;

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

    // Возможно необходимо переработать связь
    // и сделать в таблице bills отдельное поле или связующую таблицу
    /**
     * @return HasOne
     */
    public function defaultBill()
    {
        return $this->hasOne(Bill::class);
    }

    /**
     * @return HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * @return HasMany
     */
    public function rents()
    {
        return $this->hasMany(Rent::class);
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
