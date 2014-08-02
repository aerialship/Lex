<?php

namespace AerialShip\Lex\Tests;

use AerialShip\Lex\Token;

class TokenTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldConstructWithRequiredArgs()
    {
        new Token('token', 'value', 10, 1);
    }

    /**
     * @test
     */
    public function shouldReturnValuesGivenInConstructor()
    {
        $t = new Token($token = 'token', $value = 'value', $offset = 10, $count = 1);

        $this->assertEquals($token, $t->getToken());
        $this->assertEquals($value, $t->getValue());
        $this->assertEquals($offset, $t->getOffset());
        $this->assertEquals($count, $t->getCount());
    }

}
