<?php
session_start();
include 'db.php';

$db = new DB();

$name = $_POST['registerName'];
$email = $_POST['registerEmail'];
$password = $_POST['registerPassword'];

// Encrypt the password with the server's public key
$encryptedPassword = shell_exec("echo '$password' | gpg --encrypt --armor --recipient 'server@example.com'");

$userExists = $db->selectOne('users', "email = '$email'");
if ($userExists) {
    echo "User with this email already exists!";
} else {
    $data = array(
        'name' => $name,
        'email' => $email,
        'password' => $encryptedPassword
    );
    $db->insert('users', $data);
    echo "Registration successful!";
}

$db->close();
?>
