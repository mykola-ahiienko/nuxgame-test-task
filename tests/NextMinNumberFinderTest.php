<?php

declare(strict_types=1);

use App\Enums\SearchMode;
use App\Helpers\DatasetHelper;
use App\NextMinNumberFinder;
use PHPUnit\Framework\TestCase;

class NextMinNumberFinderTest extends TestCase
{
    private const INPUT_VALUE = 10;

    /**
     * @return void
     */
    public function testFind(): void
    {
        $numberFinder = new NextMinNumberFinder(DatasetHelper::random());
        $resultLinear = $numberFinder->find(self::INPUT_VALUE, SearchMode::LINEAR);
        $resultBinary = $numberFinder->find(self::INPUT_VALUE, SearchMode::BINARY);
        $resultFibonacci = $numberFinder->find(self::INPUT_VALUE, SearchMode::FIBONACCI);

        $this->assertLessThan(self::INPUT_VALUE, $resultLinear);
        $this->assertNotEquals(NextMinNumberFinder::ERROR_RESPONSE, $resultLinear);

        $this->assertLessThan(self::INPUT_VALUE, $resultBinary);
        $this->assertNotEquals(NextMinNumberFinder::ERROR_RESPONSE, $resultBinary);

        $this->assertLessThan(self::INPUT_VALUE, $resultFibonacci);
        $this->assertNotEquals(NextMinNumberFinder::ERROR_RESPONSE, $resultFibonacci);
    }
}