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

    protected $wam;

    protected function setUp()
    {
        $this->wam = new WAMService();
        $this->wam->loadProlog($this->getProgramPath());
    }

    abstract protected function getProgramPath();

    protected function assertAtLeastOneSuccess($query)
    {
        $result = $this->wam->runQuery($query);
        $this->assertTrue(count($result) > 0);
        $this->assertTrue($result[0]->succeed);
    }

    protected function assertSuccessEquals($n, $query)
    {
        $result = $this->wam->runQuery($query);
        $this->assertTrue(count($result) >= $n);
        foreach ($result as $k => $solution) {
            $this->assertEquals($k < $n, $solution->succeed);
        }
    }

}