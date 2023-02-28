<?php

namespace App\Enums\Renter;

use BenSampo\Enum\Enum;

/**
 * @method static static Active()
 * @method static static Frozen()
 * @method static static Blocked()
 * @method static static Premium()
 */
final class RenterStatus extends Enum
{
    const Active = 'active';
    const Frozen = 'frozen';
    const Blocked = 'blocked';
    const Premium = 'premium';
}
