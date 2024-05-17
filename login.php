<?php
session_start();
include 'db.php';

$db = new DB();

$email = $_POST['loginEmail'];
$password = $_POST['loginPassword'];

$user = $db->selectOne('users', "email = '$email'");
if ($user) {
    // Decrypt the stored password with the server's private key
    $decryptedPassword = shell_exec("echo '{$user['password']}' | gpg --decrypt --armor --passphrase 'your_private_key_passphrase'");
    if ($password == $decryptedPassword) {
        echo "Login successful!";
    } else {
        echo "Invalid password!";
    }
} else {
    echo "User not found!";
}

$db->close();
?>
