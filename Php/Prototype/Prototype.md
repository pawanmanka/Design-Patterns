The Prototype Design Pattern in PHP is a creational pattern used when you want to clone objects instead of creating new instances from scratch — especially when object creation is expensive or complex.

🧠 Why Use Prototype Pattern?
To avoid costly creation of new objects (e.g. database calls, heavy setup)

To create copies of existing objects with slight modifications

To use a shared "template" object that can be cloned

✅ Key Concept
In PHP, this is achieved using the clone keyword.



🧩 Advanced Use: Deep Copying
If your object has nested objects or arrays, you may need to implement __clone() to handle deep copying.


class Profile {
    public $bio;
}

class User {
    public $name;
    public $profile;

    public function __construct($name, $bio) {
        $this->name = $name;
        $this->profile = new Profile();
        $this->profile->bio = $bio;
    }

    public function __clone() {
        $this->profile = clone $this->profile;
    }
}


✅ Summary
Feature	Description
clone keyword	Creates a shallow copy of the object
__clone()	Customize deep copy behavior
Use case	Duplicate objects without reinitializing