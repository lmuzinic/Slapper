<?php

namespace Slapper;


class Configuration
{
    public $token;
    public $teamUrl;

    protected $fileName;

    public function __construct($fileName)
    {
        $this->fileName = $fileName;

        $configuration = parse_ini_file($this->fileName);
        $this->token = (isset($configuration['token'])) ? $configuration['token'] : '';
        $this->teamUrl = (isset($configuration['teamUrl'])) ? $configuration['teamUrl'] : '';
    }

    /**
     * Writes configuration into file
     */
    public function save()
    {
        $lines = array();
        $lines[] = "token = " . $this->token;
        $lines[] = "teamUrl = " . $this->teamUrl;

        file_put_contents($this->fileName, implode(PHP_EOL, $lines));
    }
} 