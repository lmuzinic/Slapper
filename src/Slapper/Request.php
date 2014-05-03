<?php

namespace Slapper;


class Request
{
    protected $payload;
    protected $curlHandler;

    public function __construct(Payload $payload, Configuration $config)
    {
        $payload->prepare();
        $this->payload = json_encode($payload);

        $this->curlHandler = curl_init();
        curl_setopt($this->curlHandler, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curlHandler, CURLOPT_URL, 'https://' . $config->teamUrl . '.slack.com/services/hooks/incoming-webhook?token=' . $config->token);
        curl_setopt($this->curlHandler, CURLOPT_POST, 1);
        curl_setopt($this->curlHandler, CURLOPT_POSTFIELDS, 'payload=' . $this->payload);
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

    public function getPayload()
    {
        return $this->payload;
    }
} 