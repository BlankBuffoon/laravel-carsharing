<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle_model extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'vehicle_brand_id',
        'name',
    ];
}
