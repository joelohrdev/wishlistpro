<?php

declare(strict_types=1);

namespace App\Enums;

enum Priority: string
{
    case MUST = 'must';
    case HIGH = 'high';
    case MEDIUM = 'medium';
    case LOW = 'low';

    public function label(): string
    {
        return match ($this) {
            self::MUST => 'Must Have',
            self::HIGH => 'High',
            self::MEDIUM => 'Medium',
            self::LOW => 'Low',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::MUST => 'red',
            self::HIGH => 'orange',
            self::MEDIUM => 'blue',
            self::LOW => 'green',
        };
    }
}
