<?php

/*
 * Hiragana
 */

include_once __DIR__ . '/vendor/autoload.php';

use Trismegiste\Hiragana\Converter;

$obj = new Converter();
$result = $obj->toHiragana($argv[1]);
foreach ($result as $sol) {
    if ($sol->succeed) {
        print_r($sol->variable['X']);
        $iter = $sol->getQueryVars();
        print_r($iter['X']);
    }
    //echo "さ";
}
