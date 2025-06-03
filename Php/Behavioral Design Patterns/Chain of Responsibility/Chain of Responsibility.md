The Chain of Responsibility design pattern is a behavioral pattern used to pass a request along a chain of handlers. Each handler decides either to process the request or to pass it to the next handler in the chain.

**✅ When to Use**

- When you want to decouple senders and receivers of a request.
- When you have multiple handlers for a request, but only one (or none) should act on it.
- Common in request pipelines like middleware, validation, or authorization.


**🧱 Real-World Analogy**

Imagine a customer support system where a request moves from:

- Tier 1 Support → Tier 2 Support → Manager
  Each level decides whether to handle the issue or pass it along.

#

**🛠️ PHP Example: Simple Support Ticket System**

**1. Create the Handler Interface**

```php
// app/Contracts/HandlerInterface.php
namespace App\Contracts;

interface HandlerInterface
{
    public function setNext(HandlerInterface $handler): HandlerInterface;
    public function handle(string $request): ?string;
}
```

**2. Abstract Base Handler**

```php
// app/Handlers/AbstractHandler.php
namespace App\Handlers;

use App\Contracts\HandlerInterface;

abstract class AbstractHandler implements HandlerInterface
{
    private ?HandlerInterface $nextHandler = null;

    public function setNext(HandlerInterface $handler): HandlerInterface
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    public function handle(string $request): ?string
    {
        if ($this->nextHandler) {
            return $this->nextHandler->handle($request);
        }

        return null;
    }
}

```

#

**3. Concrete Handlers**

```php
// app/Handlers/Tier1Support.php
namespace App\Handlers;

class Tier1Support extends AbstractHandler
{
    public function handle(string $request): ?string
    {
        if ($request === 'basic') {
            return "Tier 1 handled the request.";
        }

        return parent::handle($request);
    }
}

```
```php
// app/Handlers/Tier2Support.php
namespace App\Handlers;

class Tier2Support extends AbstractHandler
{
    public function handle(string $request): ?string
    {
        if ($request === 'intermediate') {
            return "Tier 2 handled the request.";
        }

        return parent::handle($request);
    }
}

```
```php
// app/Handlers/Manager.php
namespace App\Handlers;

class Manager extends AbstractHandler
{
    public function handle(string $request): ?string
    {
        if ($request === 'critical') {
            return "Manager handled the request.";
        }

        return parent::handle($request);
    }
}

```

#

**4. Usage**

```php
use App\Handlers\Tier1Support;
use App\Handlers\Tier2Support;
use App\Handlers\Manager;

$tier1 = new Tier1Support();
$tier2 = new Tier2Support();
$manager = new Manager();

$tier1->setNext($tier2)->setNext($manager);

echo $tier1->handle('basic');        // Tier 1 handled the request.
echo $tier1->handle('intermediate'); // Tier 2 handled the request.
echo $tier1->handle('critical');     // Manager handled the request.
echo $tier1->handle('unknown');      // null

```

#

**🧾 Output**
```php
Tier 1 handled the request.
Tier 2 handled the request.
Manager handled the request.

```





