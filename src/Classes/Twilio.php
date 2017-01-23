<?php

namespace Sigfriedseldeslachts\twiliosms\Classes;

use Twilio\Rest\Client;

class Twilio
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(env('TWILIO_SID', ''), env('TWILIO_TOKEN'));
    }

    public function SMS($to, $body, $from = null)
    {
        if($from === null)
        {
            $from = env('TWILIO_NUMBER');
        }

        $to = str_replace('+', '', $to);

        $sms = $this->client->messages->create(
            $to,
            array(
                'from' => $from,
                'body' => $body,
            )
        );

        return $sms;
    }

    public function MMS($to, $body, $url, $from = null)
    {
        if($from === null)
        {
            $from = env('TWILIO_NUMBER');
        }

        $to = str_replace('+', '', $to);

        $mms = $this->client->messages->create(
            $to,
            array(
                'from' => $from,
                'body' => $body,
                'mediaUrl' => $url,
            )
        );

        return $mms;
    }

    public function Call($to, $url, $from = null)
    {
        if($from === null)
        {
            $from = env('TWILIO_NUMBER');
        }

        $to = str_replace('+', '', $to);

        $call = $this->client->calls->create(
            $to,
            $from,
            array(
                'url' => $url
            )
        );

        return $call;
    }
}
