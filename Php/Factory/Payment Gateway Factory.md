💳 1. Payment Gateway Factory
Use Case: Support for Stripe, PayPal, Razorpay, etc.
1. Interface
```
namespace App\Contracts;

interface PaymentGatewayInterface {
    public function charge(float $amount): string;
}
```

2. Implementations

```
// app/Payments/StripeGateway.php
class StripeGateway implements PaymentGatewayInterface {
    public function charge(float $amount): string {
        return "Charged $$amount via Stripe";
    }
}

// app/Payments/PaypalGateway.php
class PaypalGateway implements PaymentGatewayInterface {
    public function charge(float $amount): string {
        return "Charged $$amount via PayPal";
    }
}
```

3. Factory

```
class PaymentGatewayFactory {
    public static function make(string $gateway): PaymentGatewayInterface {
        return match (strtolower($gateway)) {
            'stripe' => new StripeGateway(),
            'paypal' => new PaypalGateway(),
            default => throw new \Exception("Unsupported gateway"),
        };
    }
}
```

4. Usage

```
$gateway = PaymentGatewayFactory::make('stripe');
echo $gateway->charge(99.99);

```

