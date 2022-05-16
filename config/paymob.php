<?php


return [

    /*
    |--------------------------------------------------------------------------
    | PayMob Default Order Model
    |--------------------------------------------------------------------------
    |
    | This option defines the default Order model.
    |
    */

    'order' => [
        'model' => 'App\Order'
    ],

    /*
    |--------------------------------------------------------------------------
    | PayMob username and password
    |--------------------------------------------------------------------------
    |
    | This is your PayMob username and password to make auth request.
    |
    */

    "api_key" => env('API_TOKEN','ZXlKaGJHY2lPaUpJVXpVeE1pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SmpiR0Z6Y3lJNklrMWxjbU5vWVc1MElpd2ljSEp2Wm1sc1pWOXdheUk2TVRVNU1EUTNMQ0p1WVcxbElqb2lNVFkxTURZM01qVTBNeTR3TXpVMU56Z2lmUS5CZ1pheDI0SFBjRVBwRERFQWw2NEtoWVlxNFlUYzdqZVJQNjRvQjRWWkRCcFFFcHZMU2tlcW1EYzZWMzcxcnhidFdjRUhxdGlZd0ZSaDhObUpveGdLZw=='),

    /*
    |--------------------------------------------------------------------------
    | PayMob integration id and iframe id
    |--------------------------------------------------------------------------
    |
    | This is your PayMob integration id and iframe id.
    |
    */

    'iframe_id' => env('I_FRAME_ID',353244),
    'integration_id' => env('INTEGRATION_ID',1998615),
];
