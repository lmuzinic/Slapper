<?php

namespace Slapper;


class Request
{
    protected $token = '';
    protected $teamUrl = '';

    protected $curlHandler;

    public function __construct(Payload $payload, array $config)
    {
        $this->token = $config['token'];
        $this->teamUrl = $config['teamUrl'];

        $payload->prepare();

        $this->curlHandler = curl_init();
        curl_setopt($this->curlHandler, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curlHandler, CURLOPT_URL, $this->getUrl());
        curl_setopt($this->curlHandler, CURLOPT_POST, 1);
        curl_setopt($this->curlHandler, CURLOPT_POSTFIELDS, 'payload=' . json_encode($payload));
    }

    public function __destruct()
    {
        curl_close($this->curlHandler);
    }

    public function send()
    {
        $response = curl_exec($this->curlHandler);

        return new Response($response);
    }

    public function getUrl()
    {
        return 'https://' . $this->teamUrl . '.slack.com/services/hooks/incoming-webhook?token=' . $this->token;
    }
} 