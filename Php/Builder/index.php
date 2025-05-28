<?php 
require_once __DIR__ . '/UserBuilder.php';

$builder = new UserBuilder();

$user = $builder
    ->setName("John Doe")
    ->setEmail("john@example.com")
    ->setAge(30)
    ->setAddress("123 Main St")
    ->build();

$user->display();
?>