<?php

namespace Slapper;


class Payload
{
    use Helper;

    public $channel;
    public $username;
    public $text;
    public $icon_emoji;
    public $fallback;
    public $pretext;
    public $color;
    public $fields = array();

    public function __construct($text)
    {
        $this->text = $text;
    }

    public function append(Field $field)
    {
        $field->prepare();
        $this->fields[] = $field;
    }
}