<?php

declare(strict_types=1);

namespace App\Helpers;

class DatasetHelper
{
    /**
     * @return int[]
     */
    public static function random(): array
    {
        $random = range(0, 100);
        shuffle($random );

        return array_slice($random ,0,10);
    }

    /**
     * @param int $count
     * @return int[]
     */
    public static function fibonacci(int $count): array
    {
        $fibonacci = [0, 1];

        for ($i = 2; $i <= $count; $i++) {
            $fibonacci[$i] = $fibonacci[$i - 1] + $fibonacci[$i - 2];
        }

        return $fibonacci;
    }
}