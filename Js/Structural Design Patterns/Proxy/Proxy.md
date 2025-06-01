The Proxy Design Pattern in JavaScript uses the built-in Proxy object to control access to another object. It’s commonly used for lazy initialization, access control, logging, caching, and validation.

🧠 Concept
In the Proxy Design Pattern:
- A Proxy acts as a surrogate or placeholder for another object.
- It controls access to the real object and can add extra behavior like:
    - Access control
    - Lazy loading
    - Logging
    - Caching


✅ Basic Proxy Pattern Example (Logging)
```js
// Real Subject
const user = {
  name: "Alice",
  age: 25
};

// Proxy
const proxyUser = new Proxy(user, {
  get(target, prop) {
    console.log(`Accessed ${prop}`);
    return target[prop];
  },
  set(target, prop, value) {
    console.log(`Set ${prop} to ${value}`);
    target[prop] = value;
    return true;
  }
});

// Usage
console.log(proxyUser.name); // Logs and returns "Alice"
proxyUser.age = 30;          // Logs the set operation

```

💡 Example 1: Virtual Proxy (Lazy Initialization)

```js

class HeavyResource {
  constructor() {
    console.log("HeavyResource loaded!");
  }

  doWork() {
    console.log("HeavyResource is working!");
  }
}

function createHeavyProxy() {
  let resource = null;
  return {
    doWork: () => {
      if (!resource) {
        resource = new HeavyResource(); // Lazy init
      }
      resource.doWork();
    }
  };
}

// Usage
const proxy = createHeavyProxy();
console.log("Before calling doWork");
proxy.doWork(); // Instantiates and calls
proxy.doWork(); // Reuses instance
```