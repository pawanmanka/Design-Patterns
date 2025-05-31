The Prototype Design Pattern in JavaScript leverages JavaScript’s built-in prototype-based inheritance system to allow object cloning — particularly useful when object creation is costly or repetitive.

🧠 What Is It?
The Prototype Pattern involves:

Creating an object as a prototype.

Using that prototype to create clones (copies).

Modifying the copies without affecting the original.


✅ Use Case
Useful when:

You need many similar objects.

Creating a new object from scratch is expensive.

You want a shared template object for customization.


🔧 Example
🧱 Step 1: Define a Prototype Object

const carPrototype = {
  type: "car",
  wheels: 4,
  drive() {
    console.log(`Driving a ${this.color} ${this.brand}`);
  }
};


🧪 Step 2: Clone It Using Object.create()

const car1 = Object.create(carPrototype);
car1.brand = "Toyota";
car1.color = "red";

const car2 = Object.create(carPrototype);
car2.brand = "BMW";
car2.color = "black";

🚗 Step 3: Use the Clones

car1.drive(); // Driving a red Toyota
car2.drive(); // Driving a black BMW


✅ Alternative: Using Classes + clone()
If you're using classes and want a clone() method:

class Car {
  constructor(brand, color) {
    this.brand = brand;
    this.color = color;
  }

  drive() {
    console.log(`Driving a ${this.color} ${this.brand}`);
  }

  clone() {
    return new Car(this.brand, this.color);
  }
}

const car1 = new Car("Tesla", "white");
const car2 = car1.clone();
car2.color = "black";

car1.drive(); // Driving a white Tesla
car2.drive(); // Driving a black Tesla


🧩 Summary
Pattern Feature	JavaScript Syntax
Create from prototype	Object.create(proto)
Clone class instance	Custom clone() method
Shared behavior	Prototype functions and properties