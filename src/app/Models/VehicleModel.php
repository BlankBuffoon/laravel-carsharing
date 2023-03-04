<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_brand_id',
        'name',
    ];

    /**
     * @return HasMany
     */
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    /**
     * @return BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo(VehicleBrand::class);
    }
}
