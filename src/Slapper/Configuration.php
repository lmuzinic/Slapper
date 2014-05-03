<?php

namespace Slapper;

use Slapper\Exception\ValidateException;

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
     * Checks if everything is as it should be
     *
     * @throws Exception\ValidateException
     */
    protected function validate()
    {
        if (is_null($this->token)) {
            throw new ValidateException('Token must not be null');
        }

        if (is_null($this->teamUrl)) {
            throw new ValidateException('Team URL must not be null');
        }
    }

    /**
     * Writes configuration into file
     *
     * @return int number of bytes saved into configuration file
     */
    public function save()
    {
        $this->validate();

        $lines = array();
        $lines[] = "token = " . $this->token;
        $lines[] = "teamUrl = " . $this->teamUrl;

        return file_put_contents($this->fileName, implode(PHP_EOL, $lines));
    }
} 