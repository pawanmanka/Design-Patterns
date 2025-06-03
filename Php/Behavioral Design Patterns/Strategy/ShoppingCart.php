<?php 
require_once __DIR__.'/PaymentStrategy.php';
class ShoppingCart {
    private PaymentStrategy $paymentMethod;

    public function setPaymentMethod(PaymentStrategy $method) {
        $this->paymentMethod = $method;
    }

    public function checkout($amount) {
        $this->paymentMethod->pay($amount);
    }
}
?>