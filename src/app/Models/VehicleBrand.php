<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleBrand extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_manufacturer_id',
        'name',
    ];

    /**
     * @return HasMany
     */
    public function models()
    {
        return $this->hasMany(VehicleModel::class);
    }

    /**
     * @return BelongsTo
     */
    public function manufacturer()
    {
        return $this->belongsTo(VehicleManufacturer::class);
    }
}
