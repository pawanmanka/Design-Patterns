Singleton is a creational design pattern that lets you ensure that a class has only one instance, while providing a global access point to this instance.



The Singleton Design Pattern in JavaScript ensures that a class or object has only one instance and provides a global point of access to it. This is useful for shared services like:

Config managers

Logging utilities

API clients

Caches

✅ 1. Classic Singleton using a Class


class Singleton {
  constructor() {
    if (Singleton.instance) {
      return Singleton.instance;
    }

    this.timestamp = new Date().toISOString(); // Example state
    Singleton.instance = this;
  }

  log() {
    console.log('Singleton instance at:', this.timestamp);
  }
}

// Usage
const a = new Singleton();
const b = new Singleton();

a.log(); // Singleton instance at: 2025-05-28T10:00:00.000Z
b.log(); // Same timestamp as above

console.log(a === b); // true


✅ 2. Singleton using an IIFE (Immediately Invoked Function Expression)


const Singleton = (() => {
  let instance;

  function createInstance() {
    return {
      time: new Date().toISOString(),
      log() {
        console.log('IIFE Singleton time:', this.time);
      }
    };
  }

  return {
    getInstance() {
      if (!instance) {
        instance = createInstance();
      }
      return instance;
    }
  };
})();

// Usage
const inst1 = Singleton.getInstance();
const inst2 = Singleton.getInstance();

inst1.log(); // IIFE Singleton time: 2025-05-28T10:00:00.000Z
inst2.log(); // Same as inst1

console.log(inst1 === inst2); // true


✅ 3. Using ES6 Modules (Best for Modern Apps)

singleton.js

js
Copy
Edit
class ConfigService {
  constructor() {
    this.createdAt = new Date().toISOString();
  }

  log() {
    console.log('Config created at:', this.createdAt);
  }
}

const instance = new ConfigService();
export default instance;
app.js

js
Copy
Edit
import config from './singleton.js';

config.log();
ES modules are singleton by default — importing the same module multiple times gives the same instance.

✅ Summary
Method	Singleton Scope	Suitable For
Class Pattern	Custom logic	Node.js / Browser apps
IIFE Pattern	Encapsulated	Utility functions / libraries
ES6 Module	Native module	Modern frontend/backend projects
