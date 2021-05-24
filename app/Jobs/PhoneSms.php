<?php

namespace App\Jobs;
use Twilio\Rest\Client;
use Config;

class PhoneSms
{

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $body;
    protected $phone;

    public function __construct($body,$phone)
    {
        $this->body = $body;
        $this->phone = $phone;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function sendMessage()
    {
        $account_sid = Config("app.TWILIO_SID");
        $auth_token = Config("app.TWILIO_AUTH_TOKEN");
        $twilio_number = Config("app.TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($this->phone, 
                ['from' => $twilio_number, 'body' => $this->body] );
    }
}
