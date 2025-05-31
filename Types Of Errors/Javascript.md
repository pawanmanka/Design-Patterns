**🧠 JavaScript Error Object Structure**

Every error is an instance of the built-in Error object or its subclasses. Key properties:
name: The type of error (e.g., TypeError, SyntaxError)
message: A description of what went wrong
stack: A stack trace (in most environments)

```js
try {
  throw new TypeError("This is a type issue");
} catch (e) {
  console.log(e.name);    // TypeError
  console.log(e.message); // This is a type issue
  console.log(e.stack);   // Stack trace
}

```

**🧩 JavaScript Error Categories (in depth)**

JavaScript errors can be grouped into:

1. Synchronous (runtime) errors – can stop execution if unhandled.
2. Asynchronous errors – may fail silently unless explicitly handled.
3. Logical errors – do not throw exceptions but cause incorrect behavior.

**💥 Built-in JavaScript Error Types (With Execution Behavior)**

| Error Type         | Stops Execution?     | When It Happens            | Description                             |
| ------------------ | -------------------- | -------------------------- | --------------------------------------- |
| **SyntaxError**    | ✅ Yes                | Parsing (before execution) | Invalid syntax                          |
| **ReferenceError** | ✅ Yes                | Runtime                    | Undeclared variable                     |
| **TypeError**      | ✅ Yes                | Runtime                    | Invalid type or method use              |
| **RangeError**     | ✅ Yes                | Runtime                    | Value out of bounds                     |
| **URIError**       | ✅ Yes                | Runtime                    | Malformed URI                           |
| **EvalError**      | ✅ Yes (rare)         | Runtime                    | Problem with `eval()`                   |
| **InternalError**  | ✅ Yes (non-standard) | Runtime                    | Engine-specific issues (e.g. recursion) |


**1. SyntaxError**

🔹 When?
During parsing. JavaScript will refuse to run at all if this occurs.

🔹 Example:
```js
let x = ; // SyntaxError: Unexpected token ;

```
🔹 Stops Execution?
✅ Yes — entire script fails to load.

**2. ReferenceError**

🔹 When?
Accessing a variable that doesn’t exist in scope.

🔹 Example:
```js
console.log(user); // ReferenceError: user is not defined

```

🔹 Stops Execution?
✅ Yes — unless caught with try...catch.

**3. TypeError**

🔹 When?
- Using methods on undefined or null.
- Calling non-functions

🔹 Example:
```js
let num = 5;
num(); // TypeError: num is not a function

```
🔹 Stops Execution?
✅ Yes — unless handled.

**4. RangeError**

🔹 When?
- Creating an array with invalid length.
- Recursion depth exceeded.

🔹 Example:
```js
let arr = new Array(-1); // RangeError: Invalid array length

```
🔹 Stops Execution?  ✅ Yes

**5. URIError**

🔹 When?
- Using malformed URI sequences with decodeURI, encodeURI.

🔹 Example:

```js
decodeURI('%'); // URIError: URI malformed

```

🔹 Stops Execution?
✅ Yes

**6. EvalError (Rare)**

🔹 When?
Mostly historical, related to misuse of eval().

🔹 Example:
```js
throw new EvalError("Custom eval error");

```

🔹 Stops Execution?
✅ Yes — if thrown or not handled.

**7. InternalError (Non-standard)**

🔹 When?
Typically in deep recursion or engine-specific limits.

🔹 Example:
```js
function recurse() {
  recurse();
}
recurse(); // InternalError: too much recursion

```

🔹 Stops Execution?
✅ Yes


**🔄 Asynchronous Errors (Won’t Stop Execution Directly)**

**Example 1: setTimeout with error**

```js
setTimeout(() => {
  throw new Error("Async error");
}, 1000);

console.log("I will still run");
```

✅ Main script continues — async error must be handled with callbacks or try-catch inside the async block.

🛡️ Handling Errors to Prevent Execution Stops

✅ Using try...catch

```js
try {
  riskyCode();
} catch (err) {
  console.error("Caught:", err.message);
}

```

✅ Handling async/await errors

```js
async function getData() {
  try {
    const res = await fetch("bad-url");
    const data = await res.json();
  } catch (e) {
    console.error("Async error caught:", e.message);
  }
}

```

**🧠 Logical Errors (Don't Stop Execution)**

Logical errors do not throw exceptions but cause incorrect behavior.
Example:

```js
let items = [1, 2, 3];
if (items.length = 0) { // Should be '==='
  console.log("Empty");
}

```
➡️ This doesn’t stop the script but behaves incorrectly.


**✅ Summary Table: Can the Error Stop Execution?**

| Error Type     | Can Stop Execution               | Notes                      |
| -------------- | -------------------------------- | -------------------------- |
| SyntaxError    | ✅ Yes                            | Script won't load          |
| ReferenceError | ✅ Yes                            | At runtime                 |
| TypeError      | ✅ Yes                            | At runtime                 |
| RangeError     | ✅ Yes                            | At runtime                 |
| URIError       | ✅ Yes                            | At runtime                 |
| EvalError      | ✅ Yes                            | Rarely used                |
| InternalError  | ✅ Yes                            | Non-standard               |
| Async Error    | ❌ No (unless unhandled globally) | Needs promise or try/catch |
| Logic Error    | ❌ No                             | Bad logic, no crash        |


**🧰 Bonus: Global Error Handling**

- Window (Browser):

```js
window.onerror = function(message, source, lineno, colno, error) {
  console.error("Global error:", message);
};

```
- Node.js:

```js
process.on('uncaughtException', (err) => {
  console.error("Uncaught Exception:", err);
});

```


