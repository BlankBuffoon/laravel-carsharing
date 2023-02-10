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
            // При сохранении связи тригерим сохранение связанного счета для обновления полей
            $billRenter->bill->save();
        });

        static::deleted(function ($billRenter) {
            $billRenter->bill->save();
        });
    }
}
