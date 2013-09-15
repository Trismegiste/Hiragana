<?php

/*
 * Hiragana
 */

namespace Trismegiste\Hiragana;

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
