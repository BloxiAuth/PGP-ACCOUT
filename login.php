<?php
session_start();
include 'db.php';

$db = new DB();

$email = $_POST['loginEmail'];
$password = $_POST['loginPassword'];

$user = $db->selectOne('users', "email = '$email'");
if ($user) {
    if ($password == $user['password']) {
        echo "Login successful!";
    } else {
        echo "Invalid password!";
    }
} else {
    echo "User not found!";
}

$db->close();
?>
