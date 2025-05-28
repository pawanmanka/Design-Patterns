The Prototype Design Pattern in PHP is a creational pattern used when you want to clone objects instead of creating new instances from scratch — especially when object creation is expensive or complex.

🧠 Why Use Prototype Pattern?
To avoid costly creation of new objects (e.g. database calls, heavy setup)

To create copies of existing objects with slight modifications

To use a shared "template" object that can be cloned

✅ Key Concept
In PHP, this is achieved using the clone keyword.