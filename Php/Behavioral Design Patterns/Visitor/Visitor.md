The Visitor Design Pattern lets you add new operations to a set of objects without changing their classes. It’s particularly useful when you have a structure (like a tree or hierarchy of elements) and you want to perform various unrelated operations (e.g., rendering, validation, exporting) on those elements without modifying them.

🧠 Real-World Analogy
Imagine a tax auditor visiting various types of businesses:

Bakery

Pharmacy

Tech Company

Each business lets the auditor in, and the auditor performs tax evaluation based on the type of business. The businesses don’t know the details — the visitor does.



✅ Participants

| Role                | Description                                           |
| ------------------- | ----------------------------------------------------- |
| **Visitor**         | Declares a `visitX()` method for each element type    |
| **ConcreteVisitor** | Implements the operations for each element type       |
| **Element**         | Declares `accept(Visitor)` to let visitor do its work |
| **ConcreteElement** | Implements `accept` and calls back the visitor        |


🧪 Example: Document Parts (Text, Image) with Visitor (HTML Renderer)

1. Visitor Interface

```php
interface DocumentVisitor {
    public function visitText(Text $text): void;
    public function visitImage(Image $image): void;
}

```

2. Element Interface

```php
interface DocumentElement {
    public function accept(DocumentVisitor $visitor): void;
}

```

3. Concrete Elements

```php
class Text implements DocumentElement {
    public function __construct(public string $content) {}

    public function accept(DocumentVisitor $visitor): void {
        $visitor->visitText($this);
    }
}

class Image implements DocumentElement {
    public function __construct(public string $url) {}

    public function accept(DocumentVisitor $visitor): void {
        $visitor->visitImage($this);
    }
}

```
4. Concrete Visitor (HTML Renderer)

```php
class HtmlRenderer implements DocumentVisitor {
    public function visitText(Text $text): void {
        echo "<p>{$text->content}</p>\n";
    }

    public function visitImage(Image $image): void {
        echo "<img src=\"{$image->url}\" />\n";
    }
}

```

5. Client Code

```php
$document = [
    new Text("Hello, World!"),
    new Image("logo.png"),
    new Text("Thanks for visiting."),
];

$renderer = new HtmlRenderer();

foreach ($document as $element) {
    $element->accept($renderer);
}

```

🧾 Output
```
<p>Hello, World!</p>
<img src="logo.png" />
<p>Thanks for visiting.</p>

```
✅ When to Use Visitor Pattern

- You need to perform many unrelated operations on a set of objects

- You want to avoid bloating classes with too many responsibilities

- You need to add operations without modifying existing code (Open/Closed Principle)

⚠️ Drawbacks
- Breaking the pattern requires updating the visitor every time a new element type is added

- It can make maintenance harder if new element types change frequently


#

Great! Let’s walk through a real-world Laravel-style example of the Visitor Design Pattern to export Eloquent models in multiple formats (e.g., JSON, HTML, XML) without modifying the models themselves.


🧾 Use Case:
You want to export various models — User, Post, Comment — in different formats.
Each export format is a new operation, but the models remain unchanged.


✅ Step-by-Step Laravel-Friendly Example


🧩 1. Create a Visitable Interface
```php
interface Exportable {
    public function accept(ExporterVisitor $visitor): mixed;
}

```

🧩 2. Create the Visitor Interface

```php
interface ExporterVisitor {
    public function visitUser(User $user): mixed;
    public function visitPost(Post $post): mixed;
    public function visitComment(Comment $comment): mixed;
}

```

🧩 3. Update Eloquent Models to Be "Exportable"

Example: User.php

```php
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Exportable {
    public function accept(ExporterVisitor $visitor): mixed {
        return $visitor->visitUser($this);
    }
}

```
Similarly for Post and Comment:

```php
class Post extends Model implements Exportable {
    public function accept(ExporterVisitor $visitor): mixed {
        return $visitor->visitPost($this);
    }
}

class Comment extends Model implements Exportable {
    public function accept(ExporterVisitor $visitor): mixed {
        return $visitor->visitComment($this);
    }
}

```

🧩 4. Create a Concrete Visitor: JsonExporter

```php
class JsonExporter implements ExporterVisitor {
    public function visitUser(User $user): string {
        return json_encode([
            'type' => 'User',
            'id' => $user->id,
            'name' => $user->name,
        ]);
    }

    public function visitPost(Post $post): string {
        return json_encode([
            'type' => 'Post',
            'id' => $post->id,
            'title' => $post->title,
        ]);
    }

    public function visitComment(Comment $comment): string {
        return json_encode([
            'type' => 'Comment',
            'id' => $comment->id,
            'text' => $comment->text,
        ]);
    }
}

```

🧩 5. Add Another Visitor: HtmlExporter (Optional)

```php
class HtmlExporter implements ExporterVisitor {
    public function visitUser(User $user): string {
        return "<div><h3>User: {$user->name}</h3></div>";
    }

    public function visitPost(Post $post): string {
        return "<div><h3>Post: {$post->title}</h3></div>";
    }

    public function visitComment(Comment $comment): string {
        return "<div><p>Comment: {$comment->text}</p></div>";
    }
}

```

🧪 6. Usage in Controller or Service

```php
$models = [
    User::find(1),
    Post::find(1),
    Comment::find(1),
];

$exporter = new JsonExporter(); // or new HtmlExporter();

foreach ($models as $model) {
    echo $model->accept($exporter) . "\n";
}

```

✅ Benefits in Laravel
Open/Closed Principle: Easily add new exporters without changing models

Works great with Service classes and Model decorators

Helps keep Eloquent models lean and clean

Extensible for formats like PDF, CSV, etc.

📦 Bonus: Registering Exporters as Laravel Services
You could bind exporters in the container for easy switching: