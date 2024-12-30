<?php

namespace App\Enums;

enum PriceRange: int
{
    case ONE = 1;
    case TWO = 2;
    case THREE = 3;
    case FOUR = 4;
    case FIVE = 5;
    case SIX = 6;
    case SEVEN = 7;
    case EIGHT = 8;
    case NINE = 9;
    case TEN = 10;

    public function label(): string
    {
        return match($this) {
            self::ONE => '0-10€',
            self::TWO => '10-20€',
            self::THREE => '20-30€',
            self::FOUR => '30-40€',
            self::FIVE => '40-50€',
            self::SIX => '50-80€',
            self::SEVEN => '80-100€',
            self::EIGHT => '100-150€',
            self::NINE => '150-250€',
            self::TEN => '+250€',
        };
    }
}
