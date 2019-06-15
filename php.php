<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PHP Guide</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

<?php include 'nav.php'; ?>

  <div class="container">

    <h1>My CRUD Guide </h1>

    <h3>How to Create (Insert Data)</h3>

    <pre><code>
    &#x3C;?php

include &#x27;conn.php&#x27;;

if (isset($_POST[&#x27;submit&#x27;])) {
    $email = $_POST[&#x27;email&#x27;];
    $password = $_POST[&#x27;password&#x27;];

    $sql = &#x22;INSERT INTO users (email, &#x60;password&#x60;) VALUES (&#x27;$email&#x27;, &#x27;$password&#x27;)&#x22;;

    $connection-&#x3E;exec($sql);
}

?&#x3E;

    </code></pre>


    <h3>How to Read Data</h3>
    <pre><code>
    //Get all data from users Place this at top of page
$sql = &#x27;SELECT * FROM users&#x27;;
$s = $connection-&#x3E;prepare($sql);
$s-&#x3E;execute();

$users = $s-&#x3E;fetchALL();

This goes in the body of your page where you want it to display

&#x3C;?php
if ($users &#x26;&#x26; $s-&#x3E;rowCount() &#x3E; 0) {
    foreach ($users as $user) {
        ?&#x3E;
  &#x3C;div class=&#x22;row&#x22;&#x3E;
    &#x3C;div class=&#x22;col&#x22;&#x3E;
      &#x3C;?php echo $user[&#x27;email&#x27;]; ?&#x3E;
    &#x3C;/div&#x3E;
    &#x3C;div class=&#x22;col&#x22;&#x3E;
    &#x3C;?php echo $user[&#x27;password&#x27;]; ?&#x3E;
    &#x3C;/div&#x3E;

  &#x3C;/div&#x3E;


  &#x3C;?php
    }
}
?&#x3E;

</code></pre>

    <h3>How to Update Data in the database</h3>

    <pre><code>
Grab Data from Database

// Check for user ID in the address bar
if (isset($_GET[&#x27;id&#x27;])) {
  $id = $_GET[&#x27;id&#x27;];
  //Get all data from a specific user
$sql = &#x22;SELECT * FROM users WHERE id = $id&#x22;;
$s = $connection-&#x3E;prepare($sql);
$s-&#x3E;execute();
$user = $s-&#x3E;fetch(PDO::FETCH_ASSOC);
}

Show data in your form

&#x3C;form method=&#x22;POST&#x22; action=&#x22;&#x22;&#x3E;
    &#x3C;div class=&#x22;form-group&#x22;&#x3E;
      &#x3C;label for=&#x22;email&#x22;&#x3E;Email address&#x3C;/label&#x3E;
      &#x3C;input value=&#x22;&#x3C;?php echo $user[&#x27;email&#x27;]; ?&#x3E;&#x22; type=&#x22;email&#x22; class=&#x22;form-control&#x22; id=&#x22;email&#x22; name=&#x22;email&#x22; aria-describedby=&#x22;emailHelp&#x22;
        placeholder=&#x22;Enter email&#x22; required&#x3E;
      &#x3C;small id=&#x22;emailHelp&#x22; class=&#x22;form-text text-muted&#x22;&#x3E;We&#x27;ll never share your email with anyone else.&#x3C;/small&#x3E;
    &#x3C;/div&#x3E;
    &#x3C;div class=&#x22;form-group&#x22;&#x3E;
      &#x3C;label for=&#x22;password&#x22;&#x3E;Password&#x3C;/label&#x3E;
      &#x3C;input value=&#x22;&#x3C;?php echo $user[&#x27;password&#x27;]; ?&#x3E;&#x22; type=&#x22;password&#x22; class=&#x22;form-control&#x22; id=&#x22;password&#x22; name=&#x22;password&#x22; placeholder=&#x22;Password&#x22;&#x3E;
    &#x3C;/div&#x3E;
&#x3C;input type=&#x22;hidden&#x22; name=&#x22;id&#x22; value=&#x22;&#x3C;?php echo $user[&#x27;id&#x27;]; ?&#x3E;&#x22;&#x3E;
    &#x3C;button type=&#x22;submit&#x22; class=&#x22;btn btn-success&#x22; name=&#x22;submit&#x22;&#x3E;Submit&#x3C;/button&#x3E;
  &#x3C;/form&#x3E;


  Handle updating data when form is submitted

  //Check if user has submitted form
if (isset($_POST[&#x27;submit&#x27;])) {
  $email = $_POST[&#x27;email&#x27;];
  $password = $_POST[&#x27;password&#x27;];
  $id = $_POST[&#x27;id&#x27;];

  //Update Data In Database
  $sql = &#x22;UPDATE users SET email = &#x27;$email&#x27;, &#x60;password&#x60; = &#x27;$password&#x27; WHERE id = $id&#x22;;
  $connection-&#x3E;exec($sql);
}

</code></pre>


    <h3>How to Delete Data from our database</h3>

    <pre><code>

This handles deleting the data and should be placed at the top of the page

//Handle Deleting Data from database
if (isset($_POST[&#x27;delete&#x27;])) {
  $id = $_POST[&#x27;id&#x27;];
$sql = &#x22;DELETE FROM users WHERE id = $id&#x22;;
$connection-&#x3E;exec($sql);
header(&#x22;Location: ./index.php&#x22;);
die();
}

This is the form to click to delete data

&#x3C;form action=&#x22;&#x22; method=&#x22;POST&#x22;&#x3E;
    &#x3C;input type=&#x22;hidden&#x22; name=&#x22;id&#x22; value=&#x22;&#x3C;?php echo $user[&#x27;id&#x27;]; ?&#x3E;&#x22;&#x3E;
      &#x3C;button type=&#x22;submit&#x22; class=&#x22;btn btn-danger mt-4&#x22; name=&#x22;delete&#x22;&#x3E;Delete&#x3C;/button&#x3E;
    &#x3C;/form&#x3E;

</code></pre>

    <h3>
      How to handle a file
    </h3>

    <pre><code>

This is the code needed to handle the submission of a file.

if (isset($_POST[&#x27;img&#x27;])) {
    try {
        //HANDLE IMAGE
        if (0 != $_FILES[&#x27;myimage&#x27;][&#x27;size&#x27;]) {
            $folder = &#x27;./img/&#x27;;
            $name = $_FILES[&#x27;myimage&#x27;][&#x27;name&#x27;];
            $ext = pathinfo($name, PATHINFO_EXTENSION);
            $newname = time().&#x27;.&#x27;.$ext;
            move_uploaded_file($_FILES[&#x27;myimage&#x27;][&#x27;tmp_name&#x27;], &#x22;$folder&#x22;.$newname);
            $imgsrc = $folder.$newname;
        } else {
            $imgsrc = &#x27;&#x27;;
        }

        $title = $_POST[&#x27;title&#x27;];

        //Insert Data Into Database
        $sql = &#x22;INSERT INTO img (title, imgurl) VALUES (&#x27;$title&#x27;, &#x27;$imgsrc&#x27;)&#x22;;
        $connection-&#x3E;exec($sql);
    } catch (PDOException $error) {
        echo $sql.&#x27;&#x3C;br&#x3E;&#x27;.$error-&#x3E;getMessage();
    }
}

This is what the form looks like:data

&#x3C;form action=&#x22;&#x22; method=&#x22;POST&#x22; enctype=&#x22;multipart/form-data&#x22;&#x3E;
      &#x3C;div class=&#x22;form-group&#x22;&#x3E;
        &#x3C;label for=&#x22;title&#x22;&#x3E;Title&#x3C;/label&#x3E;
        &#x3C;input type=&#x22;text&#x22; class=&#x22;form-control&#x22; id=&#x22;title&#x22; name=&#x22;title&#x22; aria-describedby=&#x22;emailHelp&#x22;
          placeholder=&#x22;Enter Image Title&#x22; required&#x3E;
        &#x3C;input type=&#x22;file&#x22; name=&#x22;myimage&#x22; id=&#x22;myimage&#x22; class=&#x22;form-control&#x22; accept=&#x22;.png,.jpg,.jpeg,.svg&#x22;&#x3E;
        &#x3C;button type=&#x22;submit&#x22; class=&#x22;btn btn-primary&#x22; name=&#x22;img&#x22;&#x3E;Upload Image&#x3C;/button&#x3E;
      &#x3C;/div&#x3E;

    &#x3C;/form&#x3E;

</code></pre>


    <h3>How to handle Sessions and Login</h3>

    <pre><code>

  Create a Login page and use this form



  Create a Login.php page and use this code to process it 



  Create a session file to make sure people are logged in and if not have them redirected.


  Create a database table for the user inforamtion


    </code></pre>

  </div>
</body>

</html>
