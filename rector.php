<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use RectorLaravel\Set\LaravelLevelSetList;

return RectorConfig::configure()
    ->withPaths([
        __DIR__.'/app',
        __DIR__.'/bootstrap',
        __DIR__.'/config',
        __DIR__.'/lang',
        __DIR__.'/database',
        __DIR__.'/public',
        __DIR__.'/resources',
        __DIR__.'/routes',
        __DIR__.'/tests',
        //        __DIR__.'/vendor/maksde/helpers',
        //        __DIR__.'/vendor/maksde/support',
    ])
    ->withSkip([
        __DIR__.'/bootstrap/cache',
    ])
    ->withSets([
        LaravelLevelSetList::UP_TO_LARAVEL_120,
    ])
//    ->withPHPStanConfigs([
//        __DIR__.'/phpstan.neon.dist',
//    ])
    ->withCodingStyleLevel(10)
    ->withTypeCoverageLevel(10)
    ->withDeadCodeLevel(10)
    ->withCodeQualityLevel(10);
