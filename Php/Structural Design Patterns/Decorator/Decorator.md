The Decorator Design Pattern in PHP is a structural pattern that lets you add new behaviors to objects dynamically at runtime without changing their class.

**🧠 What Is the Decorator Pattern?**
The Decorator Pattern wraps an object with another object that adds new behavior while keeping the same interface.

Think of it like wrapping a gift box: the gift stays the same, but the wrapping adds appearance or function (e.g., tags, bows).

**🛠️ Use Case Example**
Scenario: You have a simple text formatter.
Later, you want to add HTML formatting (like bold, italic, underline), without modifying the original formatter.

✅ Step-by-Step Implementation in PHP


1. Component Interface

```php
interface TextFormatter {
    public function format(string $text): string;
}
```

2. Concrete Component

```php
class PlainText implements TextFormatter {
    public function format(string $text): string {
        return $text;
    }
}
```
3. Base Decorator
```php
class TextDecorator implements TextFormatter {
    protected TextFormatter $formatter;

    public function __construct(TextFormatter $formatter) {
        $this->formatter = $formatter;
    }

    public function format(string $text): string {
        return $this->formatter->format($text);
    }
}

```
4. Concrete Decorators

```php
class BoldDecorator extends TextDecorator {
    public function format(string $text): string {
        return "<b>" . parent::format($text) . "</b>";
    }
}

class ItalicDecorator extends TextDecorator {
    public function format(string $text): string {
        return "<i>" . parent::format($text) . "</i>";
    }
}

class UnderlineDecorator extends TextDecorator {
    public function format(string $text): string {
        return "<u>" . parent::format($text) . "</u>";
    }
}


```

5. Client Code

```php
$text = new PlainText();
$decorated = new BoldDecorator(new ItalicDecorator(new UnderlineDecorator($text)));

echo $decorated->format("Hello World!");
// Output: <b><i><u>Hello World!</u></i></b>


```

🎯 Why Use the Decorator Pattern?

| Benefit                 | Explanation                                                         |
| ----------------------- | ------------------------------------------------------------------- |
| ✅ Open/Closed Principle | Add behavior without modifying existing classes                     |
| 🔄 Reusable & Flexible  | Combine decorators in any order                                     |
| 🔧 Runtime Decoration   | Can decorate conditionally or dynamically                           |
| 🧼 Clean Code           | Avoids bloated class hierarchies (no BoldItalicUnderlineText class) |

