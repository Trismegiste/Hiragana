<?php

/*
 * Hiragana - a small piece of code for demonstrating
 */

include_once __DIR__ . '/vendor/autoload.php';

use Trismegiste\Hiragana\Converter;

$obj = new Converter();
$result = $obj->toHiragana($argv[1]);
print_r($result);