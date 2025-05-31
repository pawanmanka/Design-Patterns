
export class User {
  constructor() {
    this.name = '';
    this.email = '';
    this.age = null;
    this.address = '';
  }

  display() {
    console.log(`Name: ${this.name}`);
    console.log(`Email: ${this.email}`);
    console.log(`Age: ${this.age}`);
    console.log(`Address: ${this.address}`);
  }
}
