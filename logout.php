<?php
session_start();
session_unset(); //removes all session variables
session_destroy(); //Destroys the session

header('Location: admin.php');
die();
