<!-- Created by: Ryan Shirlock -->
<!-- Modified: 12/13/23 -->

<!DOCTYPE html>
<html>
    
	<head>
		<title> Northern Psychiatric Services </title>
		<link rel="stylesheet" href="style.css">
	</head>
    <body>
        <div class="info">
        <?php
        $servername = "lemuria.cis.vermontstate.edu";
        $username = "cis4250";
        $password = "blibber"; 
        $dbname = "medical_server";

        $dbh = pg_connect("host=lemuria dbname=medical_server user=cis4150 password=blibber");
        if(!$dbh){
            echo "<p>Error: Database could not connect.</p>";
            exit;
        }
        $patientInfo = $_GET['patientInfo'];

        $query = "SELECT first_name, last_name, gender, DOB, phone_number, email, street, city, state, zip_code FROM patient";
    
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
        </div>
        
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
        <b> Patient Info:</b>
        <p> The FitnessGram™ Pacer Test is a multistage aerobic capacity test that progressively gets more difficult as it continues. The 20 meter pacer test will begin in 30 seconds. Line up at the start. The running speed starts slowly, but gets faster each minute after you hear this signal. [beep] A single lap should be completed each time you hear this sound. [ding] Remember to run in a straight line, and run as long as possible. The second time you fail to complete a lap before the sound, your test is over. The test will begin on the word start. On your mark, get ready, start. </p>
    
    </body>

</html>