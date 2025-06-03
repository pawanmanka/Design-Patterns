The Strategy Design Pattern in JavaScript is used to define a family of algorithms, encapsulate each one, and make them interchangeable at runtime. It helps reduce conditional logic (like if/else or switch) and improves flexibility.

**✅ Simple Example: Payment Strategy in JavaScript**

**1. Define Strategies (Algorithms)**

Each strategy is a function or object with the same interface (pay method in this case).

```js
// Stripe strategy
class StripePayment {
  pay(amount) {
    return `Paid ₹${amount} via Stripe.`;
  }
}

// PayPal strategy
class PayPalPayment {
  pay(amount) {
    return `Paid ₹${amount} via PayPal.`;
  }
}

// Cash strategy
class CashPayment {
  pay(amount) {
    return `Paid ₹${amount} with Cash.`;
  }
}

```
#

**2. Context Class**

This class uses a strategy and allows you to switch it dynamically.

```js
class PaymentContext {
  setStrategy(strategy) {
    this.strategy = strategy;
  }

  pay(amount) {
    return this.strategy.pay(amount);
  }
}

```

#

**3. Usage**

```js
const context = new PaymentContext();

// Use PayPal
context.setStrategy(new PayPalPayment());
console.log(context.pay(500)); // Paid ₹500 via PayPal.

// Use Stripe
context.setStrategy(new StripePayment());
console.log(context.pay(1200)); // Paid ₹1200 via Stripe.

// Use Cash
context.setStrategy(new CashPayment());
console.log(context.pay(700)); // Paid ₹700 with Cash.

```

#

**📦 With Strategy Map (Bonus Tip)**

You can also store strategies in a map for cleaner usage:

```js
const strategies = {
  paypal: new PayPalPayment(),
  stripe: new StripePayment(),
  cash: new CashPayment()
};

const context = new PaymentContext();
const method = "stripe"; // or "paypal", "cash"
context.setStrategy(strategies[method]);
console.log(context.pay(999));

```

#

**🧠 When to Use**
- When you have multiple ways to perform a task (e.g. sorting, logging, payment).
- When you want to avoid if/else or switch statements for selecting algorithms.
- When behaviors need to be interchangeable and reusable.