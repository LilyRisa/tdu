<?php

namespace App\Jobs;
use Twilio\Rest\Client;

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
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($this->phone, 
                ['from' => $twilio_number, 'body' => $this->body] );
    }
}
