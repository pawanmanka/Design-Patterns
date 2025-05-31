💳 1. Payment Gateway Factory
Use Case: Support for Stripe, PayPal, Razorpay, etc.
1. Interface
```php
namespace App\Contracts;

interface PaymentGatewayInterface {
    public function charge(float $amount): string;
}
```

2. Implementations

```php
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

```php
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

```php
$gateway = PaymentGatewayFactory::make('stripe');
echo $gateway->charge(99.99);

```

