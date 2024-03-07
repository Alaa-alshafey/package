<?php

namespace App\Http\Traits;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;


trait Paypalable
{

    /**
     * Paypal Configuration
     * @var
     */
    protected $apiContext;
    protected $accounts = [
        'client_id' => 'Aa7gfTy5uMj8zqNjs82LYYEevm-iLSk7zf-XRSqJx9BhLfQ4phhGHRYrApcFbj5s6_NkFOZue_VAcWGn',
        'secret_client' => 'EOuB7C1glO-7sTrw7Y0zYbcFqH9Uf8dKbmZYuw3ilgEuQ-rErMp-WICVhB4S95ZTOOZOmKIb5sYXzzrl',
    ];
    protected $settings = ['mode' => 'sandbox', 'http.ConnectionTimeOut' => 30,
        'log.logEnable' => true, 'logFileName' => '/logs/paypal.log'];


    /**
     * Configure Client_id,Secret_client
     * Context
     */
    public function setApiContext(){

        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $this->accounts['client_id'],
                $this->accounts['secret_client']
            )
        );

        $this->apiContext->setConfig($this->settings);

    }



}