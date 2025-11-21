<?php

declare(strict_types=1);

namespace App\Enums;

enum Occasion: string
{
    case BIRTHDAY = 'birthday';
    case ANNIVERSARY = 'anniversary';
    case CHRISTMAS = 'christmas';
    case OTHER = 'other';

    public function label(): string
    {
        return match ($this) {
            self::BIRTHDAY => 'Birthday',
            self::ANNIVERSARY => 'Anniversary',
            self::CHRISTMAS => 'Christmas',
            self::OTHER => 'Other',
        };
    }
}
