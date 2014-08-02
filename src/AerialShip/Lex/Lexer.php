<?php

namespace AerialShip\Lex;

use AerialShip\Lex\Config\LexConfig;
use AerialShip\Lex\Error\UnknownTokenException;

class Lexer
{
    /** @var \AerialShip\Lex\Config\LexConfig  */
    protected $config;

    /**
     * @param LexConfig $config
     */
    public function __construct(LexConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param  string                                      $input
     * @param  callable                                    $callback
     * @throws \AerialShip\Lex\Error\UnknownTokenException when unable to match a token from input string
     */
    public function tokenizeAsync($input, callable $callback)
    {
        $offset = 0;
        $count = 0;
        $matches = null;
        while (strlen($input)) {
            $anyMatch = false;
            foreach ($this->config->getAllTokens() as $token) {
                if (preg_match($token->getRegex(), $input, $matches)) {
                    $str = $matches[0];
                    $len = strlen($str);
                    if (strlen($token->getToken())>0) {
                        call_user_func($callback, new Token($token->getToken(), $str, $offset, $count));
                        $count++;
                    }
                    $input = substr($input, $len);
                    $anyMatch = true;
                    $offset += $len;
                    break;
                }
            }
            if (!$anyMatch) {
                throw new UnknownTokenException($offset);
            }
        }
        call_user_func($callback, new EOF($offset, $count));
    }

    /**
     * @param  string                                      $input
     * @return Token[]
     * @throws \AerialShip\Lex\Error\UnknownTokenException when unable to match a token from input string
     */
    public function tokenize($input)
    {
        $result = array();
        $this->tokenizeAsync($input, function (Token $token) use (&$result) {
            $result[] = $token;
        });

        return $result;
    }

}
