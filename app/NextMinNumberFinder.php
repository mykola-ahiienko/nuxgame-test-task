<?php

declare(strict_types=1);

namespace App;

use App\Enums\SearchMode;
use App\Helpers\DatasetHelper;

class NextMinNumberFinder
{
    public const ERROR_RESPONSE = -1;

    /**
     * @var int[]
     */
    private array $dataset;

    /**
     * @param array $dataset
     */
    public function __construct(array $dataset)
    {
        sort($dataset);
        $this->dataset = $dataset;
    }

    /**
     * @param int $inputValue
     * @param SearchMode $mode
     * @return int
     */
    public function find(int $inputValue, SearchMode $mode): int
    {
        return match ($mode) {
            SearchMode::LINEAR => $this->linear($inputValue),
            SearchMode::BINARY => $this->binary($inputValue),
            SearchMode::FIBONACCI => $this->fibonacci($inputValue),
        };
    }

    /**
     * @param int $inputValue
     * @param int $index
     * @param int $value
     * @return bool
     */
    private function isNextLeast(int $inputValue, int $index, int $value): bool
    {
        return $inputValue > $value
            && (
                array_key_exists($index + 1, $this->dataset)
                && $inputValue <= $this->dataset[$index + 1]
            );
    }

    /**
     * @param int $inputValue
     * @return int
     */
    private function linear(int $inputValue): int
    {
        foreach ($this->dataset as $index => $number) {
            if ($this->isNextLeast($inputValue, $index, $number)) {
                return $number;
            }
        }

        return self::ERROR_RESPONSE;
    }

    /**
     * @param int $inputValue
     * @param int $start
     * @param int|null $end
     * @return int
     */
    private function binary(int $inputValue, int $start = 0, ?int $end = null): int
    {
        if (is_null($end)) {
            $end = count($this->dataset) - 1;
        }

        if ($start > $end) {
            return self::ERROR_RESPONSE;
        }

        $middleIndex = (int)(($start + $end) / 2);

        if (!$this->isNextLeast($inputValue, $middleIndex, $this->dataset[$middleIndex])) {
            if ($inputValue <= $this->dataset[$middleIndex]) {
                $end = $middleIndex -1;
            }

            if ($inputValue > $this->dataset[$middleIndex]) {
                $start = $middleIndex + 1;
            }

            return $this->binary($inputValue, $start, $end);
        }

        return $this->dataset[$middleIndex];
    }

    /**
     * @param int $inputValue
     * @return int
     */
    private function fibonacci(int $inputValue): int
    {
        $fibonacci = DatasetHelper::fibonacci(count($this->dataset));
        $start = 0;
        $end = count($this->dataset) - 1;

        while ($start <= $end) {
            $middleIndex = $start + (int)($fibonacci[($end - $start) / 2] / 2);

            if (!$this->isNextLeast($inputValue, $middleIndex, $this->dataset[$middleIndex])) {
                if ($inputValue <= $this->dataset[$middleIndex]) {
                    $end = $middleIndex -1;
                }

                if ($inputValue > $this->dataset[$middleIndex]) {
                    $start = $middleIndex + 1;
                }
            } else {
                return $this->dataset[$middleIndex];
            }
        }

        return self::ERROR_RESPONSE;
    }
}