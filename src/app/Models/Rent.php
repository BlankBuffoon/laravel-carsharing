<?php

namespace App\Models;

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

    public function calculateRentedTime() {
        if ($this->end_datetime != null) {
            $end_datetime = new Carbon($this->end_datetime);
            $begin_datetime = new Carbon($this->begin_datetime);
            $this->rented_time = $end_datetime->diffInMinutes($begin_datetime);
        }
    }

    public function calculateTotalPrice() {
        if ( $this->rented_time ) {
            $this->total_price = $this->vehicle->price_at_minute * $this->rented_time;
        }
    }

    public function close() {
        $this->end_datetime = Carbon::now();
        $this->calculateRentedTime();
        $this->calculateTotalPrice();
        $this->status = "closed";
        $this->vehicle->status = "expectation";

        $this->vehicle->update();
        $this->update();
    }

    public function open($renterId, $vehicleId) {
        $this->vehicle_id = $vehicleId;
        $this->renter_id = $renterId;
        $this->begin_datetime = Carbon::now();

        $this->vehicle->status = 'rented';

        $this->vehicle->save();
        $this->save();
    }

    public function getRenter() {
        return $this->renter();
    }
}
