🔔 Real-World Example: Notification System Factory
We'll build a factory that returns the correct notification service (Email, SMS, or Push) based on the input.

1. Define Notification Classes

```js
class EmailNotification {
  send(to, message) {
    console.log(`[EMAIL] To: ${to} | Message: ${message}`);
  }
}

class SMSNotification {
  send(to, message) {
    console.log(`[SMS] To: ${to} | Message: ${message}`);
  }
}

class PushNotification {
  send(to, message) {
    console.log(`[PUSH] To: ${to} | Message: ${message}`);
  }
}

```

2. Create the Factory

```js
class NotificationFactory {
  static create(channel) {
    switch (channel.toLowerCase()) {
      case 'email':
        return new EmailNotification();
      case 'sms':
        return new SMSNotification();
      case 'push':
        return new PushNotification();
      default:
        throw new Error(`Unknown notification channel: ${channel}`);
    }
  }
}

```
3. Usage Example

```js
const email = NotificationFactory.create('email');
email.send('alice@example.com', 'Welcome to our platform!');

const sms = NotificationFactory.create('sms');
sms.send('+1234567890', 'Your OTP is 123456');

const push = NotificationFactory.create('push');
push.send('user_123', 'You have a new message');

```

✅ Output

```
[EMAIL] To: alice@example.com | Message: Welcome to our platform!  
[SMS] To: +1234567890 | Message: Your OTP is 123456  
[PUSH] To: user_123 | Message: You have a new message

```

🧠 Real Benefits of This Pattern Here
- 🔌 Plug & Play channels without changing logic elsewhere.
- 🛠️ Extensible (add Slack, WhatsApp, etc. later).
- 📦 Clean separation of notification logic by channel.
- 👨‍🔧 Unit-testable classes for each channel.
