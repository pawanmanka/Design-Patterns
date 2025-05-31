import { User } from './User.js';
export  class UserBuilder {
  constructor() {
    this.user = new User();
  }

  setName(name) {
    this.user.name = name;
    return this;
  }

  setEmail(email) {
    this.user.email = email;
    return this;
  }

  setAge(age) {
    this.user.age = age;
    return this;
  }

  setAddress(address) {
    this.user.address = address;
    return this;
  }

  build() {
    return this.user;
  }
}
