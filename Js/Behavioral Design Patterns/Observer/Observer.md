The Observer Pattern in JavaScript allows objects (observers) to subscribe to events or changes in another object (the subject). When the subject’s state changes, all subscribed observers are notified automatically.

#

**✅ Use Case**
Let’s simulate a newsletter subscription system:
 - A Newsletter object allows users (observers) to subscribe.
 - When a new issue is published, all subscribers are notified.

#

**🔧 Step-by-Step Implementation**

**1. The Subject (Observable)**

```js
class Newsletter {
  constructor() {
    this.subscribers = [];
  }

  // Add observer
  subscribe(observer) {
    this.subscribers.push(observer);
  }

  // Remove observer
  unsubscribe(observer) {
    this.subscribers = this.subscribers.filter(sub => sub !== observer);
  }

  // Notify all observers
  notify(issue) {
    this.subscribers.forEach(observer => observer.update(issue));
  }

  // Publish a new issue
  publish(issue) {
    console.log(`📢 Newsletter Published: ${issue}`);
    this.notify(issue);
  }
}

```
#

**2. The Observer Interface**

Each observer must implement an update() method.

```js
class EmailSubscriber {
  constructor(email) {
    this.email = email;
  }

  update(issue) {
    console.log(`📨 Email to ${this.email}: New issue - ${issue}`);
  }
}

class SMSSubscriber {
  constructor(phone) {
    this.phone = phone;
  }

  update(issue) {
    console.log(`📱 SMS to ${this.phone}: New issue - ${issue}`);
  }
}
```

#

**3. Usage Example**

```js
const newsletter = new Newsletter();

const alice = new EmailSubscriber("alice@example.com");
const bob = new SMSSubscriber("+919876543210");

newsletter.subscribe(alice);
newsletter.subscribe(bob);

newsletter.publish("Observer Pattern in JS"); // Notify all subscribers

// Unsubscribe one
newsletter.unsubscribe(bob);

newsletter.publish("Strategy Pattern in JS"); // Only Alice gets this

```

#

**🧾 Output**

```
📢 Newsletter Published: Observer Pattern in JS
📨 Email to alice@example.com: New issue - Observer Pattern in JS
📱 SMS to +919876543210: New issue - Observer Pattern in JS

📢 Newsletter Published: Strategy Pattern in JS
📨 Email to alice@example.com: New issue - Strategy Pattern in JS

```

#

**✅ When to Use Observer Pattern**

  - Event-driven systems (e.g., user input, DOM events).
  - Real-time updates (e.g., chat apps, live dashboards).
  - Decoupling: when objects should react to changes without tightly coupling them.

#

**Bonus 🎁: With ES6 Events (CustomEvent)**

If working with the DOM, you can also use built-in event mechanisms:

```js
const myEventTarget = new EventTarget();

myEventTarget.addEventListener("published", (e) => {
  console.log("Received newsletter:", e.detail);
});

myEventTarget.dispatchEvent(new CustomEvent("published", {
  detail: "Custom Events in JavaScript"
}));

```
 

