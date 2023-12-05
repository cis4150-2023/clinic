<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css" media="screen">

</head>
<body>
<header>
<h1>Login</h1>
</header>
<br><br><br><br><br><br>

<form action=PatientList.html method="post">

  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" id="username" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" id="password" required>

    <button type="submit">Login</button>
    <a href="landing.html">Cancel</a>
  </div>
</form>
<?php
    $db = $dbconnect = pg_connect("host=lemuria dbname=medical_server user=cis4250 password=blibber");
    if ($db->connect_errno > 0){
      echo "<p>Error: Could not connect to database.<br></p>";
      exit;
    }
    session_start();
    if ( !isset($_POST['username'], $_POST['password']) ) {
	exit('Please fill both the username and password fields!');
    }
    if ($stmt = $con->prepare('SELECT practitionerID, password FROM practitioner WHERE username = ?')) {
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();

	$stmt->close();

    if ($stmt->num_rows > 0) {
	$stmt->bind_result($id, $password);
	$stmt->fetch();
    if ($_POST['password'] === $password) {
        // Verification success! User has logged-in!
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['name'] = $_POST['username'];
		$_SESSION['id'] = $id;
		echo 'Welcome ' . $_SESSION['name'] . '!';
	}
	else {
		// Incorrect password
		echo 'Incorrect username and/or password!';
        }
    }
    else {
	// Incorrect username
	echo 'Incorrect username and/or password!';
}
}
?>
</body>
</html>
