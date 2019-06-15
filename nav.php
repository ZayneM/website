<ul class="nav justify-content-center">
  <li class="nav-item">
    <a class="nav-link" href="index.php">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="admin.php">Admin</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="php.php">php Guide</a>
  </li>
<?php
if (isset($_SESSION['loggedin'])) {
    ?>

  <li class="nav-item">
    <a class="nav-link" href="logout.php">Logout</a>
  </li>
<?php
}
?>

</ul>
