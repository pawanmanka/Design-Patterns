Builder is a creational design pattern that lets you construct complex objects step by step. The pattern allows you to produce different types and representations of an object using the same construction code.


The Builder Design Pattern in PHP is a creational pattern that allows you to build complex objects step by step. It's especially useful when:

An object has many optional parameters.

You want to separate the construction logic from the object itself.

You need different representations of the same object (e.g., HTML vs JSON vs XML)


✅ Real-World Analogy
Imagine building a house: You don’t give a constructor all materials at once. Instead, you lay the foundation, build walls, add a roof, etc.

✅ When to Use Builder Pattern
When constructors or factory methods are getting complex.

When you want to construct different variations of an object.

When object construction requires a strict sequence.


✅ Use Case: Building a User Profile
🎯 Goal
Construct a User object with optional fields like name, email, age, and address using a Builder.

🧱 1. Product: User
php
Copy
Edit
class User
{
    public string $name;
    public string $email;
    public ?int $age = null;
    public ?string $address = null;

    public function display()
    {
        echo "Name: {$this->name}\n";
        echo "Email: {$this->email}\n";
        echo "Age: " . ($this->age ?? 'N/A') . "\n";
        echo "Address: " . ($this->address ?? 'N/A') . "\n";
    }
}
🛠️ 2. Builder Interface
php
Copy
Edit
interface UserBuilderInterface
{
    public function setName(string $name): self;
    public function setEmail(string $email): self;
    public function setAge(int $age): self;
    public function setAddress(string $address): self;
    public function build(): User;
}
🧰 3. Concrete Builder
php
Copy
Edit
class UserBuilder implements UserBuilderInterface
{
    private User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function setName(string $name): self
    {
        $this->user->name = $name;
        return $this;
    }

    public function setEmail(string $email): self
    {
        $this->user->email = $email;
        return $this;
    }

    public function setAge(int $age): self
    {
        $this->user->age = $age;
        return $this;
    }

    public function setAddress(string $address): self
    {
        $this->user->address = $address;
        return $this;
    }

    public function build(): User
    {
        return $this->user;
    }
}
🚀 4. Usage
php
Copy
Edit
$builder = new UserBuilder();

$user = $builder
    ->setName("John Doe")
    ->setEmail("john@example.com")
    ->setAge(30)
    ->setAddress("123 Main St")
    ->build();

$user->display();
🖨️ Output
makefile
Copy
Edit
Name: John Doe
Email: john@example.com
Age: 30
Address: 123 Main St
✅ Benefits of Builder Pattern
Clean, fluent API.

Easily customizable object creation.

No need for large constructors with many parameters.

Great for unit testing and code readability.

Let me know if you'd like this converted for use in a Laravel model factory or for JSON API responses!