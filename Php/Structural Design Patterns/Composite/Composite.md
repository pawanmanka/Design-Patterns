The Composite Design Pattern is a structural pattern used to treat individual objects and compositions of objects uniformly. It’s ideal when dealing with tree-like structures such as menus, folders, or GUIs.


🧠 Concept
Allows clients to treat individual objects and groups of objects the same way.

📦 Real-World Use Case: File System
Imagine:

- A file is a single unit.

- A folder contains files or other folders.
- You want to perform the same operation on both (e.g., show()).

🧱 Structure

| Role      | Description                               |
| --------- | ----------------------------------------- |
| Component | Declares the interface (`FileSystemItem`) |
| Leaf      | Represents individual object (`File`)     |
| Composite | Represents a collection (`Folder`)        |


**1. Component Interface**

```php
interface FileSystemItem {
    public function show(int $indent = 0): void;
}

```

**2. Leaf (File)**

```php
class File implements FileSystemItem {
    private string $name;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function show(int $indent = 0): void {
        echo str_repeat("  ", $indent) . "File: {$this->name}\n";
    }
}

```

**3. Composite (Folder)**
```php
class Folder implements FileSystemItem {
    private string $name;
    private array $children = [];

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function add(FileSystemItem $item): void {
        $this->children[] = $item;
    }

    public function show(int $indent = 0): void {
        echo str_repeat("  ", $indent) . "Folder: {$this->name}\n";
        foreach ($this->children as $child) {
            $child->show($indent + 1);
        }
    }
}

```

**4. Usage Example**

```php
$root = new Folder("root");

$folderA = new Folder("Documents");
$folderA->add(new File("resume.docx"));
$folderA->add(new File("cover_letter.pdf"));

$folderB = new Folder("Pictures");
$folderB->add(new File("photo1.jpg"));
$folderB->add(new File("photo2.png"));

$root->add($folderA);
$root->add($folderB);
$root->add(new File("readme.txt"));

$root->show();

```

**🖨️ Output:**

```
Folder: root
  Folder: Documents
    File: resume.docx
    File: cover_letter.pdf
  Folder: Pictures
    File: photo1.jpg
    File: photo2.png
  File: readme.txt

```

**✅ Benefits**

| Feature     | Why It Matters                                  |
| ----------- | ----------------------------------------------- |
| Uniformity  | Treat single and composite items the same       |
| Scalability | Easily build recursive structures (e.g., trees) |
| Flexibility | Add new file types or operations with ease      |


🧩 Real Use Cases in PHP

- Laravel's Collection methods operate like composites.
- Nested menu systems or category trees.
- UI component trees (buttons, panels, etc.).
- XML/HTML DOM parsing.


