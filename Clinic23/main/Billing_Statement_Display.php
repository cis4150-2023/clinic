<!DOCTYPE html>
<html>
<head>
    <title> Northern Psychiatric Services </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php

$host = "lemuria.cis.vermontstate.edu";
$dbname = "medical_server";
$user = "cis4250";
$password = "blibber";

// Initiate a connection to the server
$conn = pg_connect("host=$host dbname=$dbname user=$user password=$password");

// Check connection
if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

// Get the patient_id from the form
$patient_id = $_POST['patient_id'];

// Fetch patient information from the database
$patientQuery = "SELECT 
                first_name, 
                last_name,
                tin, 
                street,
                city,
                state, 
                zip_code
              FROM patients 
              WHERE patient_id = $patient_id";

$patientResult = pg_query($conn, $patientQuery);
if ($patientResult) {
    $patientRow = pg_fetch_assoc($patientResult);
    if ($patientRow){
        $patient_name = $patientRow['first_name'] . " " . $patientRow['last_name'];
        $tin = $patientRow['tin'];
        $account_number = $patientRow['account_number'];
        $street = $patientRow['street'];
        $city = $patientRow['city'];
        $state = $patientRow['state'];
        $zip_code = $patientRow['zip_code'];
    }
    else{
        echo "Patient not found.";
    }
} else {
    echo "Patient Query error: " . pg_last_error();
}

// Fetch billing information from the database
$billingQuery = "SELECT 
                statement_made, 
                service_date, 
                service_type, 
                service_provided,
                total_charge, 
                insurance_payment,
                patient_payment, 
                due_date
              FROM payment 
              WHERE patient_id = $patient_id";

$billingResult = pg_query($conn, $billingQuery);
if ($billingResult) {
    $billingRow = pg_fetch_assoc($billingResult);
    if ($billingRow){
        $statement_made = $billingRow['statement_made'];
        $service_date = $billingRow['service_date'];
        $service_provided = $billingRow['service_provided'];
        $total_charge = $billingRow['total_charge'];
        $insurance_payment = $billingRow['insurance_payment'];
        $customer_balance = $billingRow['patient_payment'];
        $due_date = $billingRow['due_date'];
    }else{
        echo "Billing information not found.";
    }
} else {
    echo "Billing Query error: " . pg_last_error();
}

// Close the database connection
pg_close($conn);
?>


<div style="border: 2px solid black; position: relative;">
    Northern Psychiatric Services<br>
    <br>
    Account #: <?php echo $tin; ?> <br>
    Patient Name: <?php echo $patient_name; ?> <br>
    Patient Address: <?php echo $street; ?> <br>
    Patient City, State, Zip: <?php echo $city . ", " . $state . ", " . $zip_code; ?> <br>
    <div style="border: 2px solid black; position: relative;">
        Statement Made: <?php echo $statement_made; ?> <br>
    </div>
    <div style="border: 2px solid black; position: relative;">
        Billing Information <br>
        <br>
        Service Date: <?php echo $service_date; ?> <br>
        Service Type: <?php echo $service_provided; ?> <br>
        Service Cost: <?php echo $total_charge; ?> <br>
        Insurance Coverage: <?php echo $insurance_payment; ?> <br>
        Customer Balance: <?php echo $customer_balance; ?> <br>
        Due Date: <?php echo $due_date; ?> <br>
    </div>
</div>
<a href="Billing Statement Page.html">New Statement</a>
</body>

</html>

