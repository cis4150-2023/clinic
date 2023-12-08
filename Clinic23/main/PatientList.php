<!-- Created by: Kathleen -->
<!-- Additional Credits: -->
<!-- Modified: 10/17/23 -->

<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Patient View</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css" media="screen">
    </head>

    <body>
<header>
<h1>Patients</h1>
</header>
<br><br><br>
<br><br>
<main>
<div class="tableBill">
<?php
    $db = new mysqli('lemuria', 'cis4250', 'medical_server', 'blibber');
    if ($db->connect_errno > 0){
      echo "<p>Error: Could not connect to database.<br></p>";
      exit;
    }
    $query = "
select patient.first_name as first, patient.last_name as last,
patient.DOB as birth, patient.phone_number as phone
    from patient";

    $result = $db->prepare($query);
    $result->execute();
    $result->store_result();
    $rows = $result->num_rows;
    $result->bind_result($first,$last,$birth,$phone);

    echo"<table>";
    echo"<tr>
        <th WIDTH='200px'>Select Patient</th>
        <th WIDTH='500px'>Name</th>
        <th WIDTH='200px'>Date of Birth</th>
        <th WIDTH='200px'>Phone Number</th>
    </tr>";
    while($result->fetch()){
        print"    <tr>
        <td><a href=practitionerView.html>select</a></td>
        <td>$last, $first</td>
        <td>$birth</td>
        <td>$phone</td>
    </tr>";
    }
    print"</table>";
    $result->free_result();
    $db->close();

?>
  <br>
  <a href="login.html">logout</a>
</main>
</body>
</div>
</html>
