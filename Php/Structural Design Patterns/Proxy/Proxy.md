Proxy is a structural design pattern that lets you provide a substitute or placeholder for another object. A proxy controls access to the original object, allowing you to perform something either before or after the request gets through to the original object.


Absolutely! The Proxy design pattern is a structural pattern used to provide a surrogate or placeholder for another object to control access to it. It's useful for lazy loading, access control, logging, or caching.

**✅ Proxy Design Pattern in PHP**

**🧱 Structure:**
- Subject: Common interface for RealSubject and Proxy.
- RealSubject: The real object the proxy represents.
- Proxy: Controls access to RealSubject, adds logic (e.g., caching, logging, etc.).

#

**💡 Example 1: Virtual Proxy (Lazy Initialization for Heavy Image)**

```php
interface Image {
    public function display(): void;
}

class RealImage implements Image {
    private string $filename;

    public function __construct(string $filename) {
        $this->filename = $filename;
        $this->loadFromDisk();
    }

    private function loadFromDisk(): void {
        echo "Loading image: {$this->filename}\n";
    }

    public function display(): void {
        echo "Displaying image: {$this->filename}\n";
    }
}

class ProxyImage implements Image {
    private ?RealImage $realImage = null;
    private string $filename;

    public function __construct(string $filename) {
        $this->filename = $filename;
    }

    public function display(): void {
        if ($this->realImage === null) {
            $this->realImage = new RealImage($this->filename); // Lazy loading
        }
        $this->realImage->display();
    }
}

// Usage
$image = new ProxyImage("photo.jpg");
$image->display(); // Loads and displays
$image->display(); // Only displays

```
#

**💡 Example 2: Protection Proxy (Access Control Based on Role)**

```php
interface Document {
    public function display(): void;
}

class ConfidentialDocument implements Document {
    public function display(): void {
        echo "Showing confidential document\n";
    }
}

class SecureDocumentProxy implements Document {
    private ConfidentialDocument $realDocument;
    private string $userRole;

    public function __construct(string $userRole) {
        $this->userRole = $userRole;
        $this->realDocument = new ConfidentialDocument();
    }

    public function display(): void {
        if ($this->userRole === 'admin') {
            $this->realDocument->display();
        } else {
            echo "Access denied. Admins only.\n";
        }
    }
}

// Usage
$adminDoc = new SecureDocumentProxy('admin');
$adminDoc->display(); // Allowed

$userDoc = new SecureDocumentProxy('guest');
$userDoc->display(); // Denied

```
#
**💡 Example 3: Remote Proxy (Simulating Remote API Access)**

```php
interface WeatherService {
    public function getTemperature(): float;
}

class RealWeatherService implements WeatherService {
    public function getTemperature(): float {
        echo "Fetching data from real weather API...\n";
        return 26.5;
    }
}

class WeatherServiceProxy implements WeatherService {
    private ?float $cachedTemp = null;
    private RealWeatherService $realService;

    public function __construct() {
        $this->realService = new RealWeatherService();
    }

    public function getTemperature(): float {
        if ($this->cachedTemp === null) {
            $this->cachedTemp = $this->realService->getTemperature();
        } else {
            echo "Returning cached temperature\n";
        }
        return $this->cachedTemp;
    }
}

// Usage
$proxy = new WeatherServiceProxy();
echo $proxy->getTemperature() . "°C\n"; // API call
echo $proxy->getTemperature() . "°C\n"; // Cached

```

#
**🧠 Use Cases Recap**

| Type of Proxy        | Purpose                                   |
| -------------------- | ----------------------------------------- |
| **Virtual Proxy**    | Delay resource-intensive object creation  |
| **Protection Proxy** | Control access based on roles/permissions |
| **Remote Proxy**     | Represent remote object locally           |
| **Caching Proxy**    | Cache results of expensive operations     |
| **Smart Proxy**      | Add logging, reference counting, etc.     |

