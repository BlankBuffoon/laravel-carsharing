<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUuids;

    protected $fillable = [
        'bill_id',
        'renter_id',
        'modification',
        'transaction_datetime',
    ];

    protected $hidden = [
        'modification',
    ];

    /**
     * @return BelongsTo
     */
    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    /**
     * @return BelongsTo
     */
    public function renter()
    {
        return $this->belongsTo(Renter::class);
    }

    /**
     * Создает запись в истории операций
     *
     * @param Bill $bill
     * @param Renter $renter
     * @param int $modification
     * @param string $reason
     */
    public function createRecord(Bill $bill, Renter $renter, int $modification, string $reason) {
        $this->bill_id = $bill->id;
        $this->renter_id = $renter->id;
        $this->modification = $modification;
        $this->transaction_datetime = Carbon::now();
        $this->reason = $reason;

        $this->save();
    }
}
