<?php

namespace AerialShip\Lex;


class EOF extends Token
{
    public function __construct($offset, $count)
    {
        parent::__construct(null, null, $offset, $count);
    }
}
