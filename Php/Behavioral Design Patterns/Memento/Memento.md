The Memento Design Pattern in PHP is used to capture and restore an object’s internal state without violating encapsulation. It's often used in undo/redo functionality, game state saving, form versioning, etc.

🧠 Real-World Analogy

Think of saving a game. You can restore the game to a saved state later. The game (Originator) creates a save (Memento), and something (Caretaker) stores it.

✅ Participants

| Role           | Description                                        |
| -------------- | -------------------------------------------------- |
| **Originator** | The object whose state we want to save and restore |
| **Memento**    | Stores the internal state of the Originator        |
| **Caretaker**  | Keeps the Memento but doesn’t modify it            |


🧪 Example: Text Editor with Undo Feature

1. Memento Class
```php
class TextMemento {
    public function __construct(
        private readonly string $text
    ) {}

    public function getText(): string {
        return $this->text;
    }
}

```

2. Originator (e.g., TextEditor)

```php
class TextEditor {
    private string $text = '';

    public function type(string $words): void {
        $this->text .= $words;
    }

    public function getText(): string {
        return $this->text;
    }

    public function save(): TextMemento {
        return new TextMemento($this->text);
    }

    public function restore(TextMemento $memento): void {
        $this->text = $memento->getText();
    }
}

```

3. Caretaker

```php
class TextHistory {
    private array $history = [];

    public function push(TextMemento $memento): void {
        $this->history[] = $memento;
    }

    public function pop(): ?TextMemento {
        return array_pop($this->history);
    }
}

```

4. Client Code

```php
$editor = new TextEditor();
$history = new TextHistory();

$editor->type("Hello ");
$history->push($editor->save());

$editor->type("World!");
$history->push($editor->save());

$editor->type(" This won't stay.");
echo "📝 Current: " . $editor->getText() . "\n";

// Undo twice
$editor->restore($history->pop());
echo "↩️ After undo: " . $editor->getText() . "\n";

$editor->restore($history->pop());
echo "↩️ After second undo: " . $editor->getText() . "\n";

```

✅ When to Use Memento Pattern

- Implementing undo/redo
- Saving and restoring user preferences
- Storing object state snapshots (like config backups, game levels, etc.)