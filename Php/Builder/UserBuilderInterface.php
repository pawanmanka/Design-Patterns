<?php 
interface UserBuilderInterface
{
    public function setName(string $name): self;
    public function setEmail(string $email): self;
    public function setAge(int $age): self;
    public function setAddress(string $address): self;
    public function build(): User;
}

?>