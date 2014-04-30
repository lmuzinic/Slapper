<?php

namespace Slapper;


class Payload
{
    use Helper;

    public $channel;
    public $username;
    public $text;
    public $icon_emoji;

    public function __construct($text)
    {
        $this->text = $text;
    }

    {
    }
}