<?php

/*
 * Hiragana
 */

namespace tests\Trismegiste\Hiragana;

use Trismegiste\Hiragana\Converter;
use Trismegiste\WamBundle\Prolog\WAMService;

/**
 * ConverterTest tests Converter
 */
class ConverterTest extends \PHPUnit_Framework_TestCase
{

    protected $service;

    protected function setUp()
    {
        $this->service = new Converter(new WAMService());
    }

    public function testHiragana1()
    {
        $result = $this->service->toHiragana('taishakuten');
        $this->assertCount(1, $result);
        $this->assertEquals('たいしゃくてん', $result[0]);
    }

    public function testHiragana2()
    {
        $result = $this->service->toHiragana('nippon');
        $this->assertCount(1, $result);
        $this->assertEquals('にっぽん', $result[0]);
    }

}