<?php

namespace Sigfriedseldeslachts\twiliosms\Classes;

use Exception;
use Twilio\Rest\Client;

class Twilio
{
    protected $client;
    public $method;
    public $recipient;
    public $sender;
    public $message;
    public $url;

    public function __construct()
    {
        if(is_null(config('services.twilio')) || config('services.twilio') === "")
        {
            throw new Exception('Twilio not found in services.php');
        }
        elseif(is_null(config('services.twilio.sid')) || config('services.twilio.sid') === "")
        {
            throw new Exception('Twilio SID is not provided.');
        }
        elseif(is_null(config('services.twilio.token')) || config('services.twilio.token') === "")
        {
            throw new Exception('Twilio token is not provided.');
        }

        $this->client = new Client(config('services.twilio.sid'), config('services.twilio.token'));
    }
    
    private function issetMethod()
    {
        if(isset($this->method))
        {
            throw new Exception('You cannot redefine the twilio method');
        }

        return true;
    }

    private function checkNumber($number)
    {
        $number = str_replace('+' , '', $number);

        if(!is_numeric($number))
        {
            throw new Exception('One of the phone numbers you provided is not valid.');
        }

        return $number;
    }

    public function SMS()
    {
        Twilio::issetMethod();

        $this->method = "SMS";

        return $this;
    }

    public function MMS()
    {
        Twilio::issetMethod();

        if(isset($this->method))
        {
            throw new Exception('You cannot redefine the twilio method');
        }

        $this->method = "MMS";

        return $this;
    }

    public function CALL()
    {
        Twilio::issetMethod();

        $this->method = "CALL";

        return $this;
    }

    public function from($number)
    {
        $this->sender = Twilio::checkNumber($number);

        return $this;
    }

    public function to($number)
    {
        $this->recipient = Twilio::checkNumber($number);

        return $this;
    }

    public function message($message)
    {
        $this->message = $message;
        return $this;
    }

    public function url($url)
    {
        $this->url = $url;
        return $this;
    }

    public function start()
    {
        if($this->method === "SMS" && !isset($this->message))
        {
            throw new Exception('No message is provided for SMS.');
        }
        elseif($this->method === "CALL" && !isset($this->url))
        {
            throw new Exception('No TwiML URL is provided for call.');
        }
        elseif($this->method === "MMS")
        {
            if(!isset($this->url))
            {
                throw new Exception('No image URL is provided for MMS.');
            }
            elseif(!isset($this->message))
            {
                throw new Exception('No message is provided for MMS.');
            }
        }

        if(!isset($this->sender))
        {
            if(is_null(config('services.twilio.number')) || config('services.twilio.number') === "")
            {
                throw new Exception('No sender phone number is provided.');
            }

            $this->sender = config('services.twilio.number');
        }

        if($this->method === "SMS" || $this->method === "MMS")
        {
            $data = [
                'from' => $this->sender,
                'body' => $this->message,
            ];

            if($this->method === "MMS")
            {
                $data['mediaUrl'] = $this->url;
            }

            $response = $this->client->messages->create($this->recipient, (array) $data);
        }
        elseif($this->method === "CALL")
        {
            $response = $this->client->calls->create($this->recipient, $this->sender, array('url' => $this->url));
        }

        return $response;
    }
}
