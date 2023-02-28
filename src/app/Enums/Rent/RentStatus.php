<?php

namespace App\Enums\Rent;

use BenSampo\Enum\Enum;

/**
 * @method static static Open()
 * @method static static Closed()
 */
final class RentStatus extends Enum
{
    const Open = 'open';
    const Closed = 'closed';
}
