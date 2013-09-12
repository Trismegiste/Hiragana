<?php

/*
 * Hiragana Bridge
 */

namespace Trismegiste\HiraganaBridge;

include_once __DIR__ . '/vendor/autoload.php';

use Trismegiste\WamBundle\Prolog\WAMService;

/**
 * Converter converts Hepburn notation to Hiragana and vice-versa
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
        $solve = $this->wam->runQuery("[k,u,s,a,n,a,g,i], X).");
        print_r($solve);
    }

}

$obj = new Converter();
$obj->toHiragana('r');
