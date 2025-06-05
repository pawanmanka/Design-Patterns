In PHP, final and readonly are keywords used to restrict behavior in classes, methods, and properties. Each serves a different purpose related to inheritance and immutability.

✅ final Keyword
Purpose: Prevents overriding of methods or inheritance of classes.

1. Final Class
You cannot extend a class marked as final.

```php
final class Vehicle {
    public function drive() {
        echo "Driving...";
    }
}

// Error: Class Car cannot extend final class Vehicle
class Car extends Vehicle {}

```

2. Final Method
You cannot override a method marked as final.

```php
class Vehicle {
    final public function drive() {
        echo "Driving...";
    }
}

class Car extends Vehicle {
    // Error: Cannot override final method Vehicle::drive()
    public function drive() {
        echo "Driving fast...";
    }
}

```

✅ readonly Keyword (PHP 8.1+)
Purpose: Ensures a property can be written only once, usually during construction.

Basic Syntax:

```php
class User {
    public readonly string $name;

    public function __construct(string $name) {
        $this->name = $name; // ✅ allowed here
    }

    public function changeName(string $newName) {
        // ❌ Error: Cannot modify readonly property
        $this->name = $newName;
    }
}

```

Key Rules:
- readonly properties must be typed.
- They can be assigned only once, either:
    - in the constructor,
    - or directly in the declaration (public readonly int $id = 10;).
- After assignment, they are immutable.

✅ Use Case Summary

| Keyword    | Use Case                                     | Restricts         |
| ---------- | -------------------------------------------- | ----------------- |
| `final`    | Prevent class extension or method overriding | Inheritance       |
| `readonly` | Make property immutable after initialization | Property mutation |
