<?php

/*
 * Hiragana
 */

namespace tests\Trismegiste\Hiragana;

use Trismegiste\Hiragana\Converter;

/**
 * ConverterTest tests Converter
 */
class ConverterTest extends \PHPUnit_Framework_TestCase
{

    protected $service;

    protected function setUp()
    {
        $this->service = new Converter();
    }

    public function testHiragana()
    {
        $result = $this->service->toHiragana('taishakuten');
        $this->assertEquals('たいしゃくてん', $result[0]);
    }

}