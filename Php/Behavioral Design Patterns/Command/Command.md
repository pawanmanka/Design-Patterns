✅ Real-Life Example of the Command Design Pattern in PHP: Task Scheduling System
Let’s build a task scheduler like Laravel’s command scheduler or CRON. It will:

- Let you schedule commands (like "Backup DB", "Send Email")

- Decouple task creation from execution

- Optionally queue, delay, or log them

#

**🧱 Structure**

| Role     | Real-life analogy            | Example            |
| -------- | ---------------------------- | ------------------ |
| Command  | Scheduled Job                | `SendEmailCommand` |
| Receiver | Worker doing actual work     | `EmailService`     |
| Invoker  | Scheduler or Job Dispatcher  | `TaskScheduler`    |
| Client   | Developer scheduling the job | `index.php`        |

#

**✅ Step-by-Step Example**

#

**1. Command Interface**

```php
interface Command {
    public function execute(): void;
}

```

**2. Receiver (Services that do the work)**
```php
class EmailService {
    public function send($to, $subject, $body) {
        echo "📧 Sending email to $to: $subject - $body\n";
    }
}

class BackupService {
    public function backup() {
        echo "💾 Database backup completed\n";
    }
}

```

#

**3. ConcreteCommand Classes**

```php
class SendEmailCommand implements Command {
    private EmailService $service;
    private string $to;
    private string $subject;
    private string $body;

    public function __construct(EmailService $service, $to, $subject, $body) {
        $this->service = $service;
        $this->to = $to;
        $this->subject = $subject;
        $this->body = $body;
    }

    public function execute(): void {
        $this->service->send($this->to, $this->subject, $this->body);
    }
}

class BackupDatabaseCommand implements Command {
    private BackupService $service;

    public function __construct(BackupService $service) {
        $this->service = $service;
    }

    public function execute(): void {
        $this->service->backup();
    }
}

```

**4. Invoker – The Scheduler**

```php

class TaskScheduler {
    private array $queue = [];

    public function addCommand(Command $command): void {
        $this->queue[] = $command;
    }

    public function run(): void {
        foreach ($this->queue as $command) {
            $command->execute();
        }
    }
}

```

**5. Client – Setting It All Up**
```php
$emailService = new EmailService();
$backupService = new BackupService();

$emailCmd = new SendEmailCommand($emailService, "user@example.com", "Welcome!", "Thanks for signing up.");
$backupCmd = new BackupDatabaseCommand($backupService);

$scheduler = new TaskScheduler();
$scheduler->addCommand($emailCmd);
$scheduler->addCommand($backupCmd);

$scheduler->run();

```

**🧾 Output**

```php
📧 Sending email to user@example.com: Welcome! - Thanks for signing up.
💾 Database backup completed

```
**✅ Benefits in Real Life**

| Scenario                      | How Command Pattern Helps                    |
| ----------------------------- | -------------------------------------------- |
| Task scheduling / queueing    | Store and delay execution of jobs            |
| Logging & audit trails        | Save commands to be logged or replayed       |
| Decouple task creation & exec | Developers schedule; system decides when/how |
| Undoable actions              | You can extend it with `undo()` methods      |


