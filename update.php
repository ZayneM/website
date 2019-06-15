<?php
include "conn.php";

//Handle Deleting Data from database
if (isset($_POST['delete'])) {
  $id = $_POST['id'];
$sql = "DELETE FROM users WHERE id = $id";
$connection->exec($sql);
header("Location: ./index.php");
die();
}

//Check if user has submitted form
if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $id = $_POST['id'];

  //Update Data In Database
  $sql = "UPDATE users SET email = '$email', `password` = '$password' WHERE id = $id";
  $connection->exec($sql);
}



// Check for user ID in the address bar
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  //Get all data from a specific user
$sql = "SELECT * FROM users WHERE id = $id";
$s = $connection->prepare($sql);
$s->execute();
$user = $s->fetch(PDO::FETCH_ASSOC);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Update User Data</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <h1>Update User Data</h1>
    <h3>You are updating user with Email: <?php echo $user['email']; ?> </h3>
  
    <form method="POST" action="">
      <div class="form-group">
        <label for="email">Email address</label>
        <input value="<?php echo $user['email']; ?>" type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
          placeholder="Enter email" required>
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input value="<?php echo $user['password']; ?>" type="password" class="form-control" id="password" name="password" placeholder="Password">
      </div>
  <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
      <button type="submit" class="btn btn-success" name="submit">Submit</button>
    </form>
  
    <form action="" method="POST">
    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
      <button type="submit" class="btn btn-danger mt-4" name="delete">Delete</button>
    </form>
  </div>

</body>
</html>
