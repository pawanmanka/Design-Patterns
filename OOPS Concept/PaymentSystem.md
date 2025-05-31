Great! Let's build a real-world OOP example in the style of Laravel using several OOP principles. We’ll create a Payment system that demonstrates:

- Abstraction
- Interface
- Dependency Injection
- Polymorphism
- Encapsulation

**🧩 Use Case**
You want to process payments using different gateways (e.g., Stripe or PayPal). Your controller should not care which gateway is used — it should just call process().

**🗂️ Folder Structure (Typical Laravel Style)**

```
App/
├── Contracts/
│   └── PaymentGatewayInterface.php
├── Services/
│   ├── StripePaymentService.php
│   └── PaypalPaymentService.php
├── Http/
│   └── Controllers/
│       └── PaymentController.php
└── Providers/
    └── AppServiceProvider.php

```
#

**✅ Step 1: Create the Interface (Contract)**
```php
// App/Contracts/PaymentGatewayInterface.php

namespace App\Contracts;

interface PaymentGatewayInterface {
    public function charge(float $amount): string;
}

```
**✅ Step 2: Create Stripe Service (Implementation)**

```php
// App/Services/StripePaymentService.php

namespace App\Services;

use App\Contracts\PaymentGatewayInterface;

class StripePaymentService implements PaymentGatewayInterface {
    public function charge(float $amount): string {
        // Logic to charge via Stripe
        return "Charged $amount via Stripe";
    }
}

```
**✅ Step 3: Create PayPal Service (Alternative Implementation)**

```php
// App/Services/PaypalPaymentService.php

namespace App\Services;

use App\Contracts\PaymentGatewayInterface;

class PaypalPaymentService implements PaymentGatewayInterface {
    public function charge(float $amount): string {
        // Logic to charge via PayPal
        return "Charged $amount via PayPal";
    }
}

```

**✅ Step 4: Bind Interface to Implementation**

In Laravel’s AppServiceProvider, bind the interface to a class.

```php
// App/Providers/AppServiceProvider.php

use App\Contracts\PaymentGatewayInterface;
use App\Services\StripePaymentService; // or PaypalPaymentService

public function register()
{
    $this->app->bind(PaymentGatewayInterface::class, StripePaymentService::class);
}

```
🛠 You can switch to PayPal just by changing the binding.

**✅ Step 5: Use Dependency Injection in Controller**

```php
// App/Http/Controllers/PaymentController.php

namespace App\Http\Controllers;

use App\Contracts\PaymentGatewayInterface;

class PaymentController extends Controller
{
    protected $paymentGateway;

    public function __construct(PaymentGatewayInterface $paymentGateway) {
        $this->paymentGateway = $paymentGateway;
    }

    public function charge() {
        $result = $this->paymentGateway->charge(100.00);
        return response()->json(['message' => $result]);
    }
}

```

**✅ Summary of OOP Concepts Used**

| Concept                  | How It’s Used                                    |
| ------------------------ | ------------------------------------------------ |
| **Interface**            | `PaymentGatewayInterface` as a contract          |
| **Abstraction**          | Interface hides how payment is processed         |
| **Polymorphism**         | Stripe and PayPal services implement differently |
| **Encapsulation**        | Each service encapsulates its own logic          |
| **Dependency Injection** | Laravel injects the chosen payment service       |




