<?php
/**
 * Created by PhpStorm.
 * User:  yousuf
 * Date: 11/24/19
 * Time: 1:52 PM
 */

return [
    'port' => env('SOCKET_PORT', 8080),
    'protocol' => env('PROTOCOL', 'http'),
    'ssl_crt' => env('SSL_CERTIFICATE', null),
    'ssl_key' => env('SSL_KEY', null)
];