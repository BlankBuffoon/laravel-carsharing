<?php

namespace App\Models;

use App\Enums\Rent\RentStatus;
use App\Enums\Vehicle\VehicleStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rent extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'vehicle_id',
        'renter_id',
        'status',
        'begin_datetime',
        'end_datetime',
        'rented_time',
        'totalPrice',
    ];

    public function vehicle() {
        return $this->belongsTo(Vehicle::class);
    }

    public function renter() {
        return $this->belongsTo(Renter::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($rent) {
            // Если существует дата закрытия аренды, то необходимо посчитать время и стоимость
            if ( $rent->end_datetime != null ) {
                $rent->calculateRentedTime();
                $rent->calculateTotalPrice();
            }
        });
    }

    // Вынести в сервис
    public function calculateRentedTime() {
        if ($this->end_datetime != null) {
            $end_datetime = new Carbon($this->end_datetime);
            $begin_datetime = new Carbon($this->begin_datetime);
            $this->rented_time = $end_datetime->diffInMinutes($begin_datetime);
        }
    }

    // Вынести в сервис
    public function calculateTotalPrice() {
        if ( $this->rented_time ) {
            $this->total_price = $this->vehicle->price_at_minute * $this->rented_time;
        }
    }

    /**
     * Открывает аренду
     *
     * @return void
     */
    public function close() {
        $this->end_datetime = Carbon::now();
        $this->calculateRentedTime();
        $this->calculateTotalPrice();
        $this->status = RentStatus::Closed;
        $this->vehicle->status = VehicleStatus::Expectation;

        $this->vehicle->update();
        $this->update();
    }

    /**
     * Закрывает аренду
     *
     * @return void
     */
    public function open($renterId, $vehicleId) {
        $this->vehicle_id = $vehicleId;
        $this->renter_id = $renterId;
        $this->begin_datetime = Carbon::now();

        $this->vehicle->status = VehicleStatus::Rented;

        $this->vehicle->save();
        $this->save();
    }
}
