Facade is a structural design pattern that provides a simplified interface to a library, a framework, or any other complex set of classes.

🧠 What is a Facade?
A Facade is a structural design pattern that provides a simplified, unified interface to a more complex subsystem.

In plain PHP, it's a wrapper class that:
- Hides complex internals
- Exposes an easy-to-use API
- Acts like a "front door" to multiple operations

✅ Real-World Analogy
Think of a universal remote control (Facade) that hides the complexity of individual remote protocols for your TV, AC, Sound System, etc.

🧩 Real-World Example in PHP: Video Converter

Imagine a video converter system that involves:
- Loading a video
- Decoding format
- Applying filters
- Exporting to a new format

The facade will offer a simple interface like:
```
$converter->convert('movie.avi', 'mp4');
```

#

**👨‍🔧 Step-by-Step Code**

**1. Complex Subsystems**

```php
class VideoFile {
    public function __construct(public string $filename) {}
}

class VideoCodec {
    public function decode(VideoFile $file): string {
        return "Decoded {$file->filename}";
    }
}

class AudioCodec {
    public function decode(VideoFile $file): string {
        return "Audio extracted from {$file->filename}";
    }
}

class FormatConverter {
    public function convert(string $video, string $audio, string $format): string {
        return "Final {$format} video with {$video} and {$audio}";
    }
}

```

#

**2. Facade Class**

```php
class VideoConversionFacade {
    public function convert(string $filename, string $targetFormat): string {
        $file = new VideoFile($filename);
        $videoCodec = new VideoCodec();
        $audioCodec = new AudioCodec();
        $converter = new FormatConverter();

        $video = $videoCodec->decode($file);
        $audio = $audioCodec->decode($file);

        return $converter->convert($video, $audio, $targetFormat);
    }
}

```

#

**3. Client Code**

```php
$converter = new VideoConversionFacade();
echo $converter->convert("movie.avi", "mp4");

```

#

**🖨️ Output**

```php
Final mp4 video with Decoded movie.avi and Audio extracted from movie.avi

```
#

**✅ Benefits of Using a Facade**

| Feature         | Benefit                                       |
| --------------- | --------------------------------------------- |
| Simplified API  | One method replaces 3-5 internal operations   |
| Decoupling      | Client doesn't need to know internal classes  |
| Maintainability | Changes behind the scenes don’t break clients |

#

**🧩 Where You See Facades in Laravel**

| Facade         | Behind the Scenes Class         |
| -------------- | ------------------------------- |
| `Cache::get()` | `Illuminate\Cache\CacheManager` |
| `Route::get()` | `Illuminate\Routing\Router`     |
| `Log::info()`  | `Illuminate\Log\Logger`         |

#

**✅ Example 1: Email Sending Facade**

**🛠️ Subsystem: Mailer**
```php
class SMTPMailer {
    public function connect() {
        echo "Connected to SMTP server\n";
    }

    public function authenticate() {
        echo "Authenticated\n";
    }

    public function sendMail($to, $subject, $body) {
        echo "Email sent to $to with subject '$subject'\n";
    }
}

```
#

**🧱 Facade**

```php
class MailFacade {
    protected $mailer;

    public function __construct() {
        $this->mailer = new SMTPMailer();
    }

    public function send($to, $subject, $body) {
        $this->mailer->connect();
        $this->mailer->authenticate();
        $this->mailer->sendMail($to, $subject, $body);
    }
}

```
#

**✅ Usage**

```php
$mail = new MailFacade();
$mail->send("user@example.com", "Welcome", "Thank you for signing up!");

```

#

**✅ Example 2: File Upload Facade**
🛠️ Subsystem

```php
class Validator {
    public function isValid($file) {
        return isset($file['tmp_name']) && $file['size'] < 2000000;
    }
}

class Storage {
    public function store($file, $path) {
        move_uploaded_file($file['tmp_name'], $path . $file['name']);
        echo "Stored file: " . $path . $file['name'] . "\n";
    }
}

```

#

**🧱 Facade**
```php
class FileUploadFacade {
    protected $validator;
    protected $storage;

    public function __construct() {
        $this->validator = new Validator();
        $this->storage = new Storage();
    }

    public function upload($file, $path) {
        if ($this->validator->isValid($file)) {
            $this->storage->store($file, $path);
        } else {
            echo "Invalid file.\n";
        }
    }
}
```
#

**✅ Usage**
```php
$fileUpload = new FileUploadFacade();
$fileUpload->upload($_FILES['avatar'], 'uploads/');

```
#

**✅ Example 3: Payment Gateway Facade**

**🛠️ Subsystem**

```php
class PaymentGateway {
    public function connect() {
        echo "Connected to gateway\n";
    }

    public function charge($amount) {
        echo "Charged $$amount\n";
    }
}

```

**🧱 Facade**
```php
class PaymentFacade {
    protected $gateway;

    public function __construct() {
        $this->gateway = new PaymentGateway();
    }

    public function pay($amount) {
        $this->gateway->connect();
        $this->gateway->charge($amount);
    }
}

```

**✅ Usage**
```php
$pay = new PaymentFacade();
$pay->pay(99.99);

```

**✅ When to Use Facade Pattern in Core PHP**
| Use Case                     | Benefit                                    |
| ---------------------------- | ------------------------------------------ |
| Wrapping multiple subsystems | Hides complexity                           |
| Providing simplified APIs    | Cleaner interface for external code        |
| Plugin systems / toolkits    | Provide consistent, clean access           |
| Replacing procedural code    | Encourages OOP without revealing internals |


**✅ Summary**

- The Facade pattern in core PHP helps simplify complex class interactions.
- You wrap subsystems into one unified class/interface.
- Use it when you want to clean up your code, hide complexity, or provide better API usability.










