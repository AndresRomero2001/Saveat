<?php

namespace App\Enums;

enum Role: int
{
    case Admin = 1;
    case User = 2;

    public function label(): string
    {
        return match ($this) {
            self::Admin => 'Admin',
            self::User => 'User',
        };
    }
}

