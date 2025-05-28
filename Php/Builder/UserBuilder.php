<?php 
require_once __DIR__ . '/UserBuilderInterface.php';
require_once __DIR__ . '/User.php';
class UserBuilder implements UserBuilderInterface
{
    private User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function setName(string $name): self
    {
        $this->user->name = $name;
        return $this;
    }

    public function setEmail(string $email): self
    {
        $this->user->email = $email;
        return $this;
    }

    public function setAge(int $age): self
    {
        $this->user->age = $age;
        return $this;
    }

    public function setAddress(string $address): self
    {
        $this->user->address = $address;
        return $this;
    }

    public function build(): User
    {
        return $this->user;
    }
}
?>