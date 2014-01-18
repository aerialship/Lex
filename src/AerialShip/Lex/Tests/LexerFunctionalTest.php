<?php

namespace AerialShip\Lex\Tests;

use AerialShip\Lex\Config\LexConfig;
use AerialShip\Lex\Config\YamlFileConfig;
use AerialShip\Lex\Error\UnknownTokenException;
use AerialShip\Lex\Lexer;
use AerialShip\Lex\Token;


class LexerFunctionalTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldWork()
    {
        $config = new LexConfig(new YamlFileConfig(__DIR__.'/Config/config1.yml'));
        $lexer = new Lexer($config);

        $arr = $lexer->tokenize(' 2131 + 33   / 567');
        $this->assertTokens($arr);
    }


    /**
     * @test
     */
    public function shouldWorkAsync()
    {
        $config = new LexConfig(new YamlFileConfig(__DIR__.'/Config/config1.yml'));
        $lexer = new Lexer($config);

        $arr = array();
        $lexer->tokenizeAsync(' 2131 + 33   / 567', function(Token $token) use (&$arr) {
            $arr[] = $token;
        });

        $this->assertTokens($arr);
    }


    /**
     * @test
     */
    public function shouldFailAtBadOffset()
    {
        $config = new LexConfig(new YamlFileConfig(__DIR__.'/Config/config1.yml'));
        $lexer = new Lexer($config);

        try {
            $lexer->tokenize(' 2131 + blabla');
        } catch (UnknownTokenException $ex) {
            $this->assertEquals(8, $ex->getOffset());
            return;
        }

        $this->fail('Expected UnknownTokenException');
    }

    /**
     * @test
     */
    public function shouldFailAtBadOffsetAsync()
    {
        $config = new LexConfig(new YamlFileConfig(__DIR__.'/Config/config1.yml'));
        $lexer = new Lexer($config);

        try {
            $lexer->tokenizeAsync(' 2131 + blabla', function($token) { });
        } catch (UnknownTokenException $ex) {
            $this->assertEquals(8, $ex->getOffset());
            return;
        }

        $this->fail('Expected UnknownTokenException');
    }


    /**
     * @param Token[] $arr
     */
    protected function assertTokens($arr)
    {
        $this->assertInternalType('array', $arr);
        $this->assertCount(5, $arr);
        $this->assertContainsOnlyInstancesOf('AerialShip\Lex\Token', $arr);

        $this->assertEquals('number', $arr[0]->getToken());
        $this->assertEquals('2131', $arr[0]->getValue());
        $this->assertEquals(1, $arr[0]->getOffset());
        $this->assertEquals(0, $arr[0]->getCount());

        $this->assertEquals('plus', $arr[1]->getToken());
        $this->assertEquals('+', $arr[1]->getValue());
        $this->assertEquals(6, $arr[1]->getOffset());
        $this->assertEquals(1, $arr[1]->getCount());

        $this->assertEquals('number', $arr[2]->getToken());
        $this->assertEquals('33', $arr[2]->getValue());
        $this->assertEquals(8, $arr[2]->getOffset());
        $this->assertEquals(2, $arr[2]->getCount());

        $this->assertEquals('div', $arr[3]->getToken());
        $this->assertEquals('/', $arr[3]->getValue());
        $this->assertEquals(13, $arr[3]->getOffset());
        $this->assertEquals(3, $arr[3]->getCount());

        $this->assertEquals('number', $arr[4]->getToken());
        $this->assertEquals('567', $arr[4]->getValue());
        $this->assertEquals(15, $arr[4]->getOffset());
        $this->assertEquals(4, $arr[4]->getCount());
    }
}