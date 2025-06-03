<?php 
require_once __DIR__.'/ShoppingCart.php';
require_once __DIR__.'/CreditCardPayment.php';
require_once __DIR__.'/PaypalPayment.php';

$cart = new ShoppingCart();


// User selects PayPal
$cart->setPaymentMethod(new PaypalPayment());
$cart->checkout(500);
echo "\n";

// User switches to Credit Card
$cart->setPaymentMethod(new CreditCardPayment());
$cart->checkout(1000);

?>