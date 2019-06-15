<?php
// Include Connection to Database File
include 'conn.php';

if (isset($_POST['img'])) {
    try {
        //HANDLE IMAGE
        if (0 != $_FILES['myimage']['size']) {
            $folder = './img/';
            $name = $_FILES['myimage']['name'];
            $ext = pathinfo($name, PATHINFO_EXTENSION);
            $newname = time().'.'.$ext;
            move_uploaded_file($_FILES['myimage']['tmp_name'], "$folder".$newname);
            $imgsrc = $folder.$newname;
        } else {
            $imgsrc = '';
        }

        $title = $_POST['title'];

        //Insert Data Into Database
        $sql = "INSERT INTO img (title, imgurl) VALUES ('$title', '$imgsrc')";
        $connection->exec($sql);
    } catch (PDOException $error) {
        echo $sql.'<br>'.$error->getMessage();
    }
}

//Check if user has submitted form
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    //Insert Data Into Database
    $sql = "INSERT INTO users (email, `password`) VALUES ('$email', '$password')";
    $connection->exec($sql);
}

//Get all data from users
$sql = 'SELECT * FROM users';
$s = $connection->prepare($sql);
$s->execute();

$users = $s->fetchALL();

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>User Submit</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>

  <?php include 'nav.php'; ?>




  <div class="container">
    <form method="POST" action="">
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
          placeholder="Enter email" required>
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
      </div>

      <button type="submit" class="btn btn-success" name="submit">Submit</button>
    </form>

    <?php
  if ($users && $s->rowCount() > 0) {
      foreach ($users as $user) {
          ?>
    <div class="row">
      <div class="col">
        <a
          href="update.php?id=<?php echo $user['id']; ?> "><?php echo $user['email']; ?></a>
      </div>
      <div class="col">
        <?php echo $user['password']; ?>
      </div>

    </div>


    <?php
      }
  }
  ?>


    <form action="" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp"
          placeholder="Enter Image Title" required>
        <input type="file" name="myimage" id="myimage" class="form-control" accept=".png,.jpg,.jpeg,.svg">
        <button type="submit" class="btn btn-primary" name="img">Upload Image</button>
      </div>

    </form>
  </div>

</body>

</html>
