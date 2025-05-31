💳 Real-World Use Case: Payment Gateway Factory
We'll build a factory that returns the appropriate payment gateway handler based on user/system preference.


1. Define Payment Gateway Classes

```js
class Stripe {
  constructor() {
    this.name = 'Stripe';
  }

  process(amount) {
    console.log(`[Stripe] Processing payment of $${amount}`);
  }
}

class PayPal {
  constructor() {
    this.name = 'PayPal';
  }

  process(amount) {
    console.log(`[PayPal] Processing payment of $${amount}`);
  }
}

class Razorpay {
  constructor() {
    this.name = 'Razorpay';
  }

  process(amount) {
    console.log(`[Razorpay] Processing payment of ₹${amount}`);
  }
}

```

2. Create the Factory

```js
class PaymentGatewayFactory {
  static createGateway(provider) {
    switch (provider.toLowerCase()) {
      case 'stripe':
        return new Stripe();
      case 'paypal':
        return new PayPal();
      case 'razorpay':
        return new Razorpay();
      default:
        throw new Error(`Unknown payment gateway: ${provider}`);
    }
  }
}

```

3. Usage Example

```js
const gateway1 = PaymentGatewayFactory.createGateway('Stripe');
gateway1.process(100);

const gateway2 = PaymentGatewayFactory.createGateway('PayPal');
gateway2.process(200);

const gateway3 = PaymentGatewayFactory.createGateway('Razorpay');
gateway3.process(5000);

```

✅ Output

```
[Stripe] Processing payment of $100  
[PayPal] Processing payment of $200  
[Razorpay] Processing payment of ₹5000

```

🧠 Why Use This Pattern?
- Single Point of Object Creation – Makes it easy to switch or expand gateways.
- Open/Closed Principle – Add new gateways without modifying consumers.
- Code Simplification – Consumers don’t need to know the implementation details.