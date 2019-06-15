<?php
//CONNECTION FILE
$host = "localhost";
$username = "username";
$pass = "password";
$dbname = "dbname";
$dsn = "mysql:host=$host;dbname=$dbname";
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
);
$connection = new PDO($dsn, $username, $pass, $options);


//INSERT - MAKING NEW ENTRY DIFFERENT WAY
$sql = "INSERT INTO studentgoals (studentid, priority1id, priority2id, priority3id, importance,) VALUES ($studentid, '0', '0', '0', 'equal')";
$connection->exec($sql);

// INSERT - MAKING A NEW ENTRY IN TABLE

try {
    $connection = new PDO($dsn, $username, $pass, $options);

    $new_user = array(
        "parentid" => $_SESSION['pid'],
        "fname" => $_POST['fname'],
        "lname" => $_POST['lname'],
        "gender" => $_POST['gender'],
        "dob" => $_POST['dob'],
        "grade" => $_POST['grade'],
        "school" => $_POST['school'],
        "notes" => $_POST['notes'],
        "pickup" => $_POST['pickup'],
        "username" => $_POST['username'],
        "password" => $_POST['password'],

    );

    $sql = sprintf(
        "INSERT INTO %s (%s) values (%s)",
        "studentprofile",
        implode(", ", array_keys($new_user)),
        ":" . implode(", :", array_keys($new_user))
    );

    $statement = $connection->prepare($sql);
    $statement->execute($new_user);
} catch (PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}

//FUNCTION FOR INSERT - Making New Entry with a function
function insertdata(string $table, array $data)
{
    try {
        $connection = new PDO($dsn, $username, $pass, $options);
        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            $table,
            implode(", ", array_keys($data)),
            ":" . implode(", :", array_keys($data))
        );

        $statement = $connection->prepare($sql);
        $statement->execute($new_user);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

}

// GET LAST INSERT ID
$last_id = $connection->lastInsertId();

// UPDATE - CHANGING INFORMATION IN A TABLE SHORT WAY

$sql = "UPDATE studentprofile SET moneyc = moneyc+$amount, moneyt = moneyt+$amount WHERE id = $studentid";
$connection->exec($sql);

//UPDATE - CHANGING INFORMATION IN A TABLE LONG WAYS
try {
    $connection = new PDO($dsn, $username, $pass, $options);

    $user = array(
        "id" => $_POST['id'],
        "fname" => $_POST['fname'],
        "lname" => $_POST['lname'],
        "gender" => $_POST['gender'],
        "dob" => $_POST['dob'],
        "grade" => $_POST['grade'],
        "school" => $_POST['school'],
        "notes" => $_POST['notes'],
        "pickup" => $_POST['pickup'],
        "username" => $_POST['username'],
        "password" => $_POST['password'],

    );

    $sql = "UPDATE studentprofile
				SET	fname = :fname,
					lname = :lname,
					gender = :gender,
					dob = :dob,
					grade = :grade,
					school = :school,
					notes = :notes,
					pickup = :pickup,
					username = :username,
					`password` = :password
				WHERE id = :id";

    $statement = $connection->prepare($sql);
    $statement->bindParam(":id", $user['id']);
    $statement->bindParam(":fname", $user['fname']);
    $statement->bindParam(":lname", $user['lname']);
    $statement->bindParam(":gender", $user['gender']);
    $statement->bindParam(":dob", $user['dob']);
    $statement->bindParam(":grade", $user['grade']);
    $statement->bindParam(":school", $user['school']);
    $statement->bindParam(":notes", $user['notes']);
    $statement->bindParam(":pickup", $user['pickup']);
    $statement->bindParam(":username", $user['username']);
    $statement->bindParam(":password", $user['password']);
    $statement->execute();
} catch (PDOException $error) {
    echo $sql . "<br />" . $error->getMessage() . "<br />";
    echo var_dump($user);
}

// DELETE A ROW IN A TABLE
$sql = "DELETE FROM blog WHERE id = $id";
$connection->exec($sql);

// SELECT * FROM DATABASE WITH fetchAll
try {
    $connection = new PDO($dsn, $username, $pass, $options);

    $sql = "SELECT *
		FROM studentprofile
		WHERE parentid = '$pid' AND active = 'yes'";

    $statement = $connection->prepare($sql);
    $statement->bindParam('$id', $pid, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchALL();
} catch (PDOException $error) {
    echo $sql . "<br />" . $error->getMessage();
}

if ($result && $statement->rowCount() > 0) {

    foreach ($result as $row) {
        echo $row['fname'];
    }
}

// SELECT * FROM TABLE WITH FETCH GETTING ONLY ONE ROW
$sql = "SELECT * FROM badges WHERE badges.id = $badgeid";
$statement = $connection->prepare($sql);
$statement->execute();
$result = $statement->fetch(PDO::FETCH_ASSOC);

echo $result['bname'];

// SELECT * FROM TABLE AND JOIN
try {
    $connection = new PDO($dsn, $username, $pass, $options);
    $id = $_SESSION['id'];
    $sql = "SELECT badgetrack.*, badges.bname, badges.img, badges.badgemoney
				FROM badgetrack
		        JOIN badges ON(badges.id = badgetrack.badgeid)
				WHERE studentid = '$id' AND verified = 'yes'";

    $statement = $connection->prepare($sql);
    $statement->bindParam('$studentid', $id, PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetchALL(PDO::FETCH_ASSOC);
} catch (PDOException $error) {
    echo $sql . "<br />" . $error->getMessage();
}
if ($result && $statement->rowCount() > 0) {

    foreach ($result as $row) {
        echo $row['img'];
    }
}

// SELECT AND COUNT NUMBER OF ROWS
$postnum = $connection->query("SELECT COUNT(id) FROM blog WHERE (created >= NOW() - INTERVAL 1 DAY) AND studentid = $id")->fetchColumn();

// ORDER DATA BY SPECFIC COLUMN
$sql = "SELECT blog.*, studentprofile.username
              FROM blog
              JOIN studentprofile ON (studentprofile.id = blog.studentid)
              WHERE view = 'public' AND approved = 'yes'
              ORDER BY id DESC"; // ORDER BY id DESC

// TAKE INPUT TO ORDER AND ARRANGE THE DATA

try {
    $ascdesc = "desc";
    if (isset($_POST['reverseorder'])) {
        $ascdesc = $_POST['reverse'];
    }

    $order = "id";
    if (isset($_POST['sortmethod'])) {
        $order = $_POST['sortmethod'];
    }

    $connection = new PDO($dsn, $username, $pass, $options);
    $sql = "SELECT jobboard.*, badgecat.bname, studentprofile.username
				FROM jobboard
		        JOIN badgecat ON(badgecat.id = jobboard.catid)
            JOIN studentprofile ON(studentprofile.id = jobboard.empid)
        WHERE `status` = 'open'
        ORDER BY $order $ascdesc";

    $statement = $connection->prepare($sql);
    $statement->execute();
    $jobposts = $statement->fetchALL(PDO::FETCH_ASSOC);
} catch (PDOException $error) {
    echo $sql . "<br />" . $error->getMessage();
}


//How to reorder things in the database
if (isset($_GET['direction'])) {
    $id = $_GET['blid'];
    $direction = $_GET['direction'];
    $number = $_GET['number'];
    $shiftdown = $number +1;
    $shiftup = $number -1;
    if ($direction == 'down') {
      $sql = "UPDATE backlog SET `number` = $number Where `number` = $shiftdown AND scrumid IS NULL";
      $sconnection->exec($sql);
      $sql = "UPDATE backlog SET `number` = $number +1 WHERE id = $id";
      $sconnection->exec($sql);
  } else if ($direction == 'up') {
    $sql = "UPDATE backlog SET `number` = $number Where `number` = $shiftup AND scrumid IS NULL";
      $sconnection->exec($sql);
      $sql = "UPDATE backlog SET `number` = $number -1 WHERE id = $id";
      $sconnection->exec($sql);
  }
}
