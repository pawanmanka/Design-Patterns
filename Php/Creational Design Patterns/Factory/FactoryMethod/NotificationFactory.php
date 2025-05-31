<?php 
require_once __DIR__ .'/NotificationInterface.php';
abstract class NotificationFactory {
    abstract public function createNotification() : NotificationInterface;

    public function notify(){
        $notification = $this->createNotification();
        $notification->send();
    }
}

?>