<?php

/*
 * Hiragana
 */

namespace tests\Trismegiste\Hiragana;

use Trismegiste\Hiragana\Converter;
use Trismegiste\WamBundle\Prolog\Solution\Lis;
use Trismegiste\WamBundle\Prolog\Solution;

/**
 * ConverterTest tests Converter
 */
class ConverterTest extends \PHPUnit_Framework_TestCase
{

    protected $service;
    protected $wam;

    protected function setUp()
    {
        $this->wam = $this->getMockForAbstractClass('Trismegiste\WamBundle\Prolog\PrologContext');
        $this->service = new Converter($this->wam);
    }

    public function testHiragana1()
    {
        $oneSol = new Solution();
        $oneSol->setQueryVar('X', new Lis([
            'ta', 'i', 'shi', new Lis(['ya', 'small']), 'ku', 'te', 'n'
        ]));
        $oneSol->succeed = true;
        $this->wam->expects($this->any())
                ->method('runQuery')
                ->with($this->anything())
                ->will($this->returnValue([$oneSol]));

        $result = $this->service->toHiragana('dontcare');
        $this->assertCount(1, $result);
        $this->assertEquals('たいしゃくてん', $result[0]);
    }

}