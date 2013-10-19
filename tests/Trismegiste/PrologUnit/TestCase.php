<?php

/*
 * Prolog Unit Test
 */

namespace tests\Trismegiste\PrologUnit;

use Trismegiste\Prolog\WAMService;

/**
 * TestCase is a template method pattern to test prolog programs
 */
abstract class TestCase extends \PHPUnit_Framework_TestCase
{

    protected static $wam;

    public static function setUpBeforeClass()
    {
        $fqcn = get_called_class();
        static::$wam = new WAMService();
        static::$wam->loadProlog($fqcn::getProgramPath());
    }

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