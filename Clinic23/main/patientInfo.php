<!-- Created by: Ryan Shirlock -->
<!-- Modified: 12/06/23 -->

<?php
$servername = "lemuria";
$username   = "cis4250";
$password   = "blibber"; 
$dbname     = "medical_server";

$patientInfo = $_GET['patientInfo'];

$query = "SELECT first_name, last_name, gender, DOB, phone_number, email, street, city, state, zip_code FROM patient";

try {
    echo "conecting...<br>";
    $db =pg_connect("host=lemuria dbname=medical_server user=cis4250 password=blibber");
    if ($db->connect_errno > 0){
      echo "<p>Error: Could not connect to database.<br></p>";
      exit;
    }
    else{
        echo "conected!";
    }
    
    foreach($connection->query($query) as $row) {
        echo "Name: ";
        print_r($row["first_name"]);
        echo " ";
        print_r($row["last_name"]);
        echo "<br/>Gender: ";
        print_r($row["gender"]);
        echo "<br/>Date of Birth: ";
        print_r($row["DOB"]);
        echo "<br/>Contact Info:";
        echo "<br/>Phone: ";
        print_r($row["phone_number"]);
        echo "<br/>Email: ";
        print_r($row["email"]);
        echo "<br/>Address: ";
        print_r($row["street"]);
        echo ", ";
        print_r($row["city"]);
        echo ", ";
        print_r($row["state"]);
        echo ", ";
        print_r($row["zip_code"]);
    echo "End of info.<br/>";
//I say ‘end of list’ so that if nothing is found, something is still printed
    $connection = null;
}
catch (PDOException $e) {
    print "Error: " . $e->getMessage() . "<br/>";
    die();
}
?>