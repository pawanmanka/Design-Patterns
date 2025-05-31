🧩 1. Parse Error (Syntax Error)
Occurs when PHP cannot understand the code due to incorrect syntax.

Example:

```php 
echo "Hello World" // Missing semicolon

```

Error:
```php 
Parse error: syntax error, unexpected 'echo'...
```

🚫 2. Fatal Error
Occurs when PHP encounters an error it cannot recover from, and script execution stops.

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

⚠️ 3. Warning
Indicates a non-fatal error. The script continues execution.

Example:
```php
include("non_existent_file.php");

```

Error:
```php
Warning: include(non_existent_file.php): failed to open stream...

```

⚠️ 4. Notice
Occurs when PHP encounters something that might be an error, but doesn't stop execution.
Example :
```php
echo $undefinedVariable;

```

Error:
```php
Notice: Undefined variable...

```

🛑 5. Deprecated
Indicates that a certain function or feature is outdated and may be removed in future PHP versions.

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

Example:
Occurs with type hints or __toString() method errors.

🧰 Error Levels in PHP (Using Constants)
PHP defines constants in error_reporting() for controlling error visibility:

|Constant |	Description|
|---------|------------|
|E_ERROR	| Fatal run-time errors|
|E_WARNING	| Run-time warnings|
|E_PARSE	| Compile-time parse errors|
|E_NOTICE	| Run-time notices|
|E_DEPRECATED	| Deprecated functions/features|
|E_RECOVERABLE_ERROR	| Catchable fatal error|
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