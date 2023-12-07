<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use App\Enums\SearchMode;
use App\Helpers\DatasetHelper;
use App\NextMinNumberFinder;

const NUM = 88;

$numberFinder = new NextMinNumberFinder(DatasetHelper::random());
$numberFinder->find(NUM, SearchMode::LINEAR);
$numberFinder->find(NUM, SearchMode::BINARY);
$numberFinder->find(NUM, SearchMode::FIBONACCI);
