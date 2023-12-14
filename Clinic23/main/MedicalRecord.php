<!-- Created by: Josh -->
<!-- Modified: 12/14/23-->


<!DOCTYPE html>
<html lang="en">
<head>
    
    <title> Northern Psychiatric Services </title>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
	
<title>
    Medical Record
</title>
    
</head>
    
<body>
<div class=vitals>
<form method="post" action="MedicalRecord.php">
    
<!--Vitals section-->    
<h1>Vitals</h1>
    
<!--<table class="vitals">-->
    <table>
    <tr>
        <th>Date/Time</th>
        <th>Temp</th>
        <th>BP</th>
        <th>Pulse</th>
        <th>Height</th>
        <th>Weight</th>
        <th>BMI</th>
        <th>O2 Sat</th>
    </tr>
    <tr>
        <td><input type="datetime-local" name="datetime"></td>
        <td><input type="text" name="temp" size="5"> </td>
        <td><input type="text" name="bp_systolic" size="2">/<input type="text" name="bp_diastolic" size="2"></td>
        <td><input type="text" name="pulse" size="5"></td>
        <td><input type="text" name="height" size="5"></td>
        <td><input type="text" name="weight" size="5"></td>
        <td><input type="text" name="bmi" size="5"></td>
        <td><input type="text" name="o2" size="5"></td>
    </tr>
</table>

    <input id="submit" type="submit" value="Submit Vitals" onclick="confirmSubmission()">
</form>

<?php
    //DB info
    $host = "lemuria.cis.vermontstate.edu";
    $dbname = "medical_server";
    $user = "cis4250";
    $password = "blibber";

    //populate fields
    $datetime = $_POST['datetime'];
    $temp = $_POST['temp'];
    $bp_systolic = $_POST['bp_systolic'];
    $bp_diastolic = $_POST['bp_diastolic'];
    $pulse = $_POST['pulse'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $bmi = $_POST['bmi'];
    $o2 = $_POST['o2'];

    //Open connection
    $dbconn = pg_connect("host=$host dbname=$dbname user=$user password=$password");

    if (!$dbconn){
        echo "Error connecting to database: " . pg_last_error();
        exit;}
    //else {echo "Success!";}

    //insert into table
    $sql = "INSERT INTO system_overview (date_time, temp, bp_systolic, bp_diastolic, pulse, height, weight, bmi, o2) 
    VALUES ('$datetime', '$temp', '$bp_systolic', '$bp_diastolic', '$pulse', '$height', '$weight', '$bmi', '$o2')";

    pg_close($dbconn);
?>

</div>
    
    
<!--Record of services form-->
<form method="post" action="MedicalRecordROS.php"><!--implementing separate php for this form-->
<div class = assessmentPracticioner>    
<label for="practicioner">Practicioner:</label>
  <select name="practicioner">
    <option value=""></option>
    <option value="tookey">Tookey</option>
    <option value="hibbert">Hibbert</option>
    <option value="zoidberg">Zoidberg</option>
    <option value="strange">Strange</option>
  </select>
    </div>    
<div class=rostables style="overflow-x:auto;"><!--div for responsive tables-->
<!--Record of Service fields sourced from '22 final project-->    
<div class=recordtable>
<!--Nose/sinus-->    
<h1>Nose/Sinus</h1>
<table>
    <tr>
        <td><label>Nose Bleeds</label>
            <input type="checkbox" name="ros[]" value="nosebleed"></td>
        <td><label>Stuffiness</label>
            <input type="checkbox" name="ros[]" value="stuffiness"></td>
        <td><label>Frequent Colds</label>
            <input type="checkbox" name="ros[]" value="frequentcolds"></td>
        <td><label>Asthma</label>
            <input type="checkbox" name="ros[]" value="asthma"></td>
    </tr>
</table>
    </div> 
 
<div class=recordtable>
<!--Hearing-->    
<h1>Ears</h1>
  <table>
    <tr>
        <td><label>Hearing</label>
            <input type="checkbox" name="ros[]" value="hearing"></td>
        <td><label>Ear Pain</label>
            <input type="checkbox" name="ros[]" value="earpain"></td>
        <td><label>Ear Discharge</label>
            <input type="checkbox" name="ros[]" value="eardischarge"></td>
        <td><label>Ringing</label>
            <input type="checkbox" name="ros[]" value="ringing"></td>
        <td><label>Dizziness</label>
            <input type="checkbox" name="ros[]" value="dizziness"></td>
    </tr>
</table>  
    </div>

<div class=recordtable>
<!--Vision-->    
<h1>Eyes</h1>
<table>
    <tr>
        <td><label>Glasses</label>
            <input type="checkbox" name="ros[]" value="glasses"></td>
        <td><label>Change in Vision</label>
            <input type="checkbox" name="ros[]" value="changeinvision"></td>
        <td><label>Eye Pain</label>
            <input type="checkbox" name="ros[]" value="eyepain"></td>
        <td><label>Double Vision</label>
            <input type="checkbox" name="ros[]" value="doublevision"></td>
        <td><label>Light Flashes</label>
            <input type="checkbox" name="ros[]" value="lightflashes"></td>
        <td><label>Glaucoma</label>
            <input type="checkbox" name="ros[]" value="glaucoma"></td>
    </tr>
    <tr>
        <td>
        <div class=examdate>    
<label>Exam Date</label>
<input type="date" name="ros[]">
            </div>
        </td>
    </tr>
</table>
</div>    

    
    
</div>
<div class=recordtable>
<!--Allergies-->    
<h1>Allergies</h1>
  <table>
    <tr>
        <td><label>Hives</label>
            <input type="checkbox" name="ros[]" value="hives"></td>
        <td><label>Hay Fever</label>
            <input type="checkbox" name="ros[]" value="hayfever"></td>
        <td><label>Eczema</label>
            <input type="checkbox" name="ros[]" value="eczema"></td>
        <td><label>Lip or Tongue Swelling</label>
            <input type="checkbox" name="ros[]" value="LTswelling"></td>
        <td><label>Food/Drug/Pollen sensitivity</label>
            <input type="checkbox" name="ros[]" value="FDPsensitivity"></td>
    </tr>
</table>  
</div>

    

<div class=recordtable>
<!--Psychiatric-->    
<h1>Psychiatric</h1>
  <table>
    <tr>
        <td><label>Anxiety</label>
            <input type="checkbox" name="ros[]" value="anxiety"></td>
        <td><label>Memory</label>
            <input type="checkbox" name="ros[]" value="memory"></td>
        <td><label>sleep issues</label>
            <input type="checkbox" name="ros[]" value="sleepissues"></td>
        <td><label>Mood</label>
            <input type="checkbox" name="ros[]" value="mood"></td>
        <td><label>Depression</label>
            <input type="checkbox" name="ros[]" value="depression"></td>
        <td><label>Unusual Problem</label>
            <input type="checkbox" name="ros[]" value="unusualproblem"></td>
    </tr>
</table>  
</div>    

    
<div class=recordtable>
<!--Mouth-->    
<h1>Mouth</h1>
  <table>
    <tr>
        <td><label>Bleeding Gums</label>
            <input type="checkbox" name="ros[]" value="bleedinggums"></td>
        <td><label>Sore Tongue</label>
            <input type="checkbox" name="ros[]" value="soretongue"></td>
        <td><label>Sore Throat</label>
            <input type="checkbox" name="ros[]" value="sorethroat"></td>
        <td><label>Hoarseness</label>
            <input type="checkbox" name="ros[]" value="hoarseness"></td>
        </tr>
</table>  
</div>  
    
    
<div class=recordtable>
<!--Neck-->    
<h1>Neck</h1>
  <table>
    <tr>
        <td><label>Lumps</label>
            <input type="checkbox" name="ros[]" value="necklumps"></td>
        <td><label>Goiter</label>
            <input type="checkbox" name="ros[]" value="goiter"></td>
        <td><label>Swollen Glands</label>
            <input type="checkbox" name="ros[]" value="swollenglands"></td>
        <td><label>Neck Stiffness</label>
            <input type="checkbox" name="ros[]" value="neckstiffness"></td>
        </tr>
</table>  
</div> 
    
    
<div class=recordtable>
<!--Breasts-->    
<h1>Breasts</h1>
  <table>
    <tr>
        <td><label>Lumps</label>
            <input type="checkbox" name="ros[]" value="breastlumps"></td>
        <td><label>Breast Pain</label>
            <input type="checkbox" name="ros[]" value="breastpain"></td>
        <td><label>Nipple Discharge</label>
            <input type="checkbox" name="ros[]" value="nippledischarge"></td>
        <td><label>Self Exam</label>
            <input type="checkbox" name="ros[]" value="selfexam"></td>
        </tr>
</table>  
</div>  
    
    
    
 <div class=recordtable>
<!--Circulation-->    
<h1>Circulation</h1>
  <table>
    <tr>
        <td><label>Leg Cramps</label>
            <input type="checkbox" name="ros[]" value="legcramps"></td>
        <td><label>Varicose Veins</label>
            <input type="checkbox" name="ros[]" value="varicoseveins"></td>
        <td><label>Blood Clots</label>
            <input type="checkbox" name="ros[]" value="bloodclots"></td>
        <td><label>Muscle Pain</label>
            <input type="checkbox" name="ros[]" value="musclepain"></td>
        <td><label>Muscle Swelling</label>
            <input type="checkbox" name="ros[]" value="muscleswelling"></td>
        <td><label>Muscle Stiffness</label>
            <input type="checkbox" name="ros[]" value="musclestiffness"></td>
    </tr>
    <tr>
        <td><label>Joint Motion</label>
            <input type="checkbox" name="ros[]" value="jointmotion"></td>
        <td><label>Broken Bone</label>
            <input type="checkbox" name="ros[]" value="brokenbone"></td>
        <td><label>Sprains</label>
            <input type="checkbox" name="ros[]" value="sprains"></td>
        <td><label>arthritis</label>
            <input type="checkbox" name="ros[]" value="arthritis"></td>
        <td><label>Gout</label>
            <input type="checkbox" name="ros[]" value="Gout"></td>
    </tr>
</table>  
</div>  
    
    
<div class=recordtable>
<!--Neurological-->    
<h1>Neurological</h1>
  <table>
    <tr>
        <td><label>Seizures</label>
            <input type="checkbox" name="ros[]" value="seizures"></td>
        <td><label>Fainting</label>
            <input type="checkbox" name="ros[]" value="fainting"></td>
        <td><label>Paralysis</label>
            <input type="checkbox" name="ros[]" value="paralysis"></td>
        <td><label>Weakness</label>
            <input type="checkbox" name="ros[]" value="weakness"></td>
        <td><label>Muscle Size</label>
            <input type="checkbox" name="ros[]" value="musclesize"></td>
        <td><label>Muscle Spasm</label>
            <input type="checkbox" name="ros[]" value="musclespasm"></td>
    </tr>
    <tr>
        <td><label>Tremor</label>
            <input type="checkbox" name="ros[]" value="tremor"></td>
        <td><label>Involuntary Movement</label>
            <input type="checkbox" name="ros[]" value="involuntarymovement"></td>
        <td><label>Incoordination</label>
            <input type="checkbox" name="ros[]" value="incoordination"></td>
        <td><label>Numbness</label>
            <input type="checkbox" name="ros[]" value="numbness"></td>
        <td><label>Pin or Needle Sensation</label>
            <input type="checkbox" name="ros[]" value="pinsandneedles"></td>
    </tr>
</table>  
</div>
    
    
<div class=recordtable>
<!--Endocrine-->    
<h1>Endocrine</h1>
  <table>
    <tr>
        <td><label>Growth</label>
            <input type="checkbox" name="ros[]" value="growth"></td>
        <td><label>Appetite</label>
            <input type="checkbox" name="ros[]" value="appetite"></td>
        <td><label>Thirst</label>
            <input type="checkbox" name="ros[]" value="thirst"></td>
        <td><label>Thyroid</label>
            <input type="checkbox" name="ros[]" value="thyroid"></td>
        <td><label>Sweating</label>
            <input type="checkbox" name="ros[]" value="sweating"></td>
        <td><label>Increased Urination</label>
            <input type="checkbox" name="ros[]" value="increasedurination"></td>
    </tr>
    <tr>
        <td><label>Diabetes</label>
            <input type="checkbox" name="ros[]" value="diabetes"></td>
    </tr>
</table>  
</div>
    
    
<div class=recordtable>
<!--Digestive-->    
<h1>Digestive</h1>
  <table>
    <tr>
        <td><label>Swallowing</label>
            <input type="checkbox" name="ros[]" value="swallowing"></td>
        <td><label>Nausea</label>
            <input type="checkbox" name="ros[]" value="nausea"></td>
        <td><label>Heartburn</label>
            <input type="checkbox" name="ros[]" value="heartburn"></td>
        <td><label>Vomiting</label>
            <input type="checkbox" name="ros[]" value="vomiting"></td>
        <td><label>Vomiting Blood</label>
            <input type="checkbox" name="ros[]" value="vomitingblood"></td>
        <td><label>Constipation</label>
            <input type="checkbox" name="ros[]" value="constipation"></td>
    </tr>
    <tr>
        <td><label>Diarrhea</label>
            <input type="checkbox" name="ros[]" value="Diarrhea"></td>
        <td><label>Bowels</label>
            <input type="checkbox" name="ros[]" value="bowels"></td>
        <td><label>Abdominal Pain</label>
            <input type="checkbox" name="ros[]" value="abdominalpain"></td>
        <td><label>Burping</label>
            <input type="checkbox" name="ros[]" value="burping"></td>
        <td><label>Farting</label>
            <input type="checkbox" name="ros[]" value="farting"></td>
        <td><label>Yellow Skin</label>
            <input type="checkbox" name="ros[]" value="yellowskin"></td>
    </tr>
    <tr>
        <td><label>Food Intolerance</label>
            <input type="checkbox" name="ros[]" value="foodintolerance"></td>
        <td><label>Rectal Bleeding</label>
            <input type="checkbox" name="ros[]" value="rectalbleeding"></td>
        <td><label>Urination</label>
            <input type="checkbox" name="ros[]" value="urination"></td>
        <td><label>Urination Pain</label>
            <input type="checkbox" name="ros[]" value="urinationpain"></td>
        <td><label>Frequent Urination</label>
            <input type="checkbox" name="ros[]" value="frequenturination"></td>
        <td><label>Urgent Urination</label>
            <input type="checkbox" name="ros[]" value="urgenturination"></td>
      </tr>
      <tr>
        <td><label>Incotinence</label>
            <input type="checkbox" name="ros[]" value="incotinence"></td>
          <td><label>Dribble</label>
            <input type="checkbox" name="ros[]" value="dribble"></td>
      </tr>
</table>  
</div>   
    
    
<div class=recordtable>
<!--Cardio/Respriatory-->    
<h1>Cardiovascular/Respriatory</h1>
  <table>
    <tr>
        <td><label>Shortness of Breath</label>
            <input type="checkbox" name="ros[]" value="seizures"></td>
        <td><label>Cough</label>
            <input type="checkbox" name="ros[]" value="fainting"></td>
        <td><label>Phlegm</label>
            <input type="checkbox" name="ros[]" value="paralysis"></td>
        <td><label>Wheezing</label>
            <input type="checkbox" name="ros[]" value="weakness"></td>
        <td><label>Bloody Cough</label>
            <input type="checkbox" name="ros[]" value="musclesize"></td>
        <td><label>Chest Pain</label>
            <input type="checkbox" name="ros[]" value="musclespasm"></td>
    </tr>
    <tr>
        <td><label>Fever</label>
            <input type="checkbox" name="ros[]" value="tremor"></td>
        <td><label>Night Sweats</label>
            <input type="checkbox" name="ros[]" value="involuntarymovement"></td>
        <td><label>Swollen Hands</label>
            <input type="checkbox" name="ros[]" value="incoordination"></td>
        <td><label>Blue Toes</label>
            <input type="checkbox" name="ros[]" value="numbness"></td>
        <td><label>Hypertension</label>
            <input type="checkbox" name="ros[]" value="pinsandneedles"></td>
        <td><label>Irregular Heartbeat</label>
            <input type="checkbox" name="ros[]" value="pinsandneedles"></td>
    </tr>
    <tr>
        <td><label>Heart Murmur</label>
            <input type="checkbox" name="ros[]" value="tremor"></td>
        <td><label>Rheumatic Fever</label>
            <input type="checkbox" name="ros[]" value="involuntarymovement"></td>
        <td><label>Bronchitis</label>
            <input type="checkbox" name="ros[]" value="incoordination"></td>
        <td><label>Heart Medication</label>
            <input type="checkbox" name="ros[]" value="numbness"></td>
    </tr>
</table>  
</div>

    
<div class=recordtable>
<!--Hematologic-->    
<h1>Hematologic</h1>
  <table>
    <tr>
        <td><label>Anemia</label>
            <input type="checkbox" name="ros[]" value="anemia"></td>
        <td><label>Easy Brusing</label>
            <input type="checkbox" name="ros[]" value="easybrusing"></td>
        <td><label>Transfusion</label>
            <input type="checkbox" name="ros[]" value="transfusion"></td>
        </tr>
</table>  
</div>      


<div class=recordtable>    
<!--Comments-->    
<h1>Comments</h1>
    <textarea name="ros[]" rows="4" cols="50"></textarea><br>
    
    
<!--Form submission-->    
<input id="submit" type="submit" value="Submit Assessment"onclick="confirmSubmission()">
    
</div> 
<!--end record of services form-->    
</form>

<script>
function confirmSubmission() {
  alert("Submission Successful");
}
</script>
</body>
</html>
