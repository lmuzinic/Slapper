<?php

namespace Slapper;


trait Helper
{
    public function prepare()
    {
        foreach($this as &$property)
        {
            if (is_string($property)) {
                $property = rawurlencode($property);
            }
        }
    }
} 