<?php

namespace AerialShip\Lex;

class Token
{
    /** @var  string */
    protected $token;

    /** @var  string */
    protected $value;

    /** @var  int */
    protected $offset;

    /** @var  int */
    protected $count;

    public function __construct($token, $value, $offset, $count)
    {
        $this->token = $token;
        $this->value = $value;
        $this->offset = $offset;
        $this->count = $count;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @return int
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

}
