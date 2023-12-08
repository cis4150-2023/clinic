<!-- Created by: Kathleen -->
<!-- Additional Credits: -->
<!-- Modified: 10/17/23 -->

<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Create Patient</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css" media="screen">
    </head>
    <body>
<header>
<h1>Create Patient</h1>
</header>
<br><br>
<main>
<div class="center-form">
<form method="post" action="https://webdevbasics.net/scripts/demo.php">
<label for="last">Last Name:</label>
<input type="text" name="last" id="last">
<br><br>
<label for="first">First Name:</label>
<input type="text" name="first" id="first">
<br><br>
 <label for="gender">Gender:</label>
<select id="gender" name="gender">
  <option value="?">?</option>
  <option value="male">Male</option>
  <option value="female">Female</option>
</select>
<br><br>
<label for="birth">Birth Date:</label>
<input type="date" id="birth" name="birth">
<br><br>
<label for="phone">Phone Number:</label>
<input type="tel" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">
<br><br>
<label for="email">Email:</label>
<input type="email" name="email" id="email">
<br><br>
<label for="address">Mailing Address:</label>
<input type="text" name="address" id="address">
<br><br>
<label for="insure">Insurance:</label>
<input type="text" name="insurance" id="insurance">
<br><br>
<label for="contact">Emergency Contact:</label>
<input type="text" name="contact" id="contact">
<br><br>
<label for="Cphone">Emergency Contact Phone Number:</label>
<input type="tel" id="Cphone" name="Cphone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">
<br><br>
<fieldset>
	<legend>Please list any allergies you may have:</legend>
		<textarea name="allergies" id="allergies" cols="60" rows="3"></textarea>
</fieldset>
<br>
<input type="submit" value="SUBMIT" >
<a href="landing.html">Back</a>
</form>
</div>
<?php
    $db = new mysqli('lemuria', 'cis4250', 'medical_server', 'blibber');
    if ($db->connect_errno > 0){
      echo "<p>Error: Could not connect to database.<br></p>";
      exit;
    }
        $first_name =  $_REQUEST['first'];
        $last_name = $_REQUEST['last'];
        $gender =  $_REQUEST['gender'];
        $address = $_REQUEST['address'];
        $birth = $_REQUEST['birth'];
        $phone = $_REQUEST['phone'];
        $email = $_REQUEST['email'];
        $insure = $_REQUEST['insure'];
        $contact = $_REQUEST['contact'];
        $Cphone = $_REQUEST['Cphone'];
        $allergies = $_REQUEST['allergies'];


        // Performing insert query execution
        $sql = "INSERT INTO patient VALUES ('','$gender','','$birth','$allergies','','','','$contact','','$insure','$first_name',
            '$last_name','$phone','$email','$address','','','')";

        if(mysqli_query($conn, $sql)){
            echo "<h3>data stored in a database successfully.</h3>";
        } else{
            echo "ERROR"
                . mysqli_error($conn);
        }

        // Close connection
        mysqli_close($conn);
?>
</main>
</body>
</html>
