🔍 PHP Error Categories (High-Level)
PHP errors fall under two main categories:
1. Compile-time errors — Detected before the script runs.
2. Run-time errors — Occur while the script is executing.

🧩 1. Parse Error (Syntax Error) E_PARSE
Occurs when PHP cannot understand the code due to incorrect syntax.

❓ What:
Syntax errors, such as missing semicolons, unmatched brackets, or invalid structure.

💥 Fatal?
✅ Yes — script cannot be executed.

Example:

```php 
echo "Hello World" // Missing semicolon

```

Error:
```php 
Parse error: syntax error, unexpected 'echo'...
```
🧠 Notes:
- Detected before execution starts.
- Cannot be caught with try-catch.



🚫 2. Fatal Error (E_ERROR, E_CORE_ERROR, E_COMPILE_ERROR)
Occurs when PHP encounters an error it cannot recover from, and script execution stops.

❓ What:
Unrecoverable errors that stop execution immediately.

🔥 Examples:
- Calling a function that doesn't exist.
- Instantiating a non-existent class.
- Failing type hint enforcement in PHP 8+.

💥 Fatal?
✅ Yes — script stops immediately.

🧠 Notes:
- Cannot be caught with try-catch unless it's a Throwable in PHP 7+.

Common causes:
- Calling a non-existent function.
- Creating an object of a non-existent class.

Example:
```php
nonExistentFunction();

```

Error:
```php
Fatal error: Uncaught Error: Call to undefined function...

```

⚠️ 3. Warning ( E_WARNING, E_CORE_WARNING, E_COMPILE_WARNING )
Indicates a non-fatal error. The script continues execution.

❓ What:
Serious issues, but script execution continues.

💥 Fatal?
❌ No — script continues.

🧠 Notes:
- Useful for catching runtime issues like file access problems.



Example:
```php
include("non_existent_file.php");

```

Error:
```php
Warning: include(non_existent_file.php): failed to open stream...

```

⚠️ 4. Notice ( E_NOTICE)
Occurs when PHP encounters something that might be an error, but doesn't stop execution.

❓ What:
Minor issues like using uninitialized variables.

💥 Fatal?
❌ No — script continues.

🧠 Notes:
- Often harmless, but may indicate bugs or typos.
- Can be suppressed with @ (not recommended).

Example :
```php
echo $undefinedVariable;

```

Error:
```php
Notice: Undefined variable...

```

🛑 5. Deprecated (E_DEPRECATED, E_USER_DEPRECATED)
Indicates that a certain function or feature is outdated and may be removed in future PHP versions.

❓ What:
Usage of outdated or soon-to-be-removed features.

💥 Fatal?
❌ No — but should be fixed for future compatibility.

🧠 Notes:
- Often shown when upgrading PHP versions.
- Use error_reporting(E_ALL | E_DEPRECATED) to reveal them.

Example:
```php 
split(",", "one,two,three"); // Deprecated since PHP 5.3.0

```

Error:
```php
Deprecated: Function split() is deprecated...

```

🧠 6. Recoverable Error
A fatal error that can be caught using a custom error handler (rarely used).

❓ What:
Errors that would normally be fatal but can be caught by a custom handler.

💥 Fatal?
✅ Normally — but can be handled via set_error_handler().

Example:
Occurs with type hints or __toString() method errors.

👩‍🔧 7. User-Generated Errors (E_USER_ERROR, E_USER_WARNING, E_USER_NOTICE)

❓ What:
Custom errors triggered using trigger_error().

```php 
trigger_error("This is a custom warning", E_USER_WARNING);

```
🧠 Notes:
Used for enforcing business logic or custom validations.


🧠 8. Exception-based Errors (Throwable)

Introduced in PHP 7+
All fatal errors now implement the Throwable interface, which allows you to catch most fatal errors using try-catch.

📦 Example:

```php 

try {
    $obj = new NonExistentClass(); // Fatal
} catch (Throwable $e) {
    echo "Caught: " . $e->getMessage();
}
```



🧰 Error Levels in PHP (Using Constants)
PHP defines constants in error_reporting() for controlling error visibility:

|Constant |	Description|
|---------|------------|
|E_ERROR	| Fatal runtime errors|
|E_WARNING	| Runtime warnings|
|E_PARSE	| Compile-time parse errors|
|E_NOTICE	| Minor runtime notices|
|E_CORE_ERROR| PHP startup fatal errors|
|E_CORE_WARNING| PHP startup warnings|
|E_COMPILE_ERROR| Compilation fatal errors|
|E_COMPILE_WARNING| Compilation warnings|
|E_USER_ERROR| Custom user-triggered error|
|E_USER_WARNING| Custom user-triggered warning|
|E_USER_NOTICE| Custom user-triggered notice|
|E_STRICT| Suggests best practices (removed in PHP 8)|
|E_RECOVERABLE_ERROR	| Catchable fatal error|
|E_DEPRECATED	| Deprecated functions/features|
|E_USER_DEPRECATED	| User-triggered deprecation warnings|
|E_ALL	| All errors and warnings|


🧪 Best Practices
Use error_reporting(E_ALL) and ini_set('display_errors', 1) during development.

Log errors in production instead of displaying them.

Handle exceptions with try-catch where possible.


✅ 1. Error Handling & Logging in Plain PHP
🛠 Enable Error Reporting (Development Only)

```php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

```
📋 Basic Error Logging to File

```php
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php-error.log');

// Example error to test logging
echo $undefinedVar;

```

🧱 Custom Error Handler

```php 
function customErrorHandler($errno, $errstr, $errfile, $errline) {
    $message = "Error [$errno]: $errstr in $errfile on line $errline\n";
    error_log($message, 3, __DIR__ . '/php-error.log');
}

set_error_handler("customErrorHandler");

```

✅ Summary
|Platform |	Logging Mechanism |	Recommended Method |
|---------|------------------|-------------------|
|Plain PHP	|error_log()	|Custom handler + error file|
|Laravel	|Log::error()	|Use built-in Monolog system|


🛡️ How to Handle Errors in PHP

✅ Show All Errors (Dev Only)
```php 
ini_set('display_errors', 1);
error_reporting(E_ALL);

```

✅ Log Errors (Recommended in Production)

```php 
ini_set('log_errors', 1);
ini_set('error_log', '/path/to/logs/php-error.log');

```

✅ Catching Exceptions

```php 
try {
    riskyFunction();
} catch (Throwable $e) {
    echo "Caught: " . $e->getMessage();
}

```

✅ Custom Error Handler
```php 
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    error_log("[$errno] $errstr in $errfile on line $errline");
});

```

✅ Summary Chart

| Type                  | Fatal? | Catchable?     | Description                     |
| --------------------- | ------ | -------------- | ------------------------------- |
| Parse Error           | ✅      | ❌              | Syntax error                    |
| Fatal Error           | ✅      | ✅ PHP 7+       | Missing functions/classes       |
| Warning               | ❌      | 🔄 via handler | Missing files, etc.             |
| Notice                | ❌      | 🔄 via handler | Uninitialized variable          |
| Deprecated            | ❌      | 🔄 via handler | Deprecated functions/features   |
| Recoverable Error     | ✅      | ✅ via handler  | Type mismatch (PHP strict mode) |
| Exception (Throwable) | ✅      | ✅              | All fatal exceptions in PHP 7+  |
