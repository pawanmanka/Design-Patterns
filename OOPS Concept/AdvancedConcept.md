**✅ 1. Abstract Classes**
Abstract classes are base classes that cannot be instantiated and are meant to be extended by other classes. They may contain abstract methods (methods without a body) that must be implemented by the child classes.

```php
abstract class Animal {
    abstract public function makeSound();
    
    public function eat() {
        echo "Eating...\n";
    }
}

class Dog extends Animal {
    public function makeSound() {
        echo "Bark\n";
    }
}

```
#

**✅ 2. Interfaces**

Interfaces define a contract that implementing classes must fulfill. Unlike abstract classes, a class can implement multiple interfaces.
```php
interface Logger {
    public function log(string $message);
}

class FileLogger implements Logger {
    public function log(string $message) {
        file_put_contents('log.txt', $message);
    }
}

```
#

**✅ 3. Traits (Multiple Inheritance)**
Traits allow code reuse across classes without inheritance. They help solve the diamond problem in multiple inheritance.

```php
trait LoggerTrait {
    public function log($msg) {
        echo "Log: $msg\n";
    }
}

class User {
    use LoggerTrait;
}

```
#

**✅ 4. Namespaces**
Namespaces prevent name conflicts between classes/functions/constants.

```php
namespace App\Models;

class User {
    //...
}

```

Use it:

```php
use App\Models\User;

```

#

**✅ 5. Magic Methods**
Special methods that start with double underscores (__). Examples:
- __construct(), __destruct()
- __get(), __set(), __isset(), __unset() – Overloading
- __call() / __callStatic() – Intercept inaccessible methods
- __toString() – Convert object to string
- __invoke() – Make object callable

```php
class Magic {
    public function __call($name, $arguments) {
        echo "Method $name not found!\n";
    }
}

```
#

**✅ 6. Late Static Binding**

Useful when dealing with inheritance and static methods. Use static:: instead of self::.
```php
class A {
    public static function who() {
        echo __CLASS__;
    }

    public static function test() {
        static::who(); // late static binding
    }
}

class B extends A {
    public static function who() {
        echo __CLASS__;
    }
}

B::test(); // Outputs "B"

```
#

**✅ 7. Dependency Injection (DI)**

A design pattern where dependencies are injected into a class rather than hard-coded.

```php
class Mailer {
    public function send($message) {
        echo "Sending: $message\n";
    }
}

class UserController {
    protected $mailer;
    
    public function __construct(Mailer $mailer) {
        $this->mailer = $mailer;
    }
}

```
#

**✅ 8. SOLID Principles**
A set of OOP design principles:
- S: Single Responsibility
- O: Open/Closed
- L: Liskov Substitution
- I: Interface Segregation
- D: Dependency Inversion
These principles help build robust and scalable OOP systems.

#
**✅ 9. Polymorphism**
Different classes can be treated through a common interface.

```php
interface Shape {
    public function area();
}

class Circle implements Shape {
    public function area() {
        return 3.14 * 5 * 5;
    }
}

class Square implements Shape {
    public function area() {
        return 5 * 5;
    }
}

function printArea(Shape $shape) {
    echo $shape->area();
}

```
#

**✅ 10. Design Patterns (OOP-centric)**
Some advanced OOP design patterns in PHP:
- Factory Pattern
- Singleton Pattern
- Strategy Pattern
- Observer Pattern
- Decorator Pattern
- Repository Pattern


**🔮 List of Magic Methods in PHP**

| Magic Method      | Triggered When...                                      |
| ----------------- | ------------------------------------------------------ |
| `__construct()`   | Object is created (instantiated)                       |
| `__destruct()`    | Object is destroyed (script ends or unset)             |
| `__get()`         | Reading inaccessible or non-existent property          |
| `__set()`         | Writing to inaccessible or non-existent property       |
| `__isset()`       | `isset()` or `empty()` called on inaccessible property |
| `__unset()`       | `unset()` is called on inaccessible property           |
| `__call()`        | Calling an undefined or inaccessible method            |
| `__callStatic()`  | Static version of `__call()`                           |
| `__toString()`    | Object is used as a string (e.g. `echo $obj`)          |
| `__invoke()`      | Object is used as a function (e.g. `$obj()`)           |
| `__clone()`       | Object is cloned using `clone` keyword                 |
| `__debugInfo()`   | `var_dump()` is called                                 |
| `__sleep()`       | Before `serialize()`                                   |
| `__wakeup()`      | After `unserialize()`                                  |
| `__serialize()`   | Custom serialization (PHP 7.4+)                        |
| `__unserialize()` | Custom unserialization (PHP 7.4+)                      |


**🧙‍♂️ Magic Constants in PHP**

| Magic Constant     | Description                                         |
| ------------------ | --------------------------------------------------- |
| `__LINE__`         | Current line number in the file                     |
| `__FILE__`         | Full path and filename of the file                  |
| `__DIR__`          | Directory of the file (same as `dirname(__FILE__)`) |
| `__FUNCTION__`     | Name of the current function                        |
| `__CLASS__`        | Name of the current class (including namespace)     |
| `__TRAIT__`        | Name of the current trait                           |
| `__METHOD__`       | Name of the current method (`Class::method`)        |
| `__NAMESPACE__`    | Name of the current namespace                       |
| `ClassName::class` | Fully-qualified class name (added in PHP 5.5)       |

**✅ Use Cases of Magic Constants**
- Debugging & Logging: Log the line, file, and method name where an error occurred.
- Reflection & Meta-programming: Access context-aware class or method names dynamically.
- Autoloading & Routing: Some frameworks use ::class to map classes to routes or services.

**1. SOLID Principles (Deep Understanding)**

**2. Design Patterns (Applied OOP)**

**3. Polymorphism & Late Static Binding**

Advanced use of static:: vs self:: and interface-driven polymorphism.

```php
class Base {
    public static function who() {
        static::identify();
    }

    protected static function identify() {
        echo "Base";
    }
}

class Child extends Base {
    protected static function identify() {
        echo "Child";
    }
}

Child::who(); // outputs "Child"

```
**4. Reflection API**

For dynamic class/method inspection and metaprogramming.

```php
$refClass = new ReflectionClass(SomeClass::class);
$methods = $refClass->getMethods();

```
Used in frameworks like Laravel (e.g., for route/model discovery).

**5. Magic Methods Deep Dive**

**6. Anonymous Classes and Closures as Dependencies**
Anonymous classes:
```php
$logger = new class {
    public function log($msg) {
        echo $msg;
    }
};

```
Closures for strategies or command pattern use.


**7. Object Calisthenics (Best Practices)**
A discipline for writing clean object-oriented code:

- One level of indentation per method
- Don't use else
- Wrap primitives and strings
- First class collections
- No classes with more than two instance variables

**8. Advanced Composition Techniques**
- Favor composition over inheritance.
- Use traits wisely and avoid trait hell.
- Combine interfaces + traits for clean architecture

**9. Domain-Driven Design (DDD) Concepts**
Even in PHP:
- Entities & Value Objects
- Aggregates & Repositories
- Services & Factories
- Ubiquitous language

**10. Object-Oriented Architecture in Laravel**
- Service Providers
- Repositories + Interfaces
- Event-Driven Design
- Observer Pattern with Laravel Models
- Macroable traits

**✅ Practice Tips**
- Refactor a procedural legacy app to follow OOP + SOLID + patterns
- Contribute to an open-source OOP-heavy PHP project
- Create your own reusable package (you mentioned Composer interest)
- Build a mini framework or library using these concepts

