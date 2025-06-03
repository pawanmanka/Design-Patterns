The Chain of Responsibility (CoR) pattern in JavaScript lets you pass a request along a chain of handlers. Each handler can either:
- Handle the request.
- Or pass it to the next handler

This decouples the sender of the request from its potential receivers.

#

**🧠 Real-World Example: Support Ticket System**

We'll simulate a support system with three handlers:

- Level1Support
- Level2Support
- ManagerSupport

Each one handles a different type of ticket.

**✅ Step-by-Step Implementation**

**🔧 1. Base Handler Class**

```js
class Handler {
  setNext(handler) {
    this.nextHandler = handler;
    return handler; // Allow chaining
  }

  handle(request) {
    if (this.nextHandler) {
      return this.nextHandler.handle(request);
    }

    return `No one could handle the request: ${request}`;
  }
}

```

#

**🔧 2. Concrete Handlers**

```js
class Level1Support extends Handler {
  handle(request) {
    if (request === "basic") {
      return "Level 1 handled the basic issue.";
    }
    return super.handle(request);
  }
}

class Level2Support extends Handler {
  handle(request) {
    if (request === "intermediate") {
      return "Level 2 handled the intermediate issue.";
    }
    return super.handle(request);
  }
}

class ManagerSupport extends Handler {
  handle(request) {
    if (request === "critical") {
      return "Manager handled the critical issue.";
    }
    return super.handle(request);
  }
}

```

#

**🚀 3. Chain and Use**

```js
const level1 = new Level1Support();
const level2 = new Level2Support();
const manager = new ManagerSupport();

// Chain them
level1.setNext(level2).setNext(manager);

// Test different types of requests
console.log(level1.handle("basic"));       // Level 1 handled the basic issue.
console.log(level1.handle("intermediate"));// Level 2 handled the intermediate issue.
console.log(level1.handle("critical"));    // Manager handled the critical issue.
console.log(level1.handle("unknown"));     // No one could handle the request: unknown

```