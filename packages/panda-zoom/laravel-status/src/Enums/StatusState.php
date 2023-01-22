<?php
declare(strict_types=1);

namespace PandaZoom\LaravelStatus\Enums;

enum StatusState: int
{
    case Draft = 1;
    case Published = 2;
    case Suspended = 3;
    case Archived = 4;
}
