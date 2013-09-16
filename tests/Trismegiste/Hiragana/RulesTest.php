<?php

/*
 * Hiragana
 */

namespace Package;

use tests\Trismegiste\PrologUnit\TestCase;

/**
 * RulesTest tests the prolog rules for hiragana
 */
class RulesTest extends TestCase
{

    protected function getProgramPath()
    {
        return realpath(__DIR__ . '/../../../src/Trismegiste/Hiragana/rules.pro');
    }

    public function testSimple()
    {
        $this->assertSuccessEquals(1, 'solve([s,a,k,u,r,a], [sa,ku,ra]).');
    }

    public function testDouble()
    {
        $this->assertSuccessEquals(1, 'solve([s,a,k,u,r,a,z,u,k,a], [sa,ku,ra,[su,daku],ka]).');
        $this->assertSuccessEquals(1, 'solve([s,a,k,u,r,a,z,u,k,a], [sa,ku,ra,[tsu,daku],ka]).');
    }

}