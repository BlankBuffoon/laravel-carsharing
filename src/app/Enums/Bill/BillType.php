<?php

namespace App\Enums\Bill;

use BenSampo\Enum\Enum;

/**
 * @method static static Personal()
 * @method static static Corporated()
 */
final class BillType extends Enum
{
    const Personal = 'personal';
    const Corporated = 'corporated';
}
