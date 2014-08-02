<?php

namespace AerialShip\Lex\Config;

class LexConfig
{
    /** @var TokenDefn[] */
    protected $tokens = array();

    /**
     * @param  array|ConfigProviderInterface $config
     * @throws \InvalidArgumentException
     */
    public function __construct($config)
    {
        if ($config instanceof ConfigProviderInterface) {
            $config = $config->toArray();
        }
        if (!is_array($config)) {
            throw new \InvalidArgumentException('$config must be either array or ConfigProviderInterface');
        }
        foreach ($config as $pattern=>$token) {
            $this->tokens[] = new TokenDefn($pattern, $token);
        }
    }

    /**
     * @return TokenDefn[]
     */
    public function getAllTokens()
    {
        return $this->tokens;
    }

    public function add(TokenDefn $token)
    {
        $this->tokens[] = $token;
    }

}
