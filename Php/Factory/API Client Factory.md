🌐 3. API Client Factory
Use Case: Connect to different APIs (GitHub, Twitter, etc.)

1. Interface
```php
interface ApiClientInterface {
    public function fetchData(): array;
}

```
2. Implementations
 
```php
class GitHubClient implements ApiClientInterface {
    public function fetchData(): array {
        return ['source' => 'GitHub', 'data' => ['repo1', 'repo2']];
    }
}

class TwitterClient implements ApiClientInterface {
    public function fetchData(): array {
        return ['source' => 'Twitter', 'data' => ['tweet1', 'tweet2']];
    }
}

```

3. Factory

```php
class ApiClientFactory {
    public static function make(string $api): ApiClientInterface {
        return match (strtolower($api)) {
            'github' => new GitHubClient(),
            'twitter' => new TwitterClient(),
            default => throw new \Exception("Unsupported API"),
        };
    }
}

```
4. Usage

```php
$client = ApiClientFactory::make('github');
print_r($client->fetchData());

```