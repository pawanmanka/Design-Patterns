<?php 
require_once __DIR__ .'/NotificationFactory.php';
require_once __DIR__.'/NotificationInterface.php';
require_once __DIR__.'/EmailNotification.php';
class EmailNotificationFactory extends NotificationFactory {
    public function createNotification(): NotificationInterface {
        return new EmailNotification();
    }
}

?>