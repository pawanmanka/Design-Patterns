**🧩 Full Working Example in Core PHP**

```php
<?php

// 1. Interface (Abstraction)
interface PaymentGateway {
    public function charge(float $amount): string;
}

// 2. Implementation 1: Stripe
class StripePayment implements PaymentGateway {
    private $apiKey;

    public function __construct($apiKey) {
        $this->apiKey = $apiKey; // Encapsulation
    }

    public function charge(float $amount): string {
        // Mock Stripe charge logic
        return "Charged $$amount using Stripe with API key {$this->apiKey}";
    }
}

// 3. Implementation 2: PayPal
class PaypalPayment implements PaymentGateway {
    private $clientId;

    public function __construct($clientId) {
        $this->clientId = $clientId; // Encapsulation
    }

    public function charge(float $amount): string {
        // Mock PayPal charge logic
        return "Charged $$amount using PayPal with client ID {$this->clientId}";
    }
}

// 4. Payment Processor (Uses Dependency Injection)
class PaymentProcessor {
    private $gateway;

    // Dependency Injection of interface
    public function __construct(PaymentGateway $gateway) {
        $this->gateway = $gateway;
    }

    public function process(float $amount) {
        echo $this->gateway->charge($amount);
    }
}

// 5. Client Code

// You can switch between Stripe and PayPal easily (Polymorphism)
$stripe = new StripePayment("stripe_123");
$paypal = new PaypalPayment("paypal_abc");

// Use DI to inject the payment gateway
$processor = new PaymentProcessor($stripe);
// $processor = new PaymentProcessor($paypal);

// Process payment
$processor->process(100.0);

?>

```

**✅ How Each OOP Principle Is Used**

| OOP Principle            | How It's Demonstrated                                                           |
| ------------------------ | ------------------------------------------------------------------------------- |
| **Abstraction**          | `PaymentGateway` hides implementation details                                   |
| **Interface**            | `PaymentGateway` interface enforces method signature                            |
| **Dependency Injection** | `PaymentProcessor` receives `PaymentGateway` via constructor                    |
| **Polymorphism**         | Can swap `StripePayment` or `PaypalPayment` without changing `PaymentProcessor` |
| **Encapsulation**        | Private members like `$apiKey`, `$clientId` hide internal data                  |
