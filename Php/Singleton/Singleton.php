<?php 
class Singleton {
    private static ?Singleton $instance = null;

    // Make constructor private to prevent external instantiation
    private function __construct()
    {
        // Initialization code
    }

       // Prevent cloning
    private function __clone() {}

    // Prevent unserialization
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize singleton");
    }
    public static function getInstance() : Singleton{
        if (self::$instance === null) {
            echo "Singleton ".time()."\n";
            self::$instance = new Singleton();
        }
        return self::$instance;
    }

}
echo "<pre>"."\n";
print_r(Singleton::getInstance());
print_r(Singleton::getInstance());

?>