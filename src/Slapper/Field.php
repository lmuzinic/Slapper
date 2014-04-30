<?php

namespace Slapper;


class Field
{
    use Helper;

    public $title = '';
    public $value = '';
    public $short = true;

    public function __construct($title = '', $value = '')
    {
        $this->title = $title;
        $this->value = $value;
    }
} 