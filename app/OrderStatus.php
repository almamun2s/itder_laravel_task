<?php

namespace App\Enum;

enum OrderStatus: string
{
    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case COMPLETED = 'completed';
    case CANCELLED = 'canceled';

    public static function isValidValue(string $value): bool
    {
        return in_array($value, array_column(self::cases(), 'value'));
    }
}
