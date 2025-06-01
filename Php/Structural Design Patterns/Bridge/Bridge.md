🧠 Concept Recap: Bridge Design Pattern
The Bridge pattern decouples abstraction from implementation, so that both can evolve independently.


📘 Real-World Scenario: Message Sender
Use Case:
You want to send messages (e.g., alerts, notifications) through different platforms like:

- Email
- SMS
- Slack

And you also have different types of messages, like:

- Simple notification
- Urgent alert

Instead of creating multiple combinations (e.g., UrgentEmailNotification, NormalSMSAlert), we bridge the message logic and the delivery method.

🧱 Components

| Role                    | Class                            |
| ----------------------- | -------------------------------- |
| Abstraction             | `Message`                        |
| Refined Abstraction     | `UrgentMessage`, `NormalMessage` |
| Implementor (Interface) | `MessageSender`                  |
| Concrete Implementors   | `EmailSender`, `SMSSender`       |


1. Implementor Interface

```php
interface MessageSender {
    public function send(string $message): void;
}


```
2. Concrete Implementors

```php
class EmailSender implements MessageSender {
    public function send(string $message): void {
        echo "Sending Email: $message\n";
    }
}

class SMSSender implements MessageSender {
    public function send(string $message): void {
        echo "Sending SMS: $message\n";
    }
}

```

3. Abstraction
```php
abstract class Message {
    protected MessageSender $sender;

    public function __construct(MessageSender $sender) {
        $this->sender = $sender;
    }

    abstract public function send(string $content): void;
}

```
4. Refined Abstractions

```php
class NormalMessage extends Message {
    public function send(string $content): void {
        $this->sender->send("Normal: " . $content);
    }
}

class UrgentMessage extends Message {
    public function send(string $content): void {
        $this->sender->send("URGENT: " . strtoupper($content));
    }
}


```
5. Usage

```php
$emailSender = new EmailSender();
$smsSender = new SMSSender();

$normalEmail = new NormalMessage($emailSender);
$normalEmail->send("Server is running fine."); 
// Output: Sending Email: Normal: Server is running fine.

$urgentSMS = new UrgentMessage($smsSender);
$urgentSMS->send("Database is down!"); 
// Output: Sending SMS: URGENT: DATABASE IS DOWN!

```

✅ Benefits Recap

| Benefit         | Explanation                                    |
| --------------- | ---------------------------------------------- |
| 🧠 Decoupling   | Abstraction & implementation evolve separately |
| 🔄 Flexibility  | Mix any message type with any delivery method  |
| ➕ Extensibility | Add new message types or senders independently |


🧩 Real Use Cases in PHP

- Laravel: Using Notification system with multiple channels (mail, SMS, Slack)

- Reporting: Generating reports via PDF, Excel, Email

- Payments: Payment abstraction with Stripe, PayPal, Razorpay