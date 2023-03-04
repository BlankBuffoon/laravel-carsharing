<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUuids;

    protected $fillable = [
        'vehicle_model_id',
        'status',
        'mileage',
        'manufacture_year',
        'location',
        'license_plate',
        'price_at_minute',
    ];

    protected $hidden = [
        'location'
    ];

    /**
     * @return HasMany
     */
    public function rents()
    {
        return $this->hasMany(Rent::class);
    }

    /**
     * @return BelongsTo
     */
    public function models()
    {
        return $this->belongsTo(VehicleModel::class);
    }
}
