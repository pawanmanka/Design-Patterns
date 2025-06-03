The Mediator Design Pattern helps reduce coupling between components by centralizing communication through a mediator object. It’s especially useful in UI frameworks, messaging systems, or components that interact in complex ways.

🧠 Real-World Analogy

Imagine a control tower at an airport. Planes (components) don’t talk to each other directly—they communicate via the control tower (mediator), which coordinates actions.


✅ Goal

Create a central object (Mediator) that handles interactions between components (colleagues) to avoid tight coupling.


🧪 Example: Chatroom (Mediator) with Users (Colleagues)

1. Mediator Interface

```php
interface ChatMediator {
    public function sendMessage(string $message, User $sender): void;
}
```

2. Concrete Mediator

```php

class ChatRoom implements ChatMediator {
    private array $users = [];

    public function addUser(User $user): void {
        $this->users[] = $user;
    }

    public function sendMessage(string $message, User $sender): void {
        foreach ($this->users as $user) {
            if ($user !== $sender) {
                $user->receive($message, $sender->getName());
            }
        }
    }
}
```

3. Colleague (User)

```php
class User {
    private string $name;
    private ChatMediator $chatMediator;

    public function __construct(string $name, ChatMediator $chatMediator) {
        $this->name = $name;
        $this->chatMediator = $chatMediator;
    }

    public function getName(): string {
        return $this->name;
    }

    public function send(string $message): void {
        echo "🗣️ {$this->name} sends: $message\n";
        $this->chatMediator->sendMessage($message, $this);
    }

    public function receive(string $message, string $sender): void {
        echo "📩 {$this->name} received from $sender: $message\n";
    }
}


```

4. Client Code

```php
$chatRoom = new ChatRoom();

$alice = new User('Alice', $chatRoom);
$bob = new User('Bob', $chatRoom);
$carol = new User('Carol', $chatRoom);

$chatRoom->addUser($alice);
$chatRoom->addUser($bob);
$chatRoom->addUser($carol);

$alice->send('Hi everyone!');
$bob->send('Hey Alice!');

```

🧾 Output

```php
🗣️ Alice sends: Hi everyone!
📩 Bob received from Alice: Hi everyone!
📩 Carol received from Alice: Hi everyone!

🗣️ Bob sends: Hey Alice!
📩 Alice received from Bob: Hey Alice!
📩 Carol received from Bob: Hey Alice!

```

✅ Benefits

| Feature         | Advantage                                     |
| --------------- | --------------------------------------------- |
| Loosely Coupled | Objects don’t talk directly to each other     |
| Central Control | Easy to manage communication logic            |
| Scalable        | Add/modify components without breaking others |
