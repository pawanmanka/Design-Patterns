🧠 PHP OOP Keywords + Examples

**🔹 1. Class & Object**

| Keyword       | Description              | Example                     |
| ------------- | ------------------------ | --------------------------- |
| `class`       | Define a class           | `class User {}`             |
| `new`         | Create an object         | `$user = new User();`       |
| `$this`       | Reference current object | `$this->name = "John";`     |
| `clone`       | Clone an object          | `$user2 = clone $user1;`    |
| `__construct` | Constructor              | `function __construct() {}` |
| `__destruct`  | Destructor               | `function __destruct() {}`  |

#

**🔹 2. Inheritance & Interfaces**

| Keyword      | Description         | Example                            |
| ------------ | ------------------- | ---------------------------------- |
| `extends`    | Inherit class       | `class Admin extends User {}`      |
| `implements` | Implement interface | `class Admin implements Logger {}` |
| `interface`  | Declare interface   | `interface Logger {}`              |
| `trait`      | Code reuse          | `trait Logger {}`                  |
| `use`        | Use trait           | `use Logger;`                      |
| `parent`     | Call parent method  | `parent::__construct();`           |

#

**🔹 3. Access Modifiers**

| Keyword     | Description                  | Example              |
| ----------- | ---------------------------- | -------------------- |
| `public`    | Accessible everywhere        | `public $name;`      |
| `protected` | Only in class and subclasses | `protected $email;`  |
| `private`   | Only in current class        | `private $password;` |

#

**🔹 4. Static & Final**

| Keyword  | Description                   | Example                     |
| -------- | ----------------------------- | --------------------------- |
| `static` | No object needed              | `public static $count = 0;` |
| `self`   | Access static property/method | `self::$count++;`           |
| `final`  | Prevent override              | `final class Logger {}`     |

#
**🔹 5. Abstract Classes**

| Keyword    | Description      | Example                             |
| ---------- | ---------------- | ----------------------------------- |
| `abstract` | Must be extended | `abstract class Animal {}`          |
| -          | Abstract method  | `abstract public function speak();` |

#

**🔹 6. Magic Methods**

| Method                              | Purpose                         | Example                |
| ----------------------------------- | ------------------------------- | ---------------------- |
| `__get($name)`                      | Get undefined property          | `echo $obj->prop;`     |
| `__set($name, $value)`              | Set undefined property          | `$obj->prop = 'X';`    |
| `__call($name, $args)`              | Call undefined method           | `$obj->doSomething();` |
| `__toString()`                      | When object as string           | `echo $obj;`           |
| `__invoke()`                        | Make object callable            | `$obj();`              |
| `__isset()` / `__unset()`           | Used with `isset()` / `unset()` | `isset($obj->prop);`   |
| `__debugInfo()`                     | Custom debug output             | `var_dump($obj);`      |
| `__sleep()` / `__wakeup()`          | Serialize/unserialize           | `serialize($obj);`     |
| `__serialize()` / `__unserialize()` | New serialization (PHP 7.4+)    | -                      |

#

**🔹 7. Type Declarations**

| Keyword                       | Description               | Example                          |
| ----------------------------- | ------------------------- | -------------------------------- |
| `void`                        | No return                 | `function log(): void {}`        |
| `int`, `string`, `bool`, etc. | Scalar types              | `function getId(): int {}`       |
| `array`, `object`, `iterable` | Composite types           | `function getUsers(): array {}`  |
| `mixed`                       | Accepts anything (PHP 8+) | `function anything(mixed $x) {}` |

#
**🔹 8. Readonly (PHP 8.1+)**

| Keyword    | Description        | Example                   |
| ---------- | ------------------ | ------------------------- |
| `readonly` | Immutable property | `readonly string $email;` |


#
**🔹 9. Class Constants**

| Keyword   | Description            | Example                 |
| --------- | ---------------------- | ----------------------- |
| `const`   | Declare class constant | `const ROLE = 'ADMIN';` |
| `::class` | Get FQCN               | `echo User::class;`     |

#
**🔹 10. Misc**
| Keyword                            | Description          | Example                       |
| ---------------------------------- | -------------------- | ----------------------------- |
| `instanceof`                       | Check object type    | `if ($user instanceof Admin)` |
| `namespace`                        | Group code logically | `namespace App\Models;`       |
| `use`                              | Import class         | `use App\Models\User;`        |
| `throw`, `try`, `catch`, `finally` | Exception handling   | See below                     |


