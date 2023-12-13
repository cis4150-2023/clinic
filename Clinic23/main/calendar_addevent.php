<!-- Created by: Austin -->
<!-- Modified: 11/9/23 -->

<!DOCTYPE HTML>
<html lang="'en">
    <head>
        <title>Clinic23 Add New Calendar Event</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
        <style>
            #submit{
                position:fixed;
                right: 5%;
                bottom: 5%;
                padding: 1.5%
            }
            #submit:hover{
                background: #008BFF;
            }
        </style>
    </head>
    <div>
        <body>
            <br>
            <form method="POST">
                <h1 style="text-align: center;">Event Details</h1>
                <br>
            <table>
                <tr>
                    <th>Doctor Name</th>
                    <th>Patient Name</th>
                    <th>Date/Time</th>
                    <th>Duration</th>
                </tr>
                <tr>
                    <td><input type="text" name="doctorname" required></td>
                    <td><input type="text" name="patientname" required></td>
                    <td><input type="datetime-local" name="datetime" required></td>
                    <td><select name="duration" required>
                        <option value="15minutes">15 Minutes</option>
                        <option value="30minutes">30 Minutes</option>
                        <option value="45minutes">45 Minutes</option>
                        <option value="1hour">1 Hour</option>
                    </select></td>
                </tr>
            </table>
            <br>
            <table>
                <tr>
                    <th>Location</th>
                    <th>Purpose</th>
                    <th>Notes</th>
                </tr>
                <tr>
                    <td><input type="text" name="location" required></td>
                    <td><input type="text" name="purpose" required></td>
                    <td><textarea name="notes" rows="4" cols="50"></textarea></td>
                </tr>
            </table>
            <a href="clinic23_calendar.html" style="position:fixed; left: 5%; bottom: 5%; padding: 1.5%">Back</a>
            <input id="submit" type="submit" value="Create Appointment" onclick="submittedEvent()">
            </form>
            <?php
            $doctorName = $_POST["doctorname"];
            $patientName = $_POST["patientname"];
            $dateTime = $_POST["datetime"];
            $duration = $_POST["duration"];
            $location = $_POST["location"];
            $purpose = $_POST["purpose"];
            $notes = $_POST["notes"];
            $date = $dateTime->date;
            $dateTimeEnd = $dateTime+$duration;

            $db_handle = pg_connect("host=lemuria dbname=medical_server user=cis4250 password=blibber"); 
            if(!$db_handle){
                echo "<p>Error: Database could not connect.<br></p>";
                exit;
            }
            session_start();
            $query = "SELECT COUNT(*) FROM appointment";
            $result = pg_exec($db_handle, $query);
            if($result > 0){
                $query1 = "SELECT appointmentID FROM appointment ORDER BY ts DESC LIMIT 1";
                $result1 = pg_exec($db_handle, $query1);
                $a_type = pg_exec($db_handle, "SELECT a_type FROM a_type WHERE name = $purpose");
                $practitionerID = pg_exec($db_handle, "SELECT practitionerID FROM practitioner where first_name = $doctorName");
                $patientID = pg_exec($db_handle, "SELECT patientID FROM patient WHERE first_name = $patientName");
                $query = "INSERT INTO appointment VALUES ($result1+1,$a_type,0,0,$date, $notes, $practitionerID, $dateTime, $dateTimeEnd, $patientID";
                $resultUlt1 = pg_exec($db_handle, $query);
            }
            $query4 = "INSERT INTO appointment VALUES (0,$a_type,0,0,$date, $notes, $practitionerID, $dateTime, $dateTimeEnd, $patientID";
            $resultUlt2 = pg_exec($db_handle, $query4);
            pg_close($db_handle);
            ?>
        </body>
    </div>
    <script>
        function submittedEvent() {
          alert("Submission Successful, Event Added");
        }
        </script>
</html>