📁 2. File Storage Driver Factory
Use Case: Store files in S3, local, or Google Drive.

1. Interface
```php
interface FileStorageInterface {
    public function upload(string $path, string $content): bool;
}
```

2. Implementations

```php
class S3Storage implements FileStorageInterface {
    public function upload(string $path, string $content): bool {
        // Simulate upload
        echo "Uploaded to S3: $path";
        return true;
    }
}

class LocalStorage implements FileStorageInterface {
    public function upload(string $path, string $content): bool {
        echo "Uploaded locally: $path";
        return true;
    }
}

```
3. Factory
```php
class StorageFactory {
    public static function make(string $disk): FileStorageInterface {
        return match (strtolower($disk)) {
            's3' => new S3Storage(),
            'local' => new LocalStorage(),
            default => throw new \Exception("Unsupported storage"),
        };
    }
}

```

4. Usage

```php
$storage = StorageFactory::make('s3');
$storage->upload('invoice.pdf', 'PDF content');

```