<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class BillRenter extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'bill_renter';

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    public function renter()
    {
        return $this->belongsTo(Renter::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($billRenter) {
            // При сохранении связи тригерим сохранение для обновления полей
            $billRenter->bill->save();

            // Если у пользователя нет счета по умолчанию,
            // То первый добавленный счет автоматически назначается как счет по умолчанию
            if ($billRenter->renter->default_bill == null) {
                $billRenter->renter->default_bill = $billRenter->bill->id;
                $billRenter->renter->save();
            }

            // $billRenter->renter->save();
        });

        static::deleted(function ($billRenter) {
            $billRenter->bill->save();
        });
    }
}
