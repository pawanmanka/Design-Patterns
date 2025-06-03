The Iterator Design Pattern in PHP provides a way to access elements of a collection sequentially without exposing its internal structure.

This is useful when you want to loop over a custom collection (like a playlist, a product catalog, etc.) in a clean, standardized way (using foreach), just like arrays.

**✅ Real-Life Example: Product Collection**

Let’s build a ProductCollection that stores products and allows iteration with foreach.

**🧱 Components of the Iterator Pattern**

| Component               | Purpose                              |
| ----------------------- | ------------------------------------ |
| **Iterator Interface**  | Defines `current()`, `next()`, etc.  |
| **Concrete Iterator**   | Implements the interface             |
| **Aggregate Interface** | Defines method to get the iterator   |
| **Concrete Aggregate**  | Collection class (e.g., ProductList) |


**🔧 Step-by-Step Implementation**

**1. Define a Product class**

```php
class Product {
    public function __construct(
        public string $name,
        public float $price
    ) {}
}

```
**2. Create ProductCollection that implements IteratorAggregate**

```php
class ProductCollection implements IteratorAggregate {
    private array $products = [];

    public function addProduct(Product $product): void {
        $this->products[] = $product;
    }

    public function getIterator(): Traversable {
        return new ArrayIterator($this->products);
    }
}

```
**IteratorAggregate is a built-in interface in PHP. It requires a getIterator() method that returns a class implementing Traversable (like ArrayIterator).**


**3. Use It with foreach**

```php
$collection = new ProductCollection();

$collection->addProduct(new Product("Laptop", 1200.00));
$collection->addProduct(new Product("Mouse", 25.50));
$collection->addProduct(new Product("Keyboard", 55.00));

foreach ($collection as $product) {
    echo "🛒 {$product->name} — \${$product->price}\n";
}

```

**✅ Benefits**

| Feature         | Benefit                                   |
| --------------- | ----------------------------------------- |
| Clean Iteration | Works with `foreach` naturally            |
| Encapsulation   | Hides internal array from external access |
| Extendable      | Can define custom iterator logic          |


**🧠 Optional: Custom Iterator (Advanced)**

If you want full control (e.g., reverse iteration), you can implement Iterator manually:

```php
class ReverseProductIterator implements Iterator {
    private int $position;
    private array $items;

    public function __construct(array $items) {
        $this->items = array_reverse($items);
        $this->position = 0;
    }

    public function current(): mixed {
        return $this->items[$this->position];
    }

    public function key(): int {
        return $this->position;
    }

    public function next(): void {
        $this->position++;
    }

    public function rewind(): void {
        $this->position = 0;
    }

    public function valid(): bool {
        return isset($this->items[$this->position]);
    }
}

```

Awesome! Let’s build a Laravel-style Collection class from scratch in PHP — one that supports chainable methods like map(), filter(), reduce(), etc., and works with foreach.

This is essentially how Illuminate\Support\Collection in Laravel works under the hood.

**✅ Features We'll Build**
- Chainable methods (map, filter, reduce, each)
- Iteration using foreach (via IteratorAggregate)
- Fluent interface like Laravel

**🧱 Step-by-Step Implementation**

1. Define the Collection Class
```php
class Collection implements IteratorAggregate {
    protected array $items;

    public function __construct(array $items = []) {
        $this->items = $items;
    }

    public function all(): array {
        return $this->items;
    }

    public function getIterator(): Traversable {
        return new ArrayIterator($this->items);
    }

    public function map(callable $callback): static {
        return new static(array_map($callback, $this->items));
    }

    public function filter(callable $callback): static {
        return new static(array_filter($this->items, $callback));
    }

    public function reduce(callable $callback, $initial = null): mixed {
        return array_reduce($this->items, $callback, $initial);
    }

    public function each(callable $callback): static {
        foreach ($this->items as $key => $value) {
            $callback($value, $key);
        }
        return $this;
    }

    public function add(mixed $item): static {
        $this->items[] = $item;
        return $this;
    }
}

```
**🔧 Example Usage**
```php
$collection = new Collection([1, 2, 3, 4, 5]);

$result = $collection
    ->map(fn($x) => $x * 2)
    ->filter(fn($x) => $x > 5)
    ->each(fn($x) => print("🔢 $x\n"));

$total = $collection->reduce(fn($carry, $x) => $carry + $x, 0);
echo "🧮 Sum: $total\n";

```
**✅ Why This Is Useful**

| Feature    | Benefit                                    |
| ---------- | ------------------------------------------ |
| Chainable  | Clean, expressive syntax                   |
| Iterable   | Use in `foreach` like native arrays        |
| Extendable | Add methods like `sort()`, `pluck()`, etc. |
