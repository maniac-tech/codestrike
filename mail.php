<?php
require 'vendor/autoload.php';

use SparkPost\SparkPost;
use GuzzleHttp\Client;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;

$httpClient = new GuzzleAdapter(new Client());
$sparky = new SparkPost($httpClient, ["key" => getEnv("SPARKPOST_API_KEY_IMAC_DELIEVERY")]);
$promise = $sparky->transmissions->post([
    'content' => [
        'from' => [
            'name' => 'SparkPost Team',
            'email' => 'imac@codestrike.in',
        ],
        'subject' => 'First Mailing From PHP',
        'html' => '<html>
        <body style="background-color: grey">
        <table style="background-color: white;">
        <tr>
        <td style="width: 100%;"><img src="img/logo.png" alt="" style="width: 25%; align-content: center;"></td>
        </tr>
        <tr>
        <td>
        <p>
        Hi User,
        </p>
        <p>
        Your Registration has been confirmed.
        You will be receiving the batch details and other event details soon via mail.
        Make sure you check your Inbox and <b>Spam</b> folder regularly.
        <br>
        Thank You,<br>
        Team CodeStrike.
        </p>
        </td>
        </tr>
        </table>
        </body>
        </html>',
        // 'text' => 'Congratulations, {{name}}! You just sent your very first mailing!',
    ],
    'substitution_data' => ['name' => 'iMac'],
    'recipients' => [
        [
            'address' => [
                'name' => 'Abhishek Jain',
                'email' => 'ajj.2396@gmail.com',
            ],
        ],
    ],
]);
try {
    $response = $promise->wait();
    echo "try:";
    echo $response->getStatusCode()."\n";
    print_r($response->getBody())."\n";
} catch (\Exception $e) {
    echo $e->getCode()."\n";
    echo $e->getMessage()."\n";
}