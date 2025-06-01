Flyweight is a structural design pattern that lets you fit more objects into the available amount of RAM by sharing common parts of state between multiple objects instead of keeping all of the data in each object.

🧠 Key Concepts of Flyweight Pattern

- Separates intrinsic state (shared, reusable) from extrinsic state (unique per use).
- Suitable when there are many objects with shared data (e.g., GUI elements, game characters).
- Useful for performance optimization, especially in memory-constrained environments.

🏗️ Structure

- Flyweight – interface or abstract class
- ConcreteFlyweight – stores intrinsic (shared) state
- FlyweightFactory – creates and manages flyweight objects
- Client – uses flyweights and provides extrinsic data


✅ Real-World Example 1: Text Editor – Character Objects

Imagine a text editor that renders millions of characters. Instead of creating an object for each character with font info, we share font formatting using Flyweight.

🧱 Step 1: Flyweight Interface

```php
interface CharacterFlyweight {
    public function render($position);
}

```
🧱 Step 2: Concrete Flyweight (shared formatting)

```php
class Character implements CharacterFlyweight {
    private $char;
    private $font;
    private $size;
    private $color;

    public function __construct($char, $font, $size, $color) {
        $this->char = $char;
        $this->font = $font;
        $this->size = $size;
        $this->color = $color;
    }

    public function render($position) {
        echo "Rendering '{$this->char}' at {$position} using {$this->font}, {$this->size}px, {$this->color}\n";
    }
}

```

🧱 Step 3: Flyweight Factory

```php
class CharacterFactory {
    private $characters = [];

    public function get($char, $font, $size, $color) {
        $key = md5($char.$font.$size.$color);
        if (!isset($this->characters[$key])) {
            $this->characters[$key] = new Character($char, $font, $size, $color);
        }
        return $this->characters[$key];
    }

    public function count() {
        return count($this->characters);
    }
}

```

✅ Usage

```php
$factory = new CharacterFactory();

$text = "HELLO WORLD";
$font = "Arial";
$size = 12;
$color = "black";

for ($i = 0; $i < strlen($text); $i++) {
    $char = $text[$i];
    $flyweight = $factory->get($char, $font, $size, $color);
    $flyweight->render($i);
}

echo "Total unique Character objects: " . $factory->count();

```
## **✅ Instead of 11 objects, it might reuse shared ones (like multiple 'L', 'O').**


**🔍 When to Use Flyweight**
- Large number of similar objects (e.g., icons, characters, shapes)
- Performance/memory optimization
- GUI or rendering-heavy applications

**❌ When NOT to Use**
- When object uniqueness is required
- When shared state logic becomes too complex
- When performance benefit is negligible

**✅ Summary**

| Feature            | Flyweight Pattern                      |
| ------------------ | -------------------------------------- |
| Goal               | Reduce memory via shared objects       |
| Key Concept        | Intrinsic (shared) vs extrinsic state  |
| Common Use Cases   | Text rendering, maps, GUIs, games      |
| PHP Implementation | Use factories to manage shared objects |
