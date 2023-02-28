<?php

namespace App\Enums\Bill;

use BenSampo\Enum\Enum;

/**
 * @method static static Open()
 * @method static static Blocked()
 * @method static static Frozen()
 * @method static static Closed()
 */
final class BillStatus extends Enum
{
    const Open = 'open';
    const Blocked = 'blocked';
    const Frozen = 'frozen';
    const Closed = 'closed';
}
