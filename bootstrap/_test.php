<?php

include __DIR__.'/../vendor/autoload.php';

$kernel = \AspectMock\Kernel::getInstance();
$kernel->init([
    'debug' => true,
    'cacheDir' => '/tmp/l4',
    'includePaths' => [__DIR__.'/../vendor/laravel', __DIR__.'/../app']
]);

$app = require_once __DIR__.'/start.php';