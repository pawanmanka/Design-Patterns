**🔧 What is the Adapter Pattern?**
The Adapter Pattern is a structural design pattern that allows incompatible objects to work together by converting one object’s interface into an interface expected by the client.

It’s like adding a USB-C to Lightning adapter so you can charge your iPhone with a USB-C cable.

**🧱 Components**

| Component   | Role                                                             |
| ----------- | ---------------------------------------------------------------- |
| **Client**  | Code expecting a specific interface                              |
| **Target**  | The expected interface                                           |
| **Adaptee** | An existing class or API with a different/incompatible interface |
| **Adapter** | Converts the adaptee's interface to the target interface         |

**🎯 When to Use It**

- Integrating legacy code into new architecture.
- Supporting multiple third-party APIs with different formats.
- Bridging old and new versions of a system.
- Creating abstraction layers to decouple logic from implementation.

**✅ Simple Example**
🔸 Adaptee: Third-party logging service

```js
class FancyLogger {
  logMessage(msg) {
    console.log(`[FancyLog]: ${msg}`);
  }
}

```
**🔹 Target Interface: What the client expects**

```js
// Client expects this:
function doLogging(logger) {
  logger.log("Something important");
}

```
**🔧 Adapter: Wraps FancyLogger**

```js
class LoggerAdapter {
  constructor(fancyLogger) {
    this.fancyLogger = fancyLogger;
  }

  log(message) {
    this.fancyLogger.logMessage(message);
  }
}

```

**🧪 Client Code**

```js
const fancy = new FancyLogger();
const adapter = new LoggerAdapter(fancy);

doLogging(adapter); // Output: [FancyLog]: Something important

```
