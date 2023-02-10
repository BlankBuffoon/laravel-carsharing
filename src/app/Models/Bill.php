<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
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
        return $this->belongsToMany(Renter::class, 'bill_renter', 'bill_id', 'renter_id');
    }

    protected static function boot()
    {
        parent::boot();

        // При сохранении в модель
        static::saving(function ($bill) {
            $bill->updateRentersCount();
            $bill->updateBillType();
        });
    }

    public function updateRentersCount() {
        // Получаем кол-во связанных со счетом пользователей
        $this->renters_count = $this->renters()->count();
    }

    public function updateBillType() {
        // Обновляем статус аккаунта
        if ($this->renters_count > 1) 
        {
            $this->type = 'corporated';
        } 

        elseif ($this->renters_count == 1) 
        {
            $this->type = 'personal';
        } 
    }
}
