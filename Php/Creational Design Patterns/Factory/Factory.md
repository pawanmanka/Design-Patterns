The Factory Design Pattern is a creational design pattern that provides an interface for creating objects in a superclass but allows subclasses to alter the type of objects that will be created. It helps promote loose coupling by reducing the dependency of application code on specific classes.

🔧 Purpose of Factory Pattern
- Encapsulates object creation logic.
- Improves code maintainability and scalability.
- Decouples the code that creates objects from the code that uses them.

🏭 Types of Factory Design Patterns
There are three main types of factory patterns:
1. Simple Factory (Static Factory Method)
2. Factory Method Pattern (GoF Standard)
3. Abstract Factory Pattern



1. Simple Factory (Static Factory Method)
Not a standard GoF pattern but commonly used.

Uses a single method to create instances based on provided input.

Example : 
```php
interface Notification {
    public function send();
}

class EmailNotification implements Notification {
    public function send() {
        echo "Sending Email";
    }
}

class SMSNotification implements Notification {
    public function send() {
        echo "Sending SMS";
    }
}

class NotificationFactory {
    public static function create(string $type): Notification {
        return match ($type) {
            'email' => new EmailNotification(),
            'sms'   => new SMSNotification(),
            default => throw new Exception("Unknown type"),
        };
    }
}

// Usage
$notification = NotificationFactory::create('email');
$notification->send();
```

2. 🏗 Factory Method Pattern (GoF Standard)
Structure:

Defines an interface for creating an object but lets subclasses decide which class to instantiate.

```php
abstract class NotificationFactory {
    abstract public function createNotification(): Notification;

    public function notify() {
        $notification = $this->createNotification();
        $notification->send();
    }
}

class EmailNotificationFactory extends NotificationFactory {
    public function createNotification(): Notification {
        return new EmailNotification();
    }
}

class SMSNotificationFactory extends NotificationFactory {
    public function createNotification(): Notification {
        return new SMSNotification();
    }
}

// Usage
$factory = new EmailNotificationFactory();
$factory->notify();
```

3. 🧰 Abstract Factory Pattern
Structure:

Factory of factories. Produces families of related objects.

```php
interface Button {
    public function render();
}

interface Checkbox {
    public function check();
}

class WinButton implements Button {
    public function render() { echo "Windows Button"; }
}

class MacButton implements Button {
    public function render() { echo "Mac Button"; }
}

class WinCheckbox implements Checkbox {
    public function check() { echo "Windows Checkbox"; }
}

class MacCheckbox implements Checkbox {
    public function check() { echo "Mac Checkbox"; }
}

interface GUIFactory {
    public function createButton(): Button;
    public function createCheckbox(): Checkbox;
}

class WinFactory implements GUIFactory {
    public function createButton(): Button {
        return new WinButton();
    }

    public function createCheckbox(): Checkbox {
        return new WinCheckbox();
    }
}

class MacFactory implements GUIFactory {
    public function createButton(): Button {
        return new MacButton();
    }

    public function createCheckbox(): Checkbox {
        return new MacCheckbox();
    }
}

// Usage
function renderUI(GUIFactory $factory) {
    $button = $factory->createButton();
    $checkbox = $factory->createCheckbox();

    $button->render();
    $checkbox->check();
}

$factory = new MacFactory();
renderUI($factory);
```



📌 When to Use Factory Patterns in PHP
- You want to centralize and encapsulate object creation logic
- You need to create families of related objects
- You want to make your code more flexible and maintainable
Let me know if you want Laravel-specific examples or to integrate this pattern into a real PHP project.




🧱 Real-World Factory Pattern Example in Laravel
🧩 Use Case: Notification System (Email / SMS / Slack)


1. Create Interfaces and Implementations
app/Contracts/NotificationInterface.php

```php

namespace App\Contracts;

interface NotificationInterface {
    public function send(string $message): void;
}

namespace App\Notifications;

use App\Contracts\NotificationInterface;

class EmailNotification implements NotificationInterface {
    public function send(string $message): void {
        // You could inject Mail here, or just simulate
        echo "Sending Email: $message";
    }
}

namespace App\Notifications;

use App\Contracts\NotificationInterface;

class SmsNotification implements NotificationInterface {
    public function send(string $message): void {
        echo "Sending SMS: $message";
    }
}
```
2. Create the Factory Class
app/Factories/NotificationFactory.php

```php

namespace App\Factories;

use App\Contracts\NotificationInterface;
use App\Notifications\EmailNotification;
use App\Notifications\SmsNotification;

class NotificationFactory {
    public static function make(string $type): NotificationInterface {
        return match (strtolower($type)) {
            'email' => new EmailNotification(),
            'sms'   => new SmsNotification(),
            default => throw new \Exception("Invalid notification type"),
        };
    }
}
```
3. Use the Factory in a Controller
app/Http/Controllers/NotificationController.php
```php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factories\NotificationFactory;

class NotificationController extends Controller
{
    public function send(Request $request)
    {
        $type = $request->get('type'); // 'email' or 'sms'
        $message = $request->get('message');

        $notifier = NotificationFactory::make($type);
        $notifier->send($message);

        return response()->json(['status' => 'Notification sent']);
    }
}
```
🧪 Example Request
You can test via Postman or route:
```
POST /api/notify
{
  "type": "sms",
  "message": "Your OTP is 123456"
}
```


✅ Benefits in Laravel
Clean separation of concerns

Easily testable via mocked interfaces

Swappable services without touching controller logic

Can be extended to use Laravel’s service container and dependency injection