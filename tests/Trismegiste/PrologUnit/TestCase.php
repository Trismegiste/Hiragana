<?php

/*
 * Prolog Unit Test
 */

namespace tests\Trismegiste\PrologUnit;

use Trismegiste\WamBundle\Prolog\WAMService;

/**
 * TestCase is a template method pattern to test prolog programs
 */
abstract class TestCase extends \PHPUnit_Framework_TestCase
{

    protected static $wam;

    public static function setUpBeforeClass()
    {
        static::$wam = new WAMService();
        static::$wam->loadProlog(static::getProgramPath());
    }

 //   abstract public static function getProgramPath();

    protected function assertAtLeastOneSuccess($query)
    {
        $result = static::$wam->runQuery($query);
        $this->assertTrue(count($result) > 0);
        $this->assertTrue($result[0]->succeed);
    }

    protected function assertSuccessEquals($n, $query)
    {
        $result = static::$wam->runQuery($query);
        $this->assertTrue(count($result) >= $n);
        foreach ($result as $k => $solution) {
            $this->assertEquals($k < $n, $solution->succeed);
        }
    }

}