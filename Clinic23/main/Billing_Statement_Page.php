<!DOCTYPE html>
<html>
	<main>
		<html>
		<link rel="stylesheet" href="style.css">
		</html>
		<body>
			<div>
			<h1>Billing Statement</h1>
			<form action="Billing Statement Display.html" method="post">
				<label>Statement Made:
				<input type="date" name ="submit_date"></label><br>
				<label>Account Number:
				<input type="number" name="pid"></label><br>
				<label>Service Date:
				<input type="date" name="sd"></label><br>
				<label>Was Standard or Emergency Care Provided?<br>
				<select id="caretype" onChange="careTypeEffect()" name="ct"> 
					<option selected>Please Choose One</option>
					<option value="standard">Standard</option>
					<option value="emergency">Emergency</option>
				</select></label><br>
				<label>Service Provided:
				<input type="radio" id="Visit" name="service" value="Visit"><label>Visit</label>
				<input type="radio" id="Procedure" name="service" value="Procedure"><label>Procedure</label>
				<input type="radio" id="Test" name="service" value="Test"><label>Test</label>
				</label><br>
				<label>Total Charge: $
				<input type ="number" min= "0.00" step="0.01" name = "tc"></label><br>
				<label>Does patient have insurance?</label>
				<button id="yesInsurance" onclick="formShow()">Yes</button> 
				<button id="noInsurance" onclick="formHide()">No</button><br>
				<div id="copayForm" style="display:none;">
					<label>Copay: $
					<input id="copayInput" type ="number" min= "0.00" step="0.01" name = "copay"></label><br>
				</div>
				<div id="deductibleForm" style="display:none;">
					<label>Deductible: $
					<input id="deductibleInput" type ="number" min= "0.00" step="0.01" name = "deductible"></label><br>
				</div>
				<label>Insurance Payment: $
				<input type ="number" min= "0.00" step="0.01" name = "ip"></label><br>
				</div>
				<label>Patient's Payments So Far: $
				<input type ="number" min= "0.00" step="0.01" name = "ppsf"></label><br>
				<label>Balance Due: $
				<input type ="number" min= "0.00" step="0.01" name = "bd"></label><br>
				<label>Payment Due:
				<input type="date" name = "pd"></label><br>
				<p>Payment can be done with Cash, Credit, or Check. </p><br>
				<br>
				<p> Customer Service Contact: <br>
				&ensp; Jasmine Doe <br>
				&ensp; 000-000-0000 <br>
				&ensp; Monday-Friday: 9:00 AM to 4:00 PM </p><br>
				<br>
				<input type="submit" id="submitbutton"></input>
			</form>
			<?php
			//sets the insert values
			$patientid = $_POST['pid'] ?? 0;
			$statement_made = $_POST['submit_date'] ?? 0;
			$service_date = $_POST['sd'] ?? 0;
			$service_type = $_POST['ct'] ?? 0;
			$service_provided = $_POST['service'] ?? 0;
			$total_charge = $_POST['tc'] ?? 0;
			$deductable = $_POST['deductible'] ?? 0;
			$copay = $_POST['scopay'] ?? 0;
			$insurance = $_POST['ip'] ?? 0;
			$patient_payment = $_POST['ppsf'] ?? 0;
			$due_date = $_POST['pd'] ?? 0;

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
			$query = "insert into payment (patientid, statement_made, service_made, service_provided, total_charge, deductable, copay, insurance_payment, patient_payment, due_date) values 
			($patientid, $statement_made, $service_date, $service_type, $service_provided, 
			$total_charge, $deductable, $copay, $insurance, $patient_payment, $due_date)";
			$query->execute();
			$db->close();
			//$query = "insert into payment values (null,?,?,?,?,?,?,?,?,?,?,?)";
			//$stmt = $conn->prepare($query);
			//$stmt-> bind_param("i");
		    ?>	
	  		</div>
		<script type="text/javascript">
		var insurForm = document.getElementById("insuranceForm");
		var yesButton = document.getElementById("yesInsurance");
		var noButton = document.getElementById("noInsurance");
		var careType = document.getElementById("caretype");
		var copay = document.getElementById("copayForm");
		var deductible = document.getElementById("deductibleForm");
		
		
		function formHide ()  {
				insurForm.style.display = "none";
				noButton.disabled = true;
				yesButton.disabled = false;
			} 
		function formShow () {
				insurForm.style.display = "block";
				noButton.disabled = false;
				yesButton.disabled = true;
			}
		function careTypeEffect () {
			if (careType.value == "standard") {
				copay.style.display = "block";
				deductible.style.display = "none";
			}
			else if (careType.value == "emergency") {
				deductible.style.display = "block";
				copay.style.display = "none";
			} else {
				copay.style.display = "none";
				deductible.style.display = "none";
			}
			
		}
			
		</script>
		</body>
	</main>
</html>