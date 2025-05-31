import { UserBuilder } from './UserBuilder.js';

const builder = new UserBuilder();
const user = builder.setName("Alice").setEmail("alice@example.com").build();
user.display();