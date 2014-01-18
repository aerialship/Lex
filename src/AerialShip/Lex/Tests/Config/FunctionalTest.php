<?php

namespace AerialShip\Lex\Tests\Config;


use AerialShip\Lex\Config\LexConfig;
use AerialShip\Lex\Config\YamlFileConfig;

class FunctionalTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldWork()
    {
        $config = new LexConfig(new YamlFileConfig(__DIR__.'/config1.yml'));
        $arrTokens = $config->getAllTokens();

        $this->assertCount(6, $arrTokens);

        $this->assertEquals("|^\\s|", $arrTokens[0]->getRegex());
        $this->assertEquals('', $arrTokens[0]->getToken());

        $this->assertEquals("|^\\d+|", $arrTokens[1]->getRegex());
        $this->assertEquals('number', $arrTokens[1]->getToken());

        $this->assertEquals("|^\\+|", $arrTokens[2]->getRegex());
        $this->assertEquals('plus', $arrTokens[2]->getToken());

        $this->assertEquals("|^-|", $arrTokens[3]->getRegex());
        $this->assertEquals('minus', $arrTokens[3]->getToken());

        $this->assertEquals("|^\\*|", $arrTokens[4]->getRegex());
        $this->assertEquals('mul', $arrTokens[4]->getToken());

        $this->assertEquals("|^/|", $arrTokens[5]->getRegex());
        $this->assertEquals('div', $arrTokens[5]->getToken());

    }
} 