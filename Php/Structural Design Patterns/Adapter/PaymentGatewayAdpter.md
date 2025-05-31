**💳 Real-World Best Example: Payment Gateway Adapter**
#

🎯 Scenario:
Your app uses a common interface for processing payments.
Different gateways (Stripe, PayPal) have different method names and data formats.

🔶 Step-by-Step Implementation


**✅ Step 1: Define the Common Interface**

```php
interface PaymentGatewayInterface {
    public function charge(float $amount, string $currency): string;
}

```
Your application will use this interface.

**🟡 Step 2: Create the Adaptee (e.g. Stripe API)**

```php
class StripeAPI {
    public function createCharge(array $data): string {
        // Simulate calling Stripe's API
        return "Stripe: Charged {$data['amount']} {$data['currency']}";
    }
}

```

**🔧 Step 3: Adapter for Stripe**

```php
class StripeAdapter implements PaymentGatewayInterface {
    protected $stripe;

    public function __construct(StripeAPI $stripe) {
        $this->stripe = $stripe;
    }

    public function charge(float $amount, string $currency): string {
        $data = [
            'amount' => $amount,
            'currency' => $currency
        ];

        return $this->stripe->createCharge($data);
    }
}

```
**🟡 Step 4: Add Another Adaptee (PayPal API)**

```php
class PayPalAPI {
    public function makePayment(float $total, string $currencyCode): string {
        // Simulate calling PayPal
        return "PayPal: Paid $total in $currencyCode";
    }
}

```

**🔧 Step 5: Adapter for PayPal**

```php
class PayPalAdapter implements PaymentGatewayInterface {
    protected $paypal;

    public function __construct(PayPalAPI $paypal) {
        $this->paypal = $paypal;
    }

    public function charge(float $amount, string $currency): string {
        return $this->paypal->makePayment($amount, $currency);
    }
}

```

**✅ Step 6: Use in Your Application (Client Code)**

```php
function processOrder(PaymentGatewayInterface $gateway) {
    echo $gateway->charge(100, 'USD');
}
$stripe = new StripeAdapter(new StripeAPI());
$paypal = new PayPalAdapter(new PayPalAPI());

processOrder($stripe);  // Output: Stripe: Charged 100 USD
processOrder($paypal);  // Output: PayPal: Paid 100 in USD
```

**🧠 Why This Is a Best Example**

| Feature                    | Reason                                                                  |
| -------------------------- | ----------------------------------------------------------------------- |
| 🔌 Real-world Integration  | Most apps integrate with 3rd-party APIs like Stripe, PayPal             |
| 🧩 Incompatible Interfaces | Each provider has its own method signatures and formats                 |
| 🛠️  Adapter solves it     | You get a **common interface** for your app and **isolate** API changes |
| ♻️ Easily Extendable       | Add Razorpay, Square, etc. with new Adapters only                       |
| ✅ Clean, Testable Code     | Allows mocking/stubbing in tests                                        |
