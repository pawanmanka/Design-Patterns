<?php 
require_once  __DIR__.'/NotificationInterface.php';

class SMSNotification implements NotificationInterface {
    public function send(){
        echo "Send SMS !. \n";
    }
}

?>