<?php

namespace Razorpay\Tests;

use Razorpay\Api\Api;
use Razorpay\Api\Entity;
use Razorpay\Api\Request;

class RazorpayTest extends \PHPUnit_Framework_TestCase
{
    function setUp()
    {
        $this->api = new Api($_SERVER['KEY_ID'], $_SERVER['KEY_SECRET']);
    }

    public function testApiConfig()
    {
        $this->assertTrue($this->api->payment !== false);
    }

    public function testPayments()
    {
        $data = $this->api->payment->all();

        //
        // $data Should be an associative array
        //
        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(is_array($data['items']));

        $payment = $data['items'][0];

        $this->assertTrue(get_class($payment['notes']) === Entity::class);
    }

    public function testHeaders()
    {
        Request::addHeader('DEMO', 1);

        $headers = Request::getHeaders();
        $this->assertEquals($headers['DEMO'], 1);
    }
}