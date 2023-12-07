<?php

declare(strict_types=1);

namespace App\Enums;

enum SearchMode
{
    case LINEAR;
    case BINARY;
    case FIBONACCI;
}