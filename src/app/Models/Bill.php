<?php

namespace App\Models;

use App\Enums\Bill\BillStatus;
use App\Enums\Bill\BillType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUuids;

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

    /**
     * Обновляет поле renters_count в зависимости от кол-ва связанных записей в пользователях
     *
     * @return void
     */
    public function updateRentersCount() {
        // Получаем кол-во связанных со счетом пользователей
        $this->renters_count = $this->renters()->count();
        $this->save();
    }

    /**
     * Обновляет тип и статус счета в зависимости от колличества пользователей
     *
     * @return void
     */
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

    /**
     * Изменяет статус счета
     *
     * @return void
     */
    public function setStatus($status) {
        $this->status = $status;
    }

    /**
     * Изменяет баланс счета
     *
     * @return void
     */
    public function modificateBalance($modification) {
        $this->balance += $modification;
        $this->save();
    }
}
