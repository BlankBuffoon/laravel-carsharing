<?php

namespace App\Models;

use App\Enums\Bill\BillStatus;
use App\Enums\Bill\BillType;
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
            // $bill->updateRentersCount();
            // $bill->updateBillType();
        });
    }

    public function updateRentersCount() {
        // Получаем кол-во связанных со счетом пользователей
        $this->renters_count = $this->renters()->count();
        $this->save();
    }

    public function updateBillType() {
        // Обновляем статус аккаунта
        if ($this->renters_count > 1)
        {
            $this->type = BillType::Corporated;
        }

        elseif ($this->renters_count == 1)
        {
            $this->type = BillType::Personal;
        }

        elseif ($this->renters_count == 0) {
            $this->status = BillStatus::Blocked;
        }

        $this->save();
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function modificateBalance($modification) {
        $this->balance += $modification;
        $this->save();
    }
}
