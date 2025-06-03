The State Design Pattern in PHP allows an object to change its behavior when its internal state changes, as if the object changed its class. It’s ideal when an object’s behavior depends on its current state, and it must switch between states at runtime.

🧠 Real-World Analogy
Think of a document in a publishing system:
It can be in Draft, Moderation, or Published state. Each state defines different behavior for actions like "edit", "publish", or "review".

✅ Participants

| Component           | Responsibility                              |
| ------------------- | ------------------------------------------- |
| **Context**         | Maintains the current state                 |
| **State Interface** | Defines the behavior for different states   |
| **Concrete States** | Implements behavior for each specific state |


🧪 Example: Document Workflow (Draft → Moderation → Published)

1. State Interface

```php
interface DocumentState {
    public function handle(Document $document): void;
    public function getName(): string;
}

```

2. Concrete States

```php
class DraftState implements DocumentState {
    public function handle(Document $document): void {
        echo "Moving from Draft to Moderation.\n";
        $document->setState(new ModerationState());
    }

    public function getName(): string {
        return "Draft";
    }
}

class ModerationState implements DocumentState {
    public function handle(Document $document): void {
        echo "Moderating... Now publishing.\n";
        $document->setState(new PublishedState());
    }

    public function getName(): string {
        return "Moderation";
    }
}

class PublishedState implements DocumentState {
    public function handle(Document $document): void {
        echo "Document is already published. No further state.\n";
    }

    public function getName(): string {
        return "Published";
    }
}

```

3. Context: Document

```php
class Document {
    private DocumentState $state;

    public function __construct() {
        $this->state = new DraftState();
    }

    public function setState(DocumentState $state): void {
        $this->state = $state;
    }

    public function applyState(): void {
        $this->state->handle($this);
    }

    public function getStateName(): string {
        return $this->state->getName();
    }
}

```

4. Client Code

```php
$doc = new Document();
echo "📝 Current State: " . $doc->getStateName() . "\n";

$doc->applyState(); // Move to Moderation
echo "📝 Current State: " . $doc->getStateName() . "\n";

$doc->applyState(); // Move to Published
echo "📝 Current State: " . $doc->getStateName() . "\n";

$doc->applyState(); // Already published

```