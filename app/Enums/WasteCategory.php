<?php

namespace App\Enums;

enum WasteCategory: string
{
    case PLASTIK = 'Plastik';
    case KERTAS = 'Kertas';
    case BOTOL_PLASTIK = 'Botol Plastik';
    case BESI = 'Besi';

    public function points(): int
    {
        return match($this) {
            self::PLASTIK => 100,
            self::KERTAS => 100,
            self::BOTOL_PLASTIK => 150,
            self::BESI => 250,
        };      
    }
}
