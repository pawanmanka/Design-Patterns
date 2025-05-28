<?php 
class User
{
    public $name;
    public $email;
    public $role;
    public $country;

    public function __construct($name = '', $email = '', $role = '', $country = '' )
    {
        $this->name = $name;
        $this->email = $email;
        $this->role = $role;
        $this->country = $country;
    }

    public function display()
    {
        echo "Name: {$this->name}, Email: {$this->email}, Role: {$this->role}, Country: {$this->country} \n";
    }
}

?>