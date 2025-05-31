The Factory Design Pattern is a creational design pattern used to create objects without specifying the exact class of object that will be created. It allows for object creation logic to be centralized in a method or class, and promotes loose coupling by eliminating the need for code to depend on specific classes.

🏭 Factory Design Pattern in JavaScript
✅ Key Concepts:
- Centralizes object creation.
- Abstracts the instantiation process.
- Makes it easy to manage and scale object creation logic.

💡 Basic Example

```js
class Car {
  constructor() {
    this.type = 'Car';
  }
}

class Truck {
  constructor() {
    this.type = 'Truck';
  }
}

class VehicleFactory {
  static createVehicle(type) {
    switch (type) {
      case 'car':
        return new Car();
      case 'truck':
        return new Truck();
      default:
        throw new Error('Unknown vehicle type');
    }
  }
}

// Usage
const car = VehicleFactory.createVehicle('car');
console.log(car.type); // Car

const truck = VehicleFactory.createVehicle('truck');
console.log(truck.type); // Truck

```

🔧 Types of Factory Patterns
1. Simple Factory (Static Factory Method)
- A static method that returns different types of objects based on input.
- Not a GoF (Gang of Four) pattern, but widely used.

```js
class ShapeFactory {
  static createShape(type) {
    if (type === 'circle') return new Circle();
    if (type === 'square') return new Square();
  }
}

```
2. Factory Method Pattern
- Defines an interface for creating an object, but lets subclasses alter the type of objects that will be created.

```js
class Developer {
  createTool() {}
}

class FrontendDeveloper extends Developer {
  createTool() {
    return new ReactJS();
  }
}

class BackendDeveloper extends Developer {
  createTool() {
    return new NodeJS();
  }
}

function hire(devType) {
  let dev;
  if (devType === 'frontend') {
    dev = new FrontendDeveloper();
  } else {
    dev = new BackendDeveloper();
  }
  return dev.createTool();
}

```
3. Abstract Factory Pattern
- Provides an interface for creating families of related or dependent objects without specifying their concrete classes.
- Think of it as a factory of factories.

```js
class MacUIFactory {
  createButton() {
    return new MacButton();
  }
  createCheckbox() {
    return new MacCheckbox();
  }
}

class WinUIFactory {
  createButton() {
    return new WinButton();
  }
  createCheckbox() {
    return new WinCheckbox();
  }
}

function getUIFactory(os) {
  if (os === 'mac') return new MacUIFactory();
  if (os === 'windows') return new WinUIFactory();
}

const uiFactory = getUIFactory('mac');
const button = uiFactory.createButton();

```

✅ When to Use Factory Pattern
`- When the object creation process is complex.
'- When the system needs to be decoupled from how objects are created.
' - When you need to centralize configuration or setup of objects.

