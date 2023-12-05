<!-- Created by: Ryan Shirlock -->
<!-- Modified: 12/05/23 -->

<?php
$servername = "lemuria";
$username   = "cis4250";
$password   = "blibber"; 
$dbname     = "medical_server";

$patientInfo = $_GET['patientInfo'];

$query = "SELECT first_name, last_name, gender, DOB, phone_number, email, street, city, state, zip_code FROM patient";

try {
    $connection = new PDO(pgsql:host="lemuria";dbname="medical_server","cis4250","blibber");
    echo "Searching in patient table:<br/>";

    foreach($connection->query($query) as $row) {
        echo "Name: ";
        print_r($row["first_name"]);
        print_r($row["last_name"]);
        echo "<br/>Gender/Sex: ";
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
        echo "
        <b>Contacts: </b>
        <b>#1: </b>
        <P> - Thomas Shenkov {Emergency} </p>
        <b>Phone #: </b>
        <p> 802-369-4269 </p>
        <b>Relation: </b>
        <p> Family Member </p>
        <b>#2: </b>
        <p> - Noah Woodard </p>
        <b>Phone #: </b>
        <p> 802-976-2834 </p>
        <b>Relation: </b>
        <p> Doctor </p> <br/>
        
        <b>Insurance Provider: </b>
        <p> VGA Insurance </p>
        <b>Last Check-Up: </b>
        <p> 04/20/2022 </p>
        <b>Last Physical: </b>
        <p> 07/30/2023 </p> <br/>"

    echo "End of info.<br/>";
//I say ‘end of list’ so that if nothing is found, something is still printed
    $connection = null;
}
catch (PDOException $e) {
    print "Error: " . $e->getMessage() . "<br/>";
    die();
}
?>
<!--
        <b>Name: </b>
        <p> Auditore, David </p>
        <b>DOB: </b>
        <p> 09/12/2013 </p>
        <b>Height: </b>
        <p> 5'6"</p>
        <b>Weight: </b>
        <p> 170lbs </p> <br/>
        
        <b>Contacts: </b>
        <b>#1: </b>
        <P> - Thomas Shenkov {Emergency} </p>
        <b>Phone #: </b>
        <p> 802-369-4269 </p>
        <b>Relation: </b>
        <p> Family Member </p>
        <b>#2: </b>
        <p> - Noah Woodard </p>
        <b>Phone #: </b>
        <p> 802-976-2834 </p>
        <b>Relation: </b>
        <p> Doctor </p> <br/>
        
        <b>Insurance Provider: </b>
        <p> VGA Insurance </p>
        <b>Last Check-Up: </b>
        <p> 04/20/2022 </p>
        <b>Last Physical: </b>
        <p> 07/30/2023 </p> <br/>
        
    </p>
    <b> Patient Info:</b>
    <p> The FitnessGram™ Pacer Test is a multistage aerobic capacity test that progressively gets more difficult as it continues. The 20 meter pacer test will begin in 30 seconds. Line up at the start. The running speed starts slowly, but gets faster each minute after you hear this signal. [beep] A single lap should be completed each time you hear this sound. [ding] Remember to run in a straight line, and run as long as possible. The second time you fail to complete a lap before the sound, your test is over. The test will begin on the word start. On your mark, get ready, start. </p>
-->