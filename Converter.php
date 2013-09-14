<?php

/*
 * Hiragana
 */

namespace Trismegiste\Hiragana;

include_once __DIR__ . '/vendor/autoload.php';

use Trismegiste\WamBundle\Prolog\WAMService;

/**
 * Converter converts Hepburn notation to Hiragana
 */
class Converter
{

    protected $wam;

    public function __construct()
    {
        $this->wam = new WAMService();
        $this->wam->runQuery("consult('" . __DIR__ . "/rules.pro').");
    }

    public function toHiragana($str)
    {
        $exploded = implode(',', str_split($str));
        return $this->wam->runQuery("solve([$exploded], X).");
    }

}

$obj = new Converter();
$result = $obj->toHiragana($argv[1]);
foreach ($result as $sol) {
    if ($sol->succeed) {
        echo $sol->variable['X'] . PHP_EOL;
    }
}
