<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class PayMob{

    private const API_TOKEN = 'ZXlKaGJHY2lPaUpJVXpVeE1pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SmpiR0Z6Y3lJNklrMWxjbU5vWVc1MElpd2ljSEp2Wm1sc1pWOXdheUk2TVRVNU1EUTNMQ0p1WVcxbElqb2lNVFkxTURZM01qVTBNeTR3TXpVMU56Z2lmUS5CZ1pheDI0SFBjRVBwRERFQWw2NEtoWVlxNFlUYzdqZVJQNjRvQjRWWkRCcFFFcHZMU2tlcW1EYzZWMzcxcnhidFdjRUhxdGlZd0ZSaDhObUpveGdLZw==';
    private const iframe_id = 353244;
    private const integration_id = 1998615;

    public function getIframeId(){
        return self::iframe_id;
    }

    public function getIntegrationId(){
        return self::integration_id;
    }

    protected function cURL($url, $json)
    {
        $response = Http::withOptions([
            'verify' => false,
        ])->accept('application/json')
            ->post($url, $json);


        return json_decode($response->body());
    }

    protected function GETcURL($url)
    {

        $response = Http::withOptions([
            'verify' => false,
        ])->accept('application/json')
            ->get($url);

        return json_decode($response->body());
    }

    public function authPaymob()
    {
        // Request body
        $json = [
            'api_key' => $this::API_TOKEN,
        ];

        // Send curl
        $auth = $this->cURL(
            'https://accept.paymob.com/api/auth/tokens',
            $json
        );

        return $auth;
    }

    public function makeOrderPaymob($token ,$amount_cents , $items)
    {
        // Request body
        $json = [
            'amount_cents'           => $amount_cents,
            'currency'               => 'EGP',
            'notify_user_with_email' => true,
            'items'                  => $items,
            'auth_token'             => $token ,
            
        ];

        // Send curl
        $order = $this->cURL(
            'https://accept.paymob.com/api/ecommerce/orders',
            $json
        );

        return $order;
    }

    public function getPaymentKeyPaymob(
        $token,
        $amount_cents,
        $order_id,
        $email   ,
        $fname   ,
        $lname   ,
        $phone   ,
        $city    ,
        $country ,
        $post
    ) {
        // Request body
        $json = [
            'auth_token'   => $token,
            'amount_cents' => $amount_cents,
            'expiration'   => 36000,
            'order_id'     => $order_id,
            "billing_data" => [
                "email"        => $email,
                "first_name"   => $fname,
                "last_name"    => $lname,
                "phone_number" => $phone,
                "city"         => $city,
                "country"      => $country,
                "postal_code"  => $post,
                'street'       => 'null',
                'building'     => 'null',
                'floor'        => 'null',
                'apartment'    => 'null'
            ],
            'currency'            => 'EGP',
            'card_integration_id' => self::integration_id
        ];

        // Send curl
        $payment_key = $this->cURL(
            'https://accept.paymob.com/api/acceptance/payment_keys',
            $json
        );

        return $payment_key;
    }


    public function makePayment(
        $token,
        $card_number,
        $card_holdername,
        $card_expiry_mm,
        $card_expiry_yy,
        $card_cvn,
        $order_id,
        $firstname,
        $lastname,
        $email,
        $phone ,
        $postal_code,
        $city,
        $country
    ) {
        // JSON body.
        $json = [
            'source' => [
                'identifier'        => $card_number,
                'sourceholder_name' => $card_holdername,
                'subtype'           => 'CARD',
                'expiry_month'      => $card_expiry_mm,
                'expiry_year'       => $card_expiry_yy,
                'cvn'               => $card_cvn
            ],
            'billing' => [
                'first_name'   => $firstname,
                'last_name'    => $lastname,
                'email'        => $email,
                'phone'        => $phone,
                'postal_code' => $postal_code,
                'city' => $city,
                'country' => $country,
            ],
            'payment_token' => $token
        ];

        // Send curl
        $payment = $this->cURL(
            'https://accept.paymobsolutions.com/api/acceptance/payments/pay',
            $json
        );

        return $payment;
    }


    public function capture($token, $transactionId, $amount)
    {
        // JSON body.
        $json = [
            'transaction_id' => $transactionId,
            'amount_cents'   => $amount
        ];

        // Send curl.
        $res = $this->cURL(
            'https://accept.paymobsolutions.com/api/acceptance/capture?token='.$token,
            $json
        );

        return $res;
    }

    public function getOrders($authToken, $page = 1)
    {
        $orders = $this->GETcURL(
            "https://accept.paymobsolutions.com/api/ecommerce/orders?page={$page}&token={$authToken}"
        );

        return $orders;
    }

    public function getOrder($authToken, $orderId)
    {
        $order = $this->GETcURL(
            "https://accept.paymobsolutions.com/api/ecommerce/orders/{$orderId}?token={$authToken}"
        );

        return $order;
    }

    public function getTransactions($authToken, $page = 1)
    {
        $transactions = $this->GETcURL(
            "https://accept.paymobsolutions.com/api/acceptance/transactions?page={$page}&token={$authToken}"
        );

        return $transactions;
    }

    /**
     * Get PayMob transaction.
     *
     * @param  string  $authToken
     * @param  int  $transactionId
     * @return Response
     */
    public function getTransaction($authToken, $transactionId)
    {
        $transaction = $this->GETcURL(
            "https://accept.paymobsolutions.com/api/acceptance/transactions/{$transactionId}?token={$authToken}"
        );

        return $transaction;
    }


}


