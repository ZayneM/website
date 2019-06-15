<?php

// Include Connection to Database File
include 'conn.php';

if (isset($_POST['login'])) {
    $username = strtolower($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM `admin` WHERE username = '$username'";
    $s = $connection->prepare($sql);
    $s->execute();
    $user = $s->fetch(PDO::FETCH_ASSOC);

    if ($user['username'] == $username) {
      if (password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['loggedin'] = 'true';
        header('Location: adminarea.php');
        die();
      } else {
        echo "Your Password is Incorrect.";
        header('refresh:2;url=admin.php');
      }
    } else {
      echo "Couldn't find your username.";
      header('refresh:2;url=admin.php');
    }
} else {
  header('Location: admin.php');
  die();
}
