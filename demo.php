<?php

/*
 * Hiragana - a small piece of code for demonstrating
 */

include_once __DIR__ . '/vendor/autoload.php';

use Trismegiste\Hiragana\Converter;
use Trismegiste\Prolog\WAMService;

$obj = new Converter(new WAMService());
$result = $obj->toHiragana($argv[1]);
print_r($result);