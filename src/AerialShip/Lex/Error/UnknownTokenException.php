<?php

namespace AerialShip\Lex\Error;

class UnknownTokenException extends \RuntimeException
{
    /** @var  int */
    protected $offset;

    public function __construct($offset, $code = 0, \Exception $previous = null)
    {
        $this->offset = $offset = intval($offset);
        parent::__construct("Unknown token at offset $offset", $code, $previous);
    }

    /**
     * @return int
     */
    public function getOffset()
    {
        return $this->offset;
    }

}
