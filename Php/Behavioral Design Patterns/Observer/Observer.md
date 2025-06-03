The Observer Design Pattern is a behavioral pattern where an object (called the subject) maintains a list of its dependents (called observers) and notifies them automatically of any state changes.

**✅ Use Case**

Think of a notification system: when a user publishes a blog post, you might want to:
- Send an email.
- Push a notification.
- Log the activity.
Instead of hardcoding all these actions, use observers.

#

**🧱 Components**
- Subject (Observable): The object being observed.
- Observer: Objects that want to be notified of changes.
- ConcreteSubject & ConcreteObserver: Actual implementations.

#

**🔧 PHP Example: Blog Post Notification System**

**1. Create the Observer Interface**

```php
// app/Contracts/ObserverInterface.php
namespace App\Contracts;

interface ObserverInterface
{
    public function update(string $message): void;
}


```

#

**2. Create Concrete Observers**

```php
// app/Observers/EmailNotifier.php
namespace App\Observers;

use App\Contracts\ObserverInterface;

class EmailNotifier implements ObserverInterface
{
    public function update(string $message): void
    {
        echo "Email sent: $message\n";
    }
}
```

```php
// app/Observers/Logger.php
namespace App\Observers;

use App\Contracts\ObserverInterface;

class Logger implements ObserverInterface
{
    public function update(string $message): void
    {
        echo "Log entry: $message\n";
    }
}

```

#

**3. Create the Subject Interface**

```php
// app/Contracts/SubjectInterface.php
namespace App\Contracts;

use App\Contracts\ObserverInterface;

interface SubjectInterface
{
    public function attach(ObserverInterface $observer): void;
    public function detach(ObserverInterface $observer): void;
    public function notify(string $message): void;
}

```
#

**4. Create Concrete Subject**

```php
// app/Services/PostPublisher.php
namespace App\Services;

use App\Contracts\SubjectInterface;
use App\Contracts\ObserverInterface;

class PostPublisher implements SubjectInterface
{
    private array $observers = [];

    public function attach(ObserverInterface $observer): void
    {
        $this->observers[] = $observer;
    }

    public function detach(ObserverInterface $observer): void
    {
        $this->observers = array_filter(
            $this->observers,
            fn($obs) => $obs !== $observer
        );
    }

    public function notify(string $message): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($message);
        }
    }

    public function publish(string $title): void
    {
        // Logic to save blog post (omitted)
        $this->notify("New post published: $title");
    }
}

```

#

**5. Usage Example**

```php
use App\Services\PostPublisher;
use App\Observers\EmailNotifier;
use App\Observers\Logger;

$publisher = new PostPublisher();

$publisher->attach(new EmailNotifier());
$publisher->attach(new Logger());

$publisher->publish("Observer Design Pattern in PHP");

```

#

**🧾 Output**

```
Email sent: New post published: Observer Design Pattern in PHP
Log entry: New post published: Observer Design Pattern in PHP

```