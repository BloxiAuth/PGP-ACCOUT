<?php
session_start();
include 'db.php';

$db = new DB();

$name = $_POST['registerName'];
$email = $_POST['registerEmail'];
$password = $_POST['registerPassword'];

$userExists = $db->selectOne('users', "email = '$email'");
if ($userExists) {
    echo "User with this email already exists!";
} else {
    $data = array(
        'name' => $name,
        'email' => $email,
        'password' => $password // Note: You should hash the password before storing it in the database for security
    );
    $db->insert('users', $data);
    echo "Registration successful!";
}

$db->close();
?>
