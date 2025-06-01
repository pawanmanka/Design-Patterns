The Decorator Pattern in JavaScript is a structural design pattern used to add new behavior to objects dynamically, without modifying their original structure or class.

🎯 Use Case
Suppose you have a base object (e.g., a simple coffee), and you want to add optional features (like milk or sugar) at runtime, without rewriting or subclassing the base.

🧠 Concept
```php
function baseFunctionality() {
  return "Base";
}

function decoratorA(func) {
  return function () {
    return func() + " + A";
  };
}

function decoratorB(func) {
  return function () {
    return func() + " + B";
  };
}

let base = baseFunctionality;
base = decoratorA(base);
base = decoratorB(base);

console.log(base()); // Output: "Base + A + B"

```
#

**☕ Real-World Example: Coffee Order**
1. Base Class
```js
class Coffee {
  getCost() {
    return 5;
  }

  getDescription() {
    return "Plain Coffee";
  }
}

```

2. Decorators

```js
class MilkDecorator {
  constructor(coffee) {
    this.coffee = coffee;
  }

  getCost() {
    return this.coffee.getCost() + 1.5;
  }

  getDescription() {
    return this.coffee.getDescription() + ", Milk";
  }
}

class SugarDecorator {
  constructor(coffee) {
    this.coffee = coffee;
  }

  getCost() {
    return this.coffee.getCost() + 0.5;
  }

  getDescription() {
    return this.coffee.getDescription() + ", Sugar";
  }
}

```
3. Usage
```js
let myCoffee = new Coffee();
myCoffee = new MilkDecorator(myCoffee);
myCoffee = new SugarDecorator(myCoffee);

console.log(myCoffee.getDescription()); // Plain Coffee, Milk, Sugar
console.log(myCoffee.getCost());        // 7.0

```