<?php

namespace AerialShip\Lex\Config;

class TokenDefn
{
    /** @var string  */
    protected $regex;

    /** @var string  */
    protected $token;

    /**
     * @param  string                    $regex
     * @param  string                    $token
     * @throws \InvalidArgumentException
     */
    public function __construct($regex, $token)
    {
        $this->regex = "|^{$regex}|";
        $this->token = $token;
        if (preg_match($this->regex, '') === false) {
            throw new \InvalidArgumentException("Invalid regex for token $token : $regex");
        }
    }

    /**
     * @return string
     */
    public function getRegex()
    {
        return $this->regex;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

}
