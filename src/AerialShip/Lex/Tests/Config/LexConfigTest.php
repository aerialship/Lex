<?php

namespace AerialShip\Lex\Tests\Config;

use AerialShip\Lex\Config\LexConfig;

class LexConfigTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldConstructWithArrayParam()
    {
        new LexConfig(array());
    }

    /**
     * @test
     */
    public function shouldConstructWithConfigProviderInterfaceParam()
    {
        $mock = $this->getMock('AerialShip\Lex\Config\ConfigProviderInterface');
        $mock->expects($this->any())->method('toArray')->will($this->returnValue(array()));
        new LexConfig($mock);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function shouldThrowIfConstructedWithInvalidParam()
    {
        new LexConfig('something');
    }

    /**
     * @test
     */
    public function shouldReturnArrayOfTokenDefnWhenGetAllTokensCalled()
    {
        $config = new LexConfig(array('a'=>'aaa', 'b'=>'bbb'));
        $arrTokens = $config->getAllTokens();

        $this->assertInternalType('array', $arrTokens);
        $this->assertContainsOnlyInstancesOf('AerialShip\Lex\Config\TokenDefn', $arrTokens);
    }

}
