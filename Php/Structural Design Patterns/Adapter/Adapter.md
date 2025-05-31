Also known as: Wrapper

**🔌 Adapter Pattern in PHP**
The Adapter Pattern is a structural design pattern that allows incompatible interfaces to work together by wrapping an existing class with a new interface.

**🧠 Real-World Analogy**
Imagine you have a phone charger with a USB plug, but the wall socket only accepts a Type-C. You need an adapter to convert the plug.

**✅ When to Use It in PHP**
- You want to reuse a class that doesn’t match the required interface.
- You’re integrating third-party APIs or legacy code.
- You want to create a bridge between two incompatible interfaces.


📦 PHP Example: Basic Adapter
Scenario:
You have an old payment gateway and a new system expects a different method name.

🧾 Old Payment Gateway
```php 
class OldPaymentGateway {
    public function makePayment($amount) {
        echo "Paid $amount using Old Gateway.";
    }
}

```

🆕 New Interface

```php
interface PaymentGatewayInterface {
    public function pay($amount);
}

```

🔧 Adapter

```php 
class PaymentAdapter implements PaymentGatewayInterface {
    protected $oldGateway;

    public function __construct(OldPaymentGateway $oldGateway) {
        $this->oldGateway = $oldGateway;
    }

    public function pay($amount) {
        $this->oldGateway->makePayment($amount); // Adapts method call
    }
}

```

✅ Client Code

```php 
function processPayment(PaymentGatewayInterface $gateway, $amount) {
    $gateway->pay($amount);
}

$oldGateway = new OldPaymentGateway();
$adapter = new PaymentAdapter($oldGateway);

processPayment($adapter, 100);
// Output: Paid 100 using Old Gateway.

```

**🧩 Key Benefits**

| Feature       | Benefit                                       |
| ------------- | --------------------------------------------- |
| ✅ Reusability | You can reuse legacy or third-party classes   |
| ✅ Decoupling  | Client code depends only on the new interface |
| ✅ Flexibility | Swap in new adapters with ease                |


## **🧩 Example 1: Legacy Notification System**

🛑 Problem:

You have a legacy email system, but your app expects a unified NotificationInterface for all notifications.


🎯 Target Interface

```php
interface NotificationInterface {
    public function send($to, $message);
}

```

🧓 Legacy Email Class

```php
class LegacyEmail {
    public function sendEmailTo($emailAddress, $emailBody) {
        echo "Sending email to $emailAddress: $emailBody\n";
    }
}

```


🔧 Adapter
```php
class EmailAdapter implements NotificationInterface {
    protected $legacyEmail;

    public function __construct(LegacyEmail $legacyEmail) {
        $this->legacyEmail = $legacyEmail;
    }

    public function send($to, $message) {
        $this->legacyEmail->sendEmailTo($to, $message);
    }
}

```

**✅ Client Code**

```php
function notifyUser(NotificationInterface $notifier) {
    $notifier->send('user@example.com', 'Welcome!');
}

$legacyEmail = new LegacyEmail();
$adapter = new EmailAdapter($legacyEmail);

notifyUser($adapter);
// Output: Sending email to user@example.com: Welcome!

```

### **🧩 Example 2: Different Logger Implementations**

#

🎯 Target Interface

```php
interface LoggerInterface {
    public function log($message);
}

```

🪵 Third-Party Logger (Incompatible)
```php
class ThirdPartyLogger {
    public function writeToLog($text) {
        echo "[ThirdPartyLog]: $text\n";
    }
}

```

🔧 Adapter

```php
class LoggerAdapter implements LoggerInterface {
    protected $externalLogger;

    public function __construct(ThirdPartyLogger $externalLogger) {
        $this->externalLogger = $externalLogger;
    }

    public function log($message) {
        $this->externalLogger->writeToLog($message);
    }
}

```
##

✅ Usage

```php
function performLogging(LoggerInterface $logger) {
    $logger->log("Something happened.");
}

$externalLogger = new ThirdPartyLogger();
$adapterLogger = new LoggerAdapter($externalLogger);

performLogging($adapterLogger);
// Output: [ThirdPartyLog]: Something happened.

```
## **🧩 Example 3: Laravel-Like File Storage Adapter**
#

Let's say you want to abstract file storage so it works with local, S3, or any other backend, even custom ones.

🎯 Interface
```php
interface StorageInterface {
    public function put($path, $content);
    public function get($path);
}

```

🗂️ Local File System

```php
class LocalFileSystem {
    public function saveToFile($filename, $data) {
        file_put_contents($filename, $data);
    }

    public function readFromFile($filename) {
        return file_get_contents($filename);
    }
}

```

🔧 Adapter

```php
class LocalStorageAdapter implements StorageInterface {
    protected $local;

    public function __construct(LocalFileSystem $local) {
        $this->local = $local;
    }

    public function put($path, $content) {
        $this->local->saveToFile($path, $content);
    }

    public function get($path) {
        return $this->local->readFromFile($path);
    }
}

```

✅ Usage
```php
$local = new LocalFileSystem();
$storage = new LocalStorageAdapter($local);

$storage->put('data.txt', 'Hello World!');
echo $storage->get('data.txt');
// Output: Hello World!

```

✅ Summary Table
| Component          | Role                                   |
| ------------------ | -------------------------------------- |
| `Target Interface` | Expected by the client                 |
| `Adaptee`          | Existing incompatible class            |
| `Adapter`          | Converts Adaptee's interface to Target |
| `Client`           | Uses the Target Interface              |





✅ Benefits of Adapter Pattern in PHP
Enables use of legacy or third-party classes
- Promotes loose coupling.
- Improves code reusability and testability