<?php

/*
 * Hiragana
 */

namespace tests\Trismegiste\Hiragana;

use tests\Trismegiste\PrologUnit\TestCase;

/**
 * RulesTest tests the prolog rules for hiragana
 */
class RulesTest extends TestCase
{

    public static function getProgramPath()
    {
        return realpath(__DIR__ . '/../../../src/Trismegiste/Hiragana/rules.pro');
    }

    public function getConversion()
    {
        return [
            ['s,a,k,u,r,a', 'sa,ku,ra'],
            ['z,a,j,i,z,u,z,e,z,o', '[sa,daku], [shi,daku], [su,daku], [se,daku], [so,daku]'],
            ['d,a,b,i,g,u,z,u,d,o', '[ta,daku], [hi,daku], [ku,daku], [tsu,daku], [to,daku]'],
            ['p,a,p,i,p,u,p,e,p,o', '[ha,handa], [hi,handa], [fu,handa], [he,handa], [ho,handa]'],
            ['a,t,t,a,k,k,a,p,p,a', 'a,[tsu,small],ta,[tsu,small],ka,[tsu,small],[ha,handa]'],
            ['j,u,n,k,u,n', '[shi,daku],[yu,small],n,ku,n'],
            ['t,s,u,c,h,i,n,o,s,h,i', 'tsu,chi,no,shi'],
            ['s,h,o,u,c,h,u', 'shi,[yo,small],u,chi,[yu,small]']
        ];
    }

    /**
     * @dataProvider getConversion
     */
    public function testAtLeastOneResult($hepburn, $hiragana)
    {
        $this->assertAtLeastOneSuccess("solve([$hepburn], [$hiragana]).");
    }

    public function getUniqueConversion()
    {
        return [
            ['s,h,a,o,r,a,n', 'shi,[ya,small],o,ra,n'],
            ['a,s,h,u,r,a', 'a,shi,[yu,small],ra'],
            ['k,u,s,a,n,a,g,i', 'ku,sa,na,[ki,daku]'],
            ['s,h,i,n,k,u', 'shi,n,ku'],
            ['t,o,u,k,y,o,u', 'to,u,ki,[yo,small],u'],
            ['p,o,p,p,i,p,o', '[ho,handa],[tsu,small],[hi,handa],[ho,handa]'],
            ['p,a,m,y,u', '[ha,handa],mi,[yu,small]'],
            ['a,o,i', 'a,o,i']
        ];
    }

    /**
     * @dataProvider getUniqueConversion
     */
    public function testUniqueResult($hepburn, $hiragana)
    {
        $this->assertSuccessEquals(1, "solve([$hepburn], [$hiragana]).");
    }

    public function testMultiple()
    {
        $this->assertSuccessEquals(2, 'solve([s,a,k,u,r,a,z,u,k,a], X).');
    }

    public function testDoubleSolution()
    {
        $this->assertSuccessEquals(1, 'solve([s,a,k,u,r,a,z,u,k,a], [sa,ku,ra,[su,daku],ka]).');
        $this->assertSuccessEquals(1, 'solve([s,a,k,u,r,a,z,u,k,a], [sa,ku,ra,[tsu,daku],ka]).');
    }

}