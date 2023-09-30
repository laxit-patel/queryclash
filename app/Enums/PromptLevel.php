<?php

namespace App\Enums;

class PromptLevel
{
    const EASY = 'Easy';
    const MEDIUM = 'Medium';
    const HARD = 'Hard';

    public static function all(): array
    {
        return [
            self::EASY,
            self::MEDIUM,
            self::HARD,
        ];
    }
}
