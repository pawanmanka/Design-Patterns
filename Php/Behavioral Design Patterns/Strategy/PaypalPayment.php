<?php 
require_once __DIR__.'/PaymentStrategy.php';
class PaypalPayment implements PaymentStrategy {
    public function pay($amount):void{
        echo "Paypal payment done of RS: ".$amount;
    }
}
?>