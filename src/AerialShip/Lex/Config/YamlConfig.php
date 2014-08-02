<?php

namespace AerialShip\Lex\Config;

use Symfony\Component\Yaml\Yaml;

class YamlConfig implements ConfigProviderInterface
{
    /** @var  array */
    protected $config;

    public function __construct($yaml)
    {
        $this->config = Yaml::parse($yaml);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->config;
    }

}
