**🧾 Scenario: Payment Gateway Integration**

You want to process payments through multiple providers like:

- Stripe
- PayPal

But your app also has different payment use cases:
- E-commerce Checkout.
- Subscription Payments.

You want to change payment logic or provider without rewriting everything.

🧠 Bridge Mapping

| Bridge Component | Role in Example                           |
| ---------------- | ----------------------------------------- |
| **Abstraction**  | Payment UI logic (Checkout, Subscription) |
| **Implementor**  | Payment gateway (Stripe, PayPal)          |

✅ Implementation

1. Implementor Interface (PaymentGateway)

```js
class PaymentGateway {
  pay(amount) {
    throw new Error("pay() must be implemented.");
  }
}
```

2. Concrete Implementors: Stripe & PayPal

```js

class StripeGateway extends PaymentGateway {
  pay(amount) {
    console.log(`Processing $${amount} via Stripe`);
    // Simulate Stripe API call...
  }
}

class PayPalGateway extends PaymentGateway {
  pay(amount) {
    console.log(`Processing $${amount} via PayPal`);
    // Simulate PayPal API call...
  }
}

```

3. Abstraction: Payment

```js
class Payment {
  constructor(gateway) {
    this.gateway = gateway; // Bridge to implementor
  }

  process(amount) {
    this.gateway.pay(amount);
  }
}

```

4. Extended Abstractions

```js
class CheckoutPayment extends Payment {
  process(amount) {
    console.log("Checkout initiated...");
    super.process(amount);
  }
}

class SubscriptionPayment extends Payment {
  process(amount) {
    console.log("Starting subscription...");
    super.process(amount);
  }
}

```

✅ 5. Usage Example

```js
const stripe = new StripeGateway();
const paypal = new PayPalGateway();

const checkout = new CheckoutPayment(stripe);
checkout.process(100); 
// Checkout initiated...
// Processing $100 via Stripe

const subscription = new SubscriptionPayment(paypal);
subscription.process(20); 
// Starting subscription...
// Processing $20 via PayPal

```

🧩 Why This is a Real-World Bridge Example

| Pattern Element        | Example                                             |
| ---------------------- | --------------------------------------------------- |
| Abstraction            | `Payment`, `CheckoutPayment`, `SubscriptionPayment` |
| Implementor            | `StripeGateway`, `PayPalGateway`                    |
| Bridge                 | `gateway` passed into abstraction                   |
| Separation of Concerns | Business logic ≠ Payment provider API logic         |

