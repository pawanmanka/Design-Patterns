<?php 
class User
{
    public string $name;
    public string $email;
    public ?int $age = null;
    public ?string $address = null;

    public function display()
    {
        echo "Name: {$this->name}\n";
        echo "Email: {$this->email}\n";
        echo "Age: " . ($this->age ?? 'N/A') . "\n";
        echo "Address: " . ($this->address ?? 'N/A') . "\n";
    }
}
?>