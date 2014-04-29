<?php

namespace Slapper;


class Response
{
    protected $success;
    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
        switch ($message) {
            case 'ok':
                $this->success = true;
                break;
            case 'No hooks':
            case 'Payload was not valid JSON':
            case 'No text specified':
            default:
                $this->success = false;
        }
    }

    public function isSuccessful()
    {
        return $this->success;
    }

    public function getMessage()
    {
        return $this->message;
    }
} 