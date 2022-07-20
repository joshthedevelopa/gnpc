<?php
include_once "../libs/ZenophSMSGH/MessageTypes.php";
include_once "../libs/ZenophSMSGH/ResponseCodes.php";
include_once "../libs/ZenophSMSGH/SMSResponse.php";
include_once "../libs/ZenophSMSGH/ZenophSMSGH.php";
include_once "../libs/ZenophSMSGH/ZenophSMSGHException.php";
class Sms
{
    private const USER ='Zumahafrica@gmail.com';
    private const PWD ='zumahafrica@';
    private $message = 'Payment received for GHS 5000 from World Remit. Current Balance: GHS 5000. Available Balance: GHS 5000. Reference: Stephen Obeng. Transaction ID: 5263857496';
    private $destinations;
    private const SENDER_ID = "PayBuddy";
    //private static $ZS = new ZenophSMSGH();
    public $ZS;
    private const TEXT = ZenophSMSGH_MESSAGETYPE::TEXT;
    private const FLASH_TEXT = ZenophSMSGH_MESSAGETYPE::FLASH_TEXT;
    private const UNICODE = ZenophSMSGH_MESSAGETYPE::UNICODE;
    private const FLASH_UNICODE = ZenophSMSGH_MESSAGETYPE::FLASH_UNICODE;
    

    public function __construct($destinations=array(), $message=NULL)
    {
        $this->ZS = new ZenophSMSGH();
        $this->ZS->setMessage($this->message);
        $this->ZS->setSenderId(self::SENDER_ID);
        foreach($destinations as $dest):
           $this->ZS->addDestination($this->destinations=$dest);
           $this->ZS->setUser(self::USER);
           $this->ZS->setPassword(self::PWD);
        endforeach;
    }
    public function sendVcode()
    {
        $this->ZS->setMessageType(self::TEXT);
        $this->ZS->sendMessage(false);
    }
    public function getBalance()
    {
        return $this->ZS->getBalance();
    }

    // public function __destruct()
    // {
    //     self::ZS->clearDestinations();
    // }
}

$send = new Sms(array("233553457653"));

$send->sendVcode();
echo $send->getBalance();