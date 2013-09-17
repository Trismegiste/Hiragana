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

    public function testSimple()
    {
        $this->assertAtLeastOneSuccess('solve([s,a,k,u,r,a], [sa,ku,ra]).');
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

    public function test_sha_equals_shi_plus_small_ya()
    {
        $this->assertSuccessEquals(1, 'solve([s,h,a,o,r,a,n], [shi,[ya,small],o,ra,n]).');
    }

    public function test_shu_equals_shi_plus_small_yu()
    {
        $this->assertSuccessEquals(1, 'solve([a,s,h,u,r,a], [a,shi,[yu,small],ra]).');
    }

    public function test_dakuten1()
    {
        $this->assertAtLeastOneSuccess('solve([z,a,j,i,z,u,z,e,z,o], [[sa,daku], [shi,daku], [su,daku], [se,daku], [so,daku]]).');
    }

    public function test_dakuten2()
    {
        $this->assertAtLeastOneSuccess('solve([d,a,b,i,g,u,z,u,d,o], [[ta,daku], [hi,daku], [ku,daku], [tsu,daku], [to,daku]]).');
    }

    public function test_handakuten()
    {
        $this->assertAtLeastOneSuccess('solve([p,a,p,i,p,u,p,e,p,o], [[ha,handa], [hi,handa], [fu,handa], [he,handa], [ho,handa]]).');
    }

    public function testSmallTsu()
    {
        $this->assertAtLeastOneSuccess('solve([a,t,t,a,k,k,a,p,p,a], [a,[tsu,small],ta,[tsu,small],ka,[tsu,small],[ha,handa]]).');
    }

    public function testJu()
    {
        $this->assertAtLeastOneSuccess('solve([j,u,n,k,u,n], [[shi,daku],[yu,small],n,ku,n]).');
    }

    public function test3Letter()
    {
        $this->assertAtLeastOneSuccess('solve([t,s,u,c,h,i,n,o,s,h,i], [tsu,chi,no,shi]).');
    }

    public function testLittleYx()
    {
        $this->assertAtLeastOneSuccess('solve([s,h,o,u,c,h,u], [shi,[yo,small],u,chi,[yu,small]]).');
    }

    public function testLetterNWithVowel()
    {
        $this->assertSuccessEquals(1, 'solve([k,u,s,a,n,a,g,i],[ku,sa,na,[ki,daku]]).');
    }

    public function testLetterN()
    {
        $this->assertSuccessEquals(1, 'solve([s,h,i,n,k,u],[shi,n,ku]).');
    }

    public function testKyo()
    {
        $this->assertSuccessEquals(1, 'solve([t,o,u,k,y,o,u], [to,u,ki,[yo,small],u]).');
    }

    public function testHandakutenAndSmallTsu()
    {
        $this->assertSuccessEquals(1, 'solve([p,o,p,p,i,p,o], [[ho,handa],[tsu,small],[hi,handa],[ho,handa]]).');
    }

    public function testMyu()
    {
        $this->assertSuccessEquals(1, 'solve([p,a,m,y,u], [[ha,handa],mi,[yu,small]]).');
    }

    public function testOnlyVowel()
    {
        $this->assertSuccessEquals(1, 'solve([a,o,i], [a,o,i]).');
    }

}