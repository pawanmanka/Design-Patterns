<?php 
require_once __DIR__.'/PaymentStrategy.php';
class CreditCardPayment implements PaymentStrategy {
    public function pay($amount):void{
        echo "Credit Card Payment done of RS: ".$amount;
    }
}
?>