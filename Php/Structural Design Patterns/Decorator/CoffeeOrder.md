**🧠 Realistic PHP Example: Coffee Order System**

🔌 1. Coffee Interface (Component)

```php
interface Coffee {
    public function getCost(): float;
    public function getDescription(): string;
}
```

☕ 2. Base Concrete Component
```php
class SimpleCoffee implements Coffee {
    public function getCost(): float {
        return 5.00;
    }

    public function getDescription(): string {
        return "Simple Coffee";
    }
}

```
🎁 3. Base Decorator

```php
abstract class CoffeeDecorator implements Coffee {
    protected Coffee $coffee;

    public function __construct(Coffee $coffee) {
        $this->coffee = $coffee;
    }

    public function getCost(): float {
        return $this->coffee->getCost();
    }

    public function getDescription(): string {
        return $this->coffee->getDescription();
    }
}

```

🥛 4. Add-on Decorators

```php
class MilkDecorator extends CoffeeDecorator {
    public function getCost(): float {
        return parent::getCost() + 1.50;
    }

    public function getDescription(): string {
        return parent::getDescription() . ", Milk";
    }
}

class SugarDecorator extends CoffeeDecorator {
    public function getCost(): float {
        return parent::getCost() + 0.50;
    }

    public function getDescription(): string {
        return parent::getDescription() . ", Sugar";
    }
}

class WhipDecorator extends CoffeeDecorator {
    public function getCost(): float {
        return parent::getCost() + 2.00;
    }

    public function getDescription(): string {
        return parent::getDescription() . ", Whip";
    }
}

```

🧑‍💻 5. Client Code

```php
$coffee = new SimpleCoffee(); // base
$coffee = new MilkDecorator($coffee); // add milk
$coffee = new SugarDecorator($coffee); // add sugar
$coffee = new WhipDecorator($coffee); // add whip

echo $coffee->getDescription(); // Output: Simple Coffee, Milk, Sugar, Whip
echo "\nTotal: $" . number_format($coffee->getCost(), 2); // Total: $9.00


```

🧩 Real-World Uses of Decorator

| Use Case                  | Decorators Used For                                   |
| ------------------------- | ----------------------------------------------------- |
| Laravel Middleware        | Add logic before/after request handling               |
| File Streams              | GZIP, buffering, encryption, etc.                     |
| Logging System            | Add timestamps, file output, filters                  |
| Notifications             | Decorate Email with Slack, SMS, etc.                  |
| UI Toolkits (e.g., React) | Wrap components for added behavior (themes, handlers) |
