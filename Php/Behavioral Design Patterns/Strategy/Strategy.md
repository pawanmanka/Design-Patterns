The Strategy Design Pattern is a behavioral design pattern that enables selecting an algorithm’s behavior at runtime. It defines a family of algorithms, encapsulates each one, and makes them interchangeable. This pattern is useful when you have multiple algorithms for a specific task and want to switch between them dynamically.

#

**🧠 Concept**
- Context: Uses a Strategy object.
- Strategy Interface: Common interface for all supported algorithms.
- Concrete Strategies: Implement different variations of the algorithm.

#

**✅ Real-Life Analogy**

Think of a navigation app (like Google Maps) that lets you choose different travel modes: driving, walking, biking. Each mode is a different strategy for finding a route.

#

**🧱 Example in PHP**
**1. Define the Strategy Interface**

```php
interface PaymentStrategy {
    public function pay($amount);
}
```

**2. Create Concrete Strategies**
```php
class PayByCreditCard implements PaymentStrategy {
    public function pay($amount) {
        echo "Paid ₹$amount using Credit Card.\n";
    }
}

class PayByPayPal implements PaymentStrategy {
    public function pay($amount) {
        echo "Paid ₹$amount using PayPal.\n";
    }
}
```
**3. Context Class**
```php
class ShoppingCart {
    private PaymentStrategy $paymentMethod;

    public function setPaymentMethod(PaymentStrategy $method) {
        $this->paymentMethod = $method;
    }

    public function checkout($amount) {
        $this->paymentMethod->pay($amount);
    }
}
```
**4. Usage**
```php
$cart = new ShoppingCart();

// User selects PayPal
$cart->setPaymentMethod(new PayByPayPal());
$cart->checkout(500);

// User switches to Credit Card
$cart->setPaymentMethod(new PayByCreditCard());
$cart->checkout(1000);
```
#

**🧾 Output**
```
Paid ₹500 using PayPal.
Paid ₹1000 using Credit Card.

```

**✅ When to Use**
- You have multiple ways to perform a task (e.g., sorting, payments, logging).
- You want to switch algorithms/behaviors at runtime.
- You want to avoid multiple if/else or switch statements.
