<?php
//Gets the patient id from a form in the website
$patient_id = $_POST['patient_id'] ?? 1;
//function specifiedm, essentially just a sql query
$getlabids = <<<GETLABIDS
SELECT laborder_id FROM LabOrders WHERE patient_id = '$patient_id';
GETLABIDS;
//the result of the above query, gets the laborder id given the patient id
$getlabids_result = $conn->query($getlabids);
//if there is at least one labid given that patient id
if ($getlabids_result->num_rows > 0){
    //While there is a row where the patient id and lab id's match up
    while($getlabids_row = $getlabids_result->fetch_assoc()){
        //The below commented code must have been for testing purposes
        //echo("This is a thing for the things.");
        //gets the lab order id
        $laborder_id = $getlabids_row['laborder_id']; 
        //initialized labs_ordered as an array to store all labs ordered in one variable
        $labs_ordered = array();
        //another function which is just a sql query, gets the lab ids from the lab order id
        $results_sql = <<<RESULTS
        SELECT lab_id, results FROM OrderedLabs WHERE laborder_id = '$laborder_id';
        RESULTS;
        // Grabbing results for specific lab based on laborder_id and lab_id of current note
        //This gets the results for the lab given its laborder id in the above sql query
        $labid_result = $conn->query($results_sql);
        //If there is at least one row gathered from the query
        if ($labid_result->num_rows > 0){
            //While each row in the labid result, do this
            while($labid_row = $labid_result->fetch_assoc()){
                //gets the lab id
                $lab_id = $labid_row['lab_id'];
                //gets the lab results
                $results = $labid_row['results'];
                //another function which is just a sql query, gets the lab names from the lab id 
                $lab_name_sql = <<<LABNAME
                SELECT lab_name from LabList WHERE lab_id = '$lab_id';
                LABNAME;  
                //result of the above query, gets the lab names from the lab id
                $labname_result = $conn->query($lab_name_sql);
                //If a row can be fetched from the results
                if ($labname_row = $labname_result->fetch_assoc()){
                    //gets the lab name
                    $lab_name = $labname_row['lab_name']; 
                    //adds the lab name to the labs_ordered array
                    $labs_ordered[] = $lab_name;
                    //new function to list the lab name and its respective results onto the website
                    $results_info = <<<RESULTSINFO
                    <br><br><p><u>$lab_name</u><br>$results</p>
                    RESULTSINFO;
                    //another test code?
                    //echo($results_info);
                }   
            }
            //if it cannot find any lab ids given the lab order ids
        } else {
            //simple echo to screen
            echo('Unable to find lab ids and results of labs for this lab order. Please contact an administrator');
        }

        // Grab all info about laborder from laborder_id
        //Gets the lab destination id, doctor id, recipients, diagnosis, and order date from the lab order id
        $laborderinfo_sql = <<<LABORDERINFO
        SELECT labdest_id, doctor_id, cc_recipients, diagnosis, orderdate FROM LabOrders WHERE laborder_id = '$laborder_id'; 
        LABORDERINFO;
        //results from the above sql query
        $laborderinfo_results = $conn->query($laborderinfo_sql);
        //if a row can be fetched from the results
        if ($laborderinfo_row = $laborderinfo_results->fetch_assoc()){
        // Assign variables from laborderinfo
        $labdest_id = $laborderinfo_row['labdest_id'];
        $doctor_id = $laborderinfo_row['doctor_id'];
        $cc_recipients = $laborderinfo_row['cc_recipients'];
        $diagnosis = $laborderinfo_row['diagnosis'];
        $orderdate = $laborderinfo_row['orderdate'];
            // Get labdest_name from labdest_id
            $labdestname_sql = <<<LABDESTNAME
            SELECT labdest_name from LabDest WHERE labdest_id = '$labdest_id';
            LABDESTNAME;
            //results from sql query above
            $labdestname_results = $conn->query($labdestname_sql);
            //if a row can be fetched from the results
            if ($labdestname_row = $labdestname_results->fetch_assoc()){
                //get the lab destination name
                $labdest_name = $labdestname_row['labdest_name'] ?? "Unknown";
                //if no rows can be fetched from the results
            } else {
                //set the lab destination name as unknown
                $labdest_name = "Unknown";
            }
            

            // Get doctor name from doctor_id
            $doctorname_sql = <<<DOCTORNAME
            SELECT user_name from Users WHERE user_id = '$doctor_id';
            DOCTORNAME;
            //results from query
            $doctorname_results = $conn->query($doctorname_sql);
            //if result row can be gathered
            if ($doctorname_row = $doctorname_results->fetch_assoc()){
                //get doctor name
                $doctor_name = $doctorname_row['user_name'] ?? "Unknown";
                //if result row cannot be gathered
            } else {
                //set doctor name to unknown
                $doctor_name = "Unknown";
            }
            
        }

        //This displays information onto the website, more specifically, lab destination name,
        //order date, doctor name, and any recipients
        $lab_order_text1 = <<<PRESCRIPTIONTEXT
        <div class="laborder_detail_box" style="border-style:solid; border-radius:25px; padding:1em;">
        <p>$labdest_name</p>
        <p>$orderdate</p>
        <p>Ordering Doctor: $doctor_name</p>
        <p>$cc_recipients</p> 

        PRESCRIPTIONTEXT;

        //sets this variable as a paragraph in html
        $lab_order_text2 = '<p>';
        //for each lab ordered
        foreach ($labs_ordered as $x => $val){ 
            //if there is more than one lab order, set the text to this
            if ($x > 0){
                $lab_order_text2 = $lab_order_text2 . ", " . $val;
                // if there is only one lab order
            } else {
                //set this text to this
                $lab_order_text2 = $lab_order_text2 . $val;
            }
        }
        //adds a paragraph html thing at end of this text
        $lab_order_text2 = $lab_order_text2 . "</p>";
        
        //another function to display the diagnosis on the website
        $lab_order_text3 = <<<LABORDERTEXT
        <p>Diagnosis: $diagnosis</p>
        </div>
        LABORDERTEXT;

        //concatenation of all three strings into one big string
        //this holds all the information on the lab orders to be displayed
        $lab_order_text = $lab_order_text1 . $lab_order_text2 . $lab_order_text3;
        //prints the string to the website
        echo($lab_order_text);
    }
    //if no results for lab id from patient id
} else {
    //echo this
    echo('Unable to find lab orders for this patient. Please contact an administrator.');
}
?>