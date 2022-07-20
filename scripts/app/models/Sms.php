<?php
include_once(__DIR__ . '/ZenophSMSGH/ZenophSMSGH.php');
class Sms
{
    private const USER = 'Zumahafrica@gmail.com';
    private const PWD = 'zumahafrica@';
    private const SENDER_ID = 'ZUMAH';
    private const MESSAGE = 'Your ZUMAH account verification code is {$code}. Code expires in 10 minutes';
    private $response;
    private object $zs;


    /**
     * instantiates the ZenophSMSGH object
     * sets required credentials
     */
    public function __construct()
    {
        $this->zs = new ZenophSMSGH();
        $this->zs->setSenderId(self::SENDER_ID);
        $this->zs->setUser(self::USER);
        $this->zs->setPassword(self::PWD);
    }
    
    /**
     * sends a verification code to user
     *
     * @param integer $code digit code to send to user
     * @param string $contact message destination
     * @return string token response for personalize message
     */
    public function sendCode(string $contact)
    {       
            $code = mt_rand(10000, 99999);
            $this->zs->setMessage(self::MESSAGE);
            $this->zs->addDestination($contact, true, array($code));
            $this->zs->setMessageType(ZenophSMSGH_MESSAGETYPE::TEXT);
            $this->zs->sendMessage();
            return $code;
    }
    
    public function getBalance()
    {
        return $this->zs->getBalance();
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function __destruct()
    {
        $this->zs->clearDestinations();
    }
}
