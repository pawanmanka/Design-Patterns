<?php 

require_once  __DIR__.'/NotificationInterface.php';

class EmailNotification implements NotificationInterface {
    public function send(){
        echo "Sending Email !. \n";
    }
}

?>