<?php

namespace Slapper;


class Payload
{
    public $channel;
    public $username;
    public $text;
    public $icon_emoji;

    public function __construct($text)
    {
        $this->text = $text;
    }

    public function prepare()
    {
        foreach($this as &$property)
        {
            $property = rawurlencode($property);
        }
    }
}