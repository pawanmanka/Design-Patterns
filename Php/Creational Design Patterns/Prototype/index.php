<?php 
require_once __DIR__ .'/User.php';
// Create the original object
$original = new User("Alice", "alice@example.com", "Manager", "IN");

// Clone it
$copy = clone $original;

// Modify the clone
$copy->name = "Bob";
$copy->email = "bob@example.com";

// Display both
$original->display(); // Name: Alice, Email: alice@example.com
$copy->display();     // Name: Bob, Email: bob@example.com


?>