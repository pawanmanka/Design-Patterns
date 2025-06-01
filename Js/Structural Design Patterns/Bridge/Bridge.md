**🧠 Concept Recap (Bridge Pattern)**
“Decouple abstraction from implementation so both can vary independently.”

Imagine:
- An abstraction like a Remote Control.
- Implementations like TV and Radio.

**🛠️ JavaScript Example: Remote + Device**

**🔌 1. Device Interface (Implementor)**
```js
class Device {
  turnOn() {
    throw new Error("Method 'turnOn()' must be implemented.");
  }

  turnOff() {
    throw new Error("Method 'turnOff()' must be implemented.");
  }

  setVolume(level) {
    throw new Error("Method 'setVolume()' must be implemented.");
  }
}

```
#

**📺 2. Concrete Devices**
```js
class TV extends Device {
  turnOn() {
    console.log("TV is ON");
  }

  turnOff() {
    console.log("TV is OFF");
  }

  setVolume(level) {
    console.log(`TV volume set to ${level}`);
  }
}

class Radio extends Device {
  turnOn() {
    console.log("Radio is ON");
  }

  turnOff() {
    console.log("Radio is OFF");
  }

  setVolume(level) {
    console.log(`Radio volume set to ${level}`);
  }
}

```
#

**🕹️ 3. Abstraction: Remote Control**

```js
class RemoteControl {
  constructor(device) {
    this.device = device;
  }

  turnOn() {
    this.device.turnOn();
  }

  turnOff() {
    this.device.turnOff();
  }

  setVolume(level) {
    this.device.setVolume(level);
  }
}

```
#
**🔊 4. Extended Abstraction: Advanced Remote**
```js
class AdvancedRemote extends RemoteControl {
  mute() {
    console.log("Muting...");
    this.device.setVolume(0);
  }
}

```
#

**✅ 5. Usage Example**
```js
const tv = new TV();
const tvRemote = new AdvancedRemote(tv);

tvRemote.turnOn();           // TV is ON
tvRemote.setVolume(15);      // TV volume set to 15
tvRemote.mute();             // Muting... TV volume set to 0
tvRemote.turnOff();          // TV is OFF

const radio = new Radio();
const radioRemote = new RemoteControl(radio);

radioRemote.turnOn();        // Radio is ON
radioRemote.setVolume(5);    // Radio volume set to 5
radioRemote.turnOff();       // Radio is OFF

```

#

**✅ Benefits Recap**

| Advantage                | Explanation                                          |
| ------------------------ | ---------------------------------------------------- |
| 🔗 Decouples abstraction | You can change remote/device independently           |
| 🔄 Flexible combinations | Combine any Remote with any Device dynamically       |
| 🧱 Scalable              | Add new remotes or devices without touching old code |

#

**💡 Real-World JavaScript Use Cases**
| Use Case        | Abstraction            | Implementation           |
| --------------- | ---------------------- | ------------------------ |
| Payment Systems | Payment class          | Stripe, PayPal, Razorpay |
| Logging         | Logger class           | Console, File, Remote    |
| UI Components   | Button, Modal, etc.    | Theme: Light, Dark       |
| Drawing Tools   | Shape (Circle, Square) | Canvas, SVG              |

