<?php
//#$viewprescriptions
//This gets the patient id from a given form on the website
$patient_id = $_POST['patient_id'] ?? 1;
// Grabbing all prescriptions and their data for patient
$get_prescriptions = <<<GETPRESCRIPTIONS
SELECT * FROM Prescriptions WHERE patient_id = '$patient_id';
GETPRESCRIPTIONS;
//Gets the result of the SQL command above
$prescriptions_result = $conn->query($get_prescriptions);
//if there is more than one row of data gathered
if ($prescriptions_result->num_rows > 0) {
    //While there is a row where the prescriptions and results match up
    while ($prescriptions_row = $prescriptions_result->fetch_assoc()){
        // Prescription result variables
        //Gets the general id for the doctor given the prescription
        $user_id = $prescriptions_row['doctor_id'];

        //Gets the pharamacy id given the prescription
        $pharmacy_id = $prescriptions_row['pharmacy_id'];
        //This sql gets the name of the pharmacy from the pharmacy table where the ids match
        $pharmaid_sql = 'SELECT pharmacy_name FROM Pharmacy WHERE pharmacy_id="' . $pharmacy_id . '";';
        //This is the result of the above query, gets the pharmacy given the prescription
        $pharmaid_result = $conn->query($pharmaid_sql);
        //This allows us to go more in depth in the row
        $row = $pharmaid_result->fetch_assoc();
        //if there is exactly one row where the pharmacy and id link up...
        if ($pharmaid_result->num_rows == 1){
            //Gets the pharmacy name
            $pharmacy_name = $row["pharmacy_name"];
            //if there is more than one pharmacy or none
        } else {
                // Reject form, tell user to enter another pharmacy name, have a form to add new pharmacy
        }

        //This gets the id for the drug given the prescription
        $drug_id = $prescriptions_row['medication_id'];
        //This sql query finds the medication name given its drug id
        $drugname_sql = "SELECT medication_name, generic_name FROM DrugList WHERE medication_id ='" . $drug_id . "';";
        //The query above gets the drugname, hence this result
        $drugname_result = $conn->query($drugname_sql);
        //This fetches everything in the row gathered
        $row = $drugname_result->fetch_assoc();
        //Gets the brand name given the drug id
        $brand_name = $row['medication_name'];
        //Gets the generic name given the drug id
        $generic_name = $row['generic_name'];

        // Select doctor name from user id
        $drname_sql = "SELECT user_name FROM Users WHERE user_id='" . $user_id . "';";
        //Result from above query
        $drname_result = $conn->query($drname_sql);
        //if you can get the doctor name
        if ($row = $drname_result->fetch_assoc()){
            //gets the doctor name under the user_name column
            $doctor_name = $row["user_name"];
            //if you cannot get doctor name
        } else {
            //simple code to understand
            echo("There is no name associated with the ID on this prescription. Please contact an admin.");
            //sets the doctor name to unknown
            $doctor_name = "Unknown";
        }

        //The below code is fairly trivial unless commented, all of these sets data into variables to be used in other PHP or the website
        $dosage = $prescriptions_row['dosage'];
        $route = $prescriptions_row['route'];
        $usage_details = $prescriptions_row['usage_details'];
        //This is where I do not really know, I am guessing explode allows us to gather the details on the usage of the drug, 
        //where when exploding it, the details are put into an arrary
        $usage_arr = explode(' ', $usage_details);
        //The different elements of the array correlate to different data
        //The first element is the measurement of the dose?
        $qtyperdose = $usage_arr[0];
        //Second element is the frequency of use prescribed
        $frequency = $usage_arr[1];
        //The third element is how long the prescription should be used
        $duration = $usage_arr[2];
        //Rest is just like the top of this variable assignment
        $quantity = $prescriptions_row['quantity'];
        $refills = $prescriptions_row['refills'];
        $general_notes = $prescriptions_row['general_notes'];
        $orderdate = $prescriptions_row['orderdate'];
        $status = $prescriptions_row['status'];

        //This is a function to print all of the below code until line 96 under one variable to echo
        $prescription_details_print = <<<PRESCIPTIONS_PRINT
        <div class="prescription_detail_box" style="border-style:solid; border-radius:25px; padding:1em;">
        <p>$pharmacy_name</p>
        <p>$orderdate</p>
        <p>Prescribing Doctor: $doctor_name</p>
        <p>$brand_name ($generic_name) $dosage - $route</p>
        <p>Quantity: $quantity -- Refills: $refills</p>
        <p>$qtyperdose per dose, $frequency times per day, for $duration days</p>
        <p>Usage Info: $general_notes</p>
        </div>
        PRESCIPTIONS_PRINT;
        //This echo lists the details specified in lines 88 to 96, which is mainly the pharmacy, order date,
        //doctor name, brand name, generic name, dosage, route, quantity, refills, measurememt of dose?, frequency (per day), duration (in days), and added general notes
        //All of which listed above is printed onto the web page in an orderly and neat fashion
        echo($prescription_details_print); 
    }
    //If there is no data on the prescription inputted into the search
} else {
    //simple code to understand
    echo('Unable to find prescriptions for this patient. Please contact an administrator.');
}
?>