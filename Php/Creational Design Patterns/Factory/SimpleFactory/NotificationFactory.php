<?php 
require_once  __DIR__. "/NotificationInterface.php";
require_once  __DIR__. "/EmailNotification.php";
require_once  __DIR__. "/SMSNotification.php";
class NotificationFactory {
    public static function create(string $type) : ?NotificationInterface {
        return  match ($type){
            'email'     => new EmailNotification(),
            'sms'       => new SMSNotification(),
            'default'   => null,
        };
    }
}

// Usage
$notification = NotificationFactory::create('email');
$notification->send();

$notification = NotificationFactory::create('sms');
$notification->send();

$notification = NotificationFactory::create('slack');
$notification->send();


?>