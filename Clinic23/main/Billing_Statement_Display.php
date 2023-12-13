<!DOCTYPE html>
<html>
<main>
    <html>
    <link rel="stylesheet" href="style.css">
    </html>
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
    $query = "SELECT 
                patient_name, 
                tin, 
                account_number, 
                statement_made_date, 
                service_date, 
                service_type, 
                service_cost, 
                insurance_coverage, 
                customer_balance, 
                patient_address, 
                patient_city_state_zip,
                insurance_tier, 
                insurance_provider, 
                policy_number
              FROM patients 
              WHERE patient_id = $patient_id";

    $result = pg_query($conn, $query);

    if ($result) {
        $row = pg_fetch_assoc($result);

        $patient_name = $row['patient_name'];
        $tin = $row['tin'];
        $account_number = $row['account_number'];
        $statement_made_date = $row['statement_made_date'];

        $service_date = $row['service_date'];
        $service_type = $row['service_type'];
        $service_cost = $row['service_cost'];
        $insurance_coverage = $row['insurance_coverage'];
        $customer_balance = $row['customer_balance'];

        $patient_address = $row['patient_address'];
        $patient_city_state_zip = $row['patient_city_state_zip'];

        $insurance_tier = $row['insurance_tier'];
        $insurance_provider = $row['insurance_provider'];
        $policy_number = $row['policy_number'];
    } else {
        echo "Query error: " . pg_last_error();
    }

    // Close the database connection
    pg_close($conn);
    ?>
    <div style="border: 2px solid black; position: relative;">
        Northern Psychiatric Services<br>
        <br>
        Patient Name: <?php echo $patient_name; ?> <br>
        Patient Address: <?php echo $patient_address; ?> <br>
        Patient City, State, Zip: <?php echo $patient_city_state_zip; ?> <br>
        <div style="border: 2px solid black; position: relative;">
            Statement Made: <?php echo $statement_made_date; ?> <br>
        </div>
        <div style="border: 2px solid black; position: relative;">
            Billing Information <br>
            <br>
            Service Date: <?php echo $service_date; ?> <br>
            Service Type: <?php echo $service_type; ?> <br>
            Account #: <?php echo $account_number; ?> <br>
            Service Cost: <?php echo $service_cost; ?> <br>
            Insurance Coverage: <?php echo $insurance_coverage; ?> <br>
            Customer Balance: <?php echo $customer_balance; ?> <br>

        </div>
        <div style="border: 2px solid black; position: relative;">
            Insurance Information <br>
            <br>
            Insurance Tier: <?php echo $insurance_tier; ?> <br>
            Insurance Provider: <?php echo $insurance_provider; ?> <br>
            Policy Number: <?php echo $policy_number; ?> <br>
        </div>
    </div>
    <a href="Billing Statement Page.html">New Statement</a>
    </body>
</main>
</html>
