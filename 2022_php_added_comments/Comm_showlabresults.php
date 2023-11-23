<?php
//#$labresults
//test code?
//$note_id = $_POST['note_id'] ?? 1;
//gets the patient id from a form
$patient_id = $_POST['patient_id'] ?? 1;
//test code?
/*$laborderid_sql = <<<LAB_IDS_FOR_PATIENT
SELECT laborder_id FROM Note WHERE note_id = '$note_id';
LAB_IDS_FOR_PATIENT;*/
//sql funtion to gather lab order id given the patient id and appointment id
//---appointment id is never declared on this page---
$laborderid_sql2 = <<<LAB_IDS_FOR_PATIENT
SELECT laborder_id FROM Note WHERE patient_id = '$patient_id' AND appointment_id = '$appointment_id';
LAB_IDS_FOR_PATIENT;
// Grabbing laborder_id and lab_id from current note
$laborderid_result = $conn->query($laborderid_sql2);
//if result row gathered
if ($laborderid_row = $laborderid_result->fetch_assoc()){
    //gets laborder id
    $laborder_id = $laborderid_row['laborder_id']; 
    //test code?
    //echo("Laborder_id: " . $laborder_id);
    //sql function to get lab id, results, and urgent given the laborder id
    $labdetails_sql = <<<RESULTS
    SELECT lab_id, results, urgent FROM OrderedLabs WHERE laborder_id = '$laborder_id';
    RESULTS;
    // Grabbing lab id and results for specific labs based on laborder_id of current note
    $labdetails_result = $conn->query($labdetails_sql);
    //not sure what that code is in the if, but determines if there is any rows in the result
    if (!isset($labdetails_result)){
        echo ("Unable to retrieve lab results for this user");
        //exits with an error?
        exit(1);
    }
    //if results have more than one row
    if ($labdetails_result->num_rows > 0){
        //while results row gathered
        while($labdetails_row = $labdetails_result->fetch_assoc()){
            //get lab id
            $lab_id = $labdetails_row['lab_id'];
            //get results
            $results = $labdetails_row['results'] ?? "No Results";
            //get urgent
            $urgent = $labdetails_row['urgent'] ?? 0;
            //sql function to get the lab name given the lab id
            $lab_name_sql = <<<LABNAME
            SELECT lab_name from LabList WHERE lab_id = '$lab_id';
            LABNAME;  
            //result from above query
            $labname_result = $conn->query($lab_name_sql);
            //if result row gathered
            if ($labname_row = $labname_result->fetch_assoc()){
                //test code?
                /*
                if ($results == null){
                    $results = "No results.";
                }
                */
                //gets the lab name
                $lab_name = $labname_row['lab_name'] ?? "Unknown Name";
                //html function to print the lab name and its results
                $results_info = <<<RESULTSINFO
                <p><u>$lab_name</u><br>$results</p>
                RESULTSINFO;
                //urgent is stored as a boolean probably
                //This if else statement determines if the lab is urgent, if so it is highlighted in red on the website, if not it does not
                //This also prints the results to the website at the same time
                if ($urgent == 1){
                    echo("<span style='color:red;'>" . $results_info . "</span>");
                } else {
                echo($results_info);
                }
            } 
        }
    //if no lab results can be found given the lab order id
    } else {
        echo('Unable to retrieve lab results for this user.');
    }
    //if lab order id cannot be found given the patient id and the appointment id
    //--- appointment id is never declared on this page --- 
} else {
    echo('Unable to retrieve lab results for this user.');
}
?>