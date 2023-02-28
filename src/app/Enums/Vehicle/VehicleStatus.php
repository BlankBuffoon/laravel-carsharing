<?php

namespace App\Enums\Vehicle;

use BenSampo\Enum\Enum;

/**
 * @method static static Rented()
 * @method static static Maintenance()
 * @method static static Expectation()
 */
final class VehicleStatus extends Enum
{
    const Rented = 'rented';
    const Maintenance = 'maintenance';
    const Expectation = 'expectation';
}
