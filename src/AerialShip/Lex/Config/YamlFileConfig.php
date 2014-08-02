<?php

namespace AerialShip\Lex\Config;

class YamlFileConfig extends YamlConfig
{
    public function __construct($file)
    {
        $yaml = file_get_contents($file);
        parent::__construct($yaml);
    }

}
