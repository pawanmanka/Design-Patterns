the Object-Oriented Programming (OOP) concepts in PHP with simple explanations and real code examples.

**🧱 Core OOP Concepts in PHP**

| Concept        | Description                                     |
| -------------- | ----------------------------------------------- |
| Class & Object | Blueprint and instance of that blueprint        |
| Inheritance    | One class inherits from another                 |
| Encapsulation  | Hiding internal state using access modifiers    |
| Polymorphism   | Same method name behaves differently            |
| Abstraction    | Define structure but not full implementation    |
| Interface      | Contract that implementing classes must follow  |
| Traits         | Reusable chunks of methods for multiple classes |


**✅ 1. Class & Object**
A class is a blueprint. An object is an instance of that class.

```php
class Car {
    public $brand;

    public function drive() {
        return "Driving a $this->brand";
    }
}

// Creating object
$car = new Car();
$car->brand = "Toyota";
echo $car->drive(); // Output: Driving a Toyota

```

**✅ 2. Inheritance**

A class can inherit properties and methods from another class using extends.

```php
class Vehicle {
    public function start() {
        return "Vehicle started";
    }
}

class Bike extends Vehicle {
    public function ride() {
        return "Riding bike";
    }
}

$bike = new Bike();
echo $bike->start(); // From parent class
echo $bike->ride();  // From child class

```

**✅ 3. Encapsulation**
Use public, protected, and private to control access.

```php
class BankAccount {
    private $balance = 0;

    public function deposit($amount) {
        $this->balance += $amount;
    }

    public function getBalance() {
        return $this->balance;
    }
}

$account = new BankAccount();
$account->deposit(1000);
// $account->balance = 5000; // ❌ Error: private property
echo $account->getBalance(); // ✅ Output: 1000

```

**✅ 4. Polymorphism**
Different classes can define the same method differently.

```php
class Animal {
    public function speak() {
        return "Some sound";
    }
}

class Dog extends Animal {
    public function speak() {
        return "Bark";
    }
}

class Cat extends Animal {
    public function speak() {
        return "Meow";
    }
}

function makeSound(Animal $animal) {
    echo $animal->speak();
}

makeSound(new Dog()); // Output: Bark
makeSound(new Cat()); // Output: Meow

```

**✅ 5. Abstraction**

Abstract classes define what should be done, not how.

```php
abstract class Shape {
    abstract public function area();
}

class Circle extends Shape {
    private $radius;
    public function __construct($r) {
        $this->radius = $r;
    }

    public function area() {
        return pi() * $this->radius ** 2;
    }
}

$circle = new Circle(5);
echo $circle->area(); // Output: 78.539...

```

**✅ 6. Interface**

Defines a contract — methods without body that must be implemented.

```php
interface Logger {
    public function log($message);
}

class FileLogger implements Logger {
    public function log($message) {
        echo "Logged to file: $message";
    }
}

$logger = new FileLogger();
$logger->log("System started"); // Output: Logged to file: System started

```

**✅ 7. Traits (PHP-specific)**
Allows code reuse across classes without inheritance.

```php
trait LoggerTrait {
    public function log($msg) {
        echo "Log: $msg";
    }
}

class User {
    use LoggerTrait;
}

$user = new User();
$user->log("User created"); // Output: Log: User created

```

**🧠 Summary**
| Concept       | PHP Keyword         | Key Use                             |
| ------------- | ------------------- | ----------------------------------- |
| Class/Object  | `class`, `new`      | Define and use objects              |
| Inheritance   | `extends`           | Reuse code from parent class        |
| Encapsulation | `private`, `public` | Hide internal logic                 |
| Polymorphism  | `override methods`  | Same method, different behavior     |
| Abstraction   | `abstract class`    | Define blueprint                    |
| Interface     | `interface`         | Define contracts                    |
| Traits        | `trait`             | Code reuse across unrelated classes |
