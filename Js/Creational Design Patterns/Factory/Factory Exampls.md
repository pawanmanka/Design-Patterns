🔐 Real-World Use Case: User Role Factory
Imagine you’re building an app with different user types: Admin, Editor, and Viewer, each having different permissions. A factory will simplify user creation.

🧱 Step-by-Step: Role-Based Factory in JavaScript
1. Define Role Classes
```js
class Admin {
  constructor(name) {
    this.name = name;
    this.role = 'Admin';
  }

  permissions() {
    return ['read', 'write', 'delete'];
  }
}

class Editor {
  constructor(name) {
    this.name = name;
    this.role = 'Editor';
  }

  permissions() {
    return ['read', 'write'];
  }
}

class Viewer {
  constructor(name) {
    this.name = name;
    this.role = 'Viewer';
  }

  permissions() {
    return ['read'];
  }
}

```
2. User Factory

```js
class UserFactory {
  static createUser(role, name) {
    switch (role.toLowerCase()) {
      case 'admin':
        return new Admin(name);
      case 'editor':
        return new Editor(name);
      case 'viewer':
        return new Viewer(name);
      default:
        throw new Error(`Invalid role: ${role}`);
    }
  }
}

```

3. Usage Example

```js
const users = [
  UserFactory.createUser('admin', 'Alice'),
  UserFactory.createUser('editor', 'Bob'),
  UserFactory.createUser('viewer', 'Charlie')
];

users.forEach(user => {
  console.log(`${user.name} (${user.role}) → Permissions: ${user.permissions().join(', ')}`);
});

```

✅ Output

```
Alice (Admin) → Permissions: read, write, delete  
Bob (Editor) → Permissions: read, write  
Charlie (Viewer) → Permissions: read

```

🧠 Benefits Demonstrated:
- Encapsulation of creation logic.
- Single Responsibility: Roles and factory are separated.
- Easy to extend (e.g., add a "SuperAdmin" later).
- Reduces tight coupling to class names.

