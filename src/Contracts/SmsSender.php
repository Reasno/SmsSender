<?php
namespace Reasno\SmsSender\Contracts;

interface SmsSender
{
    /**
     * Send a message to receiver via sms
     * @param $number cellphone number
     * @param $content text to be sent
     * @return bool True for success, False for failure.
     */
    public function send(string $number, string $content);
}
