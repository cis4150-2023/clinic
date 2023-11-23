<?php
//#$medicationlist

//gets the patient id from a form
$patient_id = $_POST['patient_id'] ?? 1;
//test code?
//$patient_id = 1;
//gets the medication id, dosage, and status given the patient id
$sql = <<<SCRIP_LIST_FOR_PATIENT
SELECT medication_id, dosage, status FROM MedicationList WHERE patient_id = '$patient_id';
SCRIP_LIST_FOR_PATIENT;
// Grabbing patient med info from medication list
//result from above query
$medlist_result = $conn->query($sql);
//if at least one row in results
if ($medlist_result->num_rows > 0){
    //while a row can be fetched from the results
    while($row = $medlist_result->fetch_assoc()){
        //gets the medication id
        $medication_id = $row['medication_id']; 
        //gets the dosage
        $dosage = $row['dosage'];
        //gets the status
        $status = $row['status'];
        //test code?
        //echo("medication_id: " . $medication_id . " dosage: " . $dosage);
        //sets this variable as an empty string for future use
        $status_str = '';
        //This if branching determines if the patient is taking the medication or not, 1 = yes, 0 = no
        //$status is probably stored as a boolean
        if ($status == 1){
            $status_str = 'Taking';
        } else if ($status == 0){
            $status_str = 'Not Taking';
        }
        //query function to get the medication name and generic name given the medication id
        $medname_sql = <<<MEDNAME
        SELECT medication_name, generic_name FROM DrugList WHERE medication_id = '$medication_id';
        MEDNAME;
        // Grabbing medication name from DrugList
        $medname_result = $conn->query($medname_sql);
        //if a row can be gathered from the results
        if ($row = $medname_result->fetch_assoc()){
            //get the brand name
            $brand_name = $row['medication_name'];
            //get the generic name
            $generic_name = $row['generic_name'];
            //test code?
            //echo("<br>brand_name: " . $brand_name . " generic_name: " . $generic_name);
            //html function to display the brand name, generic name, dosage, and status of a given medication
            $medication_info = <<<MEDINFO
            <p class="medListItem">$brand_name -- $generic_name<br>$dosage -- $status_str</p>
            MEDINFO;
            //prints the above funtion to the website
            echo($medication_info);
            //if no result row gathered
        } else {
            echo ('Unable to grab medication name from DrugList for specified medication ID.');
        }
    }
    //if there is medication id, dosage, or status gathered given the patient id
} else {
    echo("This user's medication list is empty.");
}
?>