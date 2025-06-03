The Template Method Design Pattern defines the skeleton of an algorithm in a base class, but allows subclasses to override specific steps without changing the algorithm’s structure.

🧠 Real-World Analogy

Imagine making tea or coffee:

1. Boil water
2. Brew beverage (tea or coffee) ← varies
3. Pour into cup
4. Add extras (sugar, lemon, milk) ← varies

The process is the same, but steps differ.

✅ Structure

| Component             | Role                                                      |
| --------------------- | --------------------------------------------------------- |
| **Abstract Class**    | Defines the template method with steps of the algorithm   |
| **Concrete Subclass** | Implements the specific steps that vary for each behavior |

🧪 Example: Beverage Maker (Tea vs Coffee)

1. Abstract Class: Beverage

```php
abstract class Beverage {
    // Template method
    final public function prepare(): void {
        $this->boilWater();
        $this->brew();
        $this->pourInCup();
        $this->addCondiments();
    }

    protected function boilWater(): void {
        echo "Boiling water...\n";
    }

    protected function pourInCup(): void {
        echo "Pouring into cup...\n";
    }

    // Steps to be implemented by subclasses
    abstract protected function brew(): void;
    abstract protected function addCondiments(): void;
}

```

2. Concrete Subclass: Tea


```php
class Tea extends Beverage {
    protected function brew(): void {
        echo "Steeping the tea...\n";
    }

    protected function addCondiments(): void {
        echo "Adding lemon...\n";
    }
}

```

3. Concrete Subclass: Coffee

```php
class Coffee extends Beverage {
    protected function brew(): void {
        echo "Dripping coffee through filter...\n";
    }

    protected function addCondiments(): void {
        echo "Adding sugar and milk...\n";
    }
}

```

4. Client Code

```php
echo "--- Making Tea ---\n";
$tea = new Tea();
$tea->prepare();

echo "\n--- Making Coffee ---\n";
$coffee = new Coffee();
$coffee->prepare();

```
#

🏦 Use Case: Payment Processing System

Common Steps:
1. Validate request
2. Connect to payment gateway
3. Perform the payment
4. Log transaction
5. Return response

Each payment method (e.g., PayPal, Stripe) implements its own gateway connection and transaction logic, but the high-level flow is fixed.

✅ 1. Abstract Class – PaymentProcessor

```php
abstract class PaymentProcessor {
    final public function process(): void {
        $this->validateRequest();
        $this->connectGateway();
        $this->performPayment();
        $this->logTransaction();
        $this->sendResponse();
    }

    protected function validateRequest(): void {
        echo "✅ Validating request...\n";
    }

    abstract protected function connectGateway(): void;
    abstract protected function performPayment(): void;

    protected function logTransaction(): void {
        echo "🧾 Logging transaction...\n";
    }

    protected function sendResponse(): void {
        echo "📤 Sending response to client...\n";
    }
}

```

✅ 2. Concrete Class – PayPalProcessor

```php
class PayPalProcessor extends PaymentProcessor {
    protected function connectGateway(): void {
        echo "🔗 Connecting to PayPal API...\n";
    }

    protected function performPayment(): void {
        echo "💸 Performing PayPal payment...\n";
    }
}

```

✅ 3. Concrete Class – StripeProcessor

```php
class StripeProcessor extends PaymentProcessor {
    protected function connectGateway(): void {
        echo "🔗 Connecting to Stripe API...\n";
    }

    protected function performPayment(): void {
        echo "💸 Performing Stripe payment...\n";
    }
}

```

✅ 4. Client Code

```php
function handlePayment(PaymentProcessor $processor): void {
    $processor->process();
}

echo "--- Processing PayPal ---\n";
handlePayment(new PayPalProcessor());

echo "\n--- Processing Stripe ---\n";
handlePayment(new StripeProcessor());

```
