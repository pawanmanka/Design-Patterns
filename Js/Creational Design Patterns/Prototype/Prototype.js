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
