<!doctype html>
<html>
    <head>
        <title>Web Clinic</title>
        <link rel="stylesheet" href="styles.css"/>
    </head>
    <body>
        <div class="fl">
            <h1 class="patient">Patient Lastname</h1> <h1 class="doctor"><strong>&ndash;</strong>Dr. Doe</h1>
            <hr>
            <br>
            <!-- add form to add medications to medication form -->
            <div class="ordermed">
                <form method="post" action="workorder.php">
                    <label for="mname"><strong>Medication Name</strong><br></label>
                    <select name="mname" id="mname"> <!-- medicine table -->
<?php
$dbh = pg_connect("host=lemuria dbname=medical_server user=cis4150 password=blibber");
if(!$dbh){
    echo "<p>Error: Database could not connect.</p>";
    exit;
}
session_start();
$bnames = pg_exec($dbh, "SELECT medicine_name FROM medicine;");
$gnames = pg_exec($dbh, "SELECT generic_name FROM medicine;");
$mnames = [];
for($i=0;$i<count($bnames);$i++){
    array_push($mnames,($bnames[$i] . " (" . $gnames[$i] . ")"));
}
for($i=0;$i<count($mnames);$i++){
    $s=strtolower($bnames[$i]);
    $ss=$mnames[$i];
    echo("<option value='{$s}'>{$ss}</option>");
}
pg_close($dbh);
?>
                    </select>
                    <br> <!-- medicine_order table -->
                    <label for="mquantity"><strong>Dose (mg)</strong><br></label>
                    <input type="number" id="mquantity" name="mquantity" min="0" max="30" value="0">
                    <br>
                    <label for="msub"><strong>Stop use by</strong><br></label>
                    <input type="date" id="msub" name="msub">
                    <br>
                    <label for="mte"><strong>Take every</strong><br></label>
                    <input type="text" id="mte" name="mte" required>
                    <br>
                    <label for="mrefills"><strong>Refill quantity</strong><br></label>
                    <select name="mrefills" id="mrefills">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="unlimited">Unlimited</option>
                    </select>
                    <br>
                    <br>
                    <!-- form should mutate medication list on being submitted -->
                    <input type="submit" value="Submit">
<?php
function msubmit() {
$dbh = pg_connect("host=lemuria dbname=medical_server user=cis4150 password=blibber");
if(!$dbh){
    echo "<p>Error: Database could not connect.</p>";
    exit;
}

$mrefills=$_POST["mrefills"];
$mte=$_POST["mte"];
$mquantity=$_POST["mquantity"];
$msub=$_POST["msub"];
$mname=$_POST["mname"];

pg_exec($dbh,"INSERT INTO medicine_order (refills,take_every,dosage,stop_by,patientid,medicine_name,practitionerid) VALUES({$mrefills},{$mte},{$mquantity},{$msub},0,{$mname},0);");
session_start();
pg_close($dbh);
}
if(isset($_POST['mname'])) {
    msubmit();
}
?>
                </form>
            </div>
            <br>
            <div class="medications">
                <table>
                    <tr>
                        <th>Brand (Generic)</th>
                        <th>Dose</th>
                        <th>Stop use by</th>
                        <th>Take every</th>
                        <th>Refills</th>
                        <th>Pharmacy location</th>
                    </tr>
<?php
$dbh = pg_connect("host=lemuria dbname=medical_server user=cis4150 password=blibber");
if(!$dbh){
    echo "<p>Error: Database could not connect.</p>";
    exit;
}
session_start();
$bnames = pg_exec($dbh, "SELECT medicine_name FROM medicine;");
$gnames = pg_exec($dbh, "SELECT generic_name FROM medicine;");
$mnames = [];
$dosages = pg_exec($dbh, "SELECT dosage FROM medicine;");
$takeeverys = pg_exec($dbh, "SELECT take_every FROM medicine;");
$stopbys = pg_exec($dbh, "SELECT stop_by FROM medicine;");
$refills = pg_exec($dbh, "SELECT refills FROM medicine;");
for($i=0;$i<count($bnames);$i++){
    array_push($mnames,($bnames[$i] . " (" . $gnames[$i] . ")"));
}
for($i=0;$i<count($mnames);$i++){
    $s=$mnames[$i];
    $d=$dosages[$i] . "mg";
    $te=$takeeverys[$i];
    $sb=$stopbys[$i];
    $rf=$refills[$i];
    echo("<tr>");
    echo("<td>" . $s . "</td>");
    echo("<td>" . $d . "</td>");
    echo("<td>" . $sb . "</td>");
    echo("<td>" . $te . "</td>");
    echo("<td>" . $rf . "</td>");
    echo("<td>NA</td>");
    echo("</tr>");
}
pg_close($dbh);
?>
                </table>
            </div>
            <br><hr><br>
            <div class="orderlab">
                <form method="post" action="workorder.php">
                    <label for="lname"><strong>Lab</strong><br></label>
                    <select name="lname" id="lname"> <!-- lab table -->
<?php
$dbh = pg_connect("host=lemuria dbname=medical_server user=cis4150 password=blibber");
if(!$dbh){
    echo "<p>Error: Database could not connect.</p>";
    exit;
}
session_start();
$labnames = pg_exec($dbh, "SELECT lab FROM lab;");
for($i=0;$i<count($labnames);$i++){
    $s=$labnames[$i];
    echo("<option value='{$s}'>{$s}</option>");
}
pg_close($dbh);
?>
                    </select><br> <!-- recomended_labs table -->
                    <label for="lenqueue"><strong>Date requested</strong><br></label>
                    <input type="date" id="lenqueue" name="lenqueue">
                    <br>
                    <label for="lnotes"><strong>Lab notes</strong><br></label>
                    <input type="text" id="lnotes" name="lnotes">
                    <br><br>
                    <!-- form should mutate medication list on being submitted -->
                    <input type="submit" value="Submit">
<?php
function lsubmit() {
$dbh = pg_connect("host=lemuria dbname=medical_server user=cis4150 password=blibber");
if(!$dbh){
    echo "<p>Error: Database could not connect.</p>";
    exit;
}

$lenqueue=$_POST["lenqueue"];
$lnotes=$_POST["lnotes"];
$lname=$_POST["lname"];

pg_exec($dbh,"INSERT INTO recomended_labs (lab,patientid,date_recommend,notes) VALUES({$lname},0,{$lenqueue},{$lnotes});");
session_start();
pg_close($dbh);
}
if(isset($_POST['lname'])) {
    lsubmit();
}
?>
                </form>
            </div>
            <br>
            <div class="labs">
                <table>
                    <tr>
                        <th>Labs (past 30 days)</th>
                        <th>Enqueued</th>
                        <th>Lab notes</th>
                    </tr>
<?php
$dbh = pg_connect("host=lemuria dbname=medical_server user=cis4150 password=blibber");
if(!$dbh){
    echo "<p>Error: Database could not connect.</p>";
    exit;
}
session_start();
$labnames = pg_exec($dbh, "SELECT lab FROM recomended_labs;");
$dates = pg_exec($dbh, "SELECT date_recommend FROM recomended_labs;");
$notes = pg_exec($dbh, "SELECT notes FROM recomended_labs;");
for($i=0;$i<count($mnames);$i++){
    $s=$labnames[$i];
    $d=$dates[$i];
    $n=$notes[$i];
    echo("<tr>");
    echo("<td>" . $s . "</td>");
    echo("<td>" . $d . "</td>");
    echo("<td>" . $n . "</td>");
    echo("</tr>");
}
pg_close($dbh);
?>
                </table>
            </div>
            <br><hr><br>
            <div class="ordertests">
                <form method="post" action="workorder.php">
                    <label for="tname"><strong>Test</strong><br></label>
                    <select name="tname" id="tname"> <!-- test table -->
<?php
$dbh = pg_connect("host=lemuria dbname=medical_server user=cis4150 password=blibber");
if(!$dbh){
    echo "<p>Error: Database could not connect.</p>";
    exit;
}
session_start();
$testnames = pg_exec($dbh, "SELECT test FROM test;");
for($i=0;$i<count($testnames);$i++){
    $s=$testnames[$i];
    echo("<option value='{$s}'>{$s}</option>");
}
pg_close($dbh);
?>
                    </select><br> <!-- recomended_tests table -->
                    <label for="tenqueue"><strong>Date requested</strong><br></label>
                    <input type="date" id="tenqueue" name="tenqueue">
                    <br>
                    <label for="tnotes"><strong>Test notes</strong><br></label>
                    <input type="text" id="tnotes" name="tnotes">
                    <br><br>
                    <!-- form should mutate test list on being submitted -->
                    <input type="submit" value="Submit">
<?php
function tsubmit() {
$dbh = pg_connect("host=lemuria dbname=medical_server user=cis4150 password=blibber");
if(!$dbh){
    echo "<p>Error: Database could not connect.</p>";
    exit;
}

$tenqueue=$_POST["tenqueue"];
$tnotes=$_POST["tnotes"];
$tname=$_POST["tname"];

pg_exec($dbh,"INSERT INTO recomended_tests (test,patientid,date_recommend,notes) VALUES({$tname},0,{$tenqueue},{$tnotes});");
session_start();
pg_close($dbh);
}
if(isset($_POST['tname'])) {
    tsubmit();
}
?>
                </form>
            </div>
            <br>
            <div class="tests">
                <table>
                    <tr>
                        <th>Tests (past 30 days)</th>
                        <th>Enqueued</th>
                        <th>Test notes</th>
                    </tr>
<?php
$dbh = pg_connect("host=lemuria dbname=medical_server user=cis4150 password=blibber");
if(!$dbh){
    echo "<p>Error: Database could not connect.</p>";
    exit;
}
session_start();
$testnames = pg_exec($dbh, "SELECT test FROM recomended_tests;");
$dates = pg_exec($dbh, "SELECT date_recommend FROM recomended_tests;");
$notes = pg_exec($dbh, "SELECT notes FROM recomended_tests;");
for($i=0;$i<count($testnames);$i++){
    $s=$labnames[$i];
    $d=$dates[$i];
    $n=$notes[$i];
    echo("<tr>");
    echo("<td>" . $s . "</td>");
    echo("<td>" . $d . "</td>");
    echo("<td>" . $n . "</td>");
    echo("</tr>");
}
pg_close($dbh);
?>
                </table>
            </div>
            <br><hr><br>
            <div class="orderprocs">
                <form method="post" action="workorder.php">
                    <label for="pname"><strong>Procedure</strong><br></label>
                    <select name="pname" id="pname"> <!-- proceduree table -->
<?php
$dbh = pg_connect("host=lemuria dbname=medical_server user=cis4150 password=blibber");
if(!$dbh){
    echo "<p>Error: Database could not connect.</p>";
    exit;
}
session_start();
$pnames = pg_exec($dbh, "SELECT proceduree FROM proceduree;");
for($i=0;$i<count($pnames);$i++){
    $s=$pnames[$i];
    echo("<option value='{$s}'>{$s}</option>");
}
pg_close($dbh);
?>
                    </select><br> <!-- recomended_procedures table -->
                    <label for="penqueue"><strong>Date requested</strong><br></label>
                    <input type="date" id="penqueue" name="penqueue">
                    <br>
                    <label for="pnotes"><strong>Notes for procedure</strong><br></label>
                    <input type="text" id="pnotes" name="pnotes">
                    <br><br>
                    <!-- form should mutate test list on being submitted -->
                    <input type="submit" value="Submit">
<?php
function psubmit() {
$dbh = pg_connect("host=lemuria dbname=medical_server user=cis4150 password=blibber");
if(!$dbh){
    echo "<p>Error: Database could not connect.</p>";
    exit;
}

$penqueue=$_POST["penqueue"];
$pnotes=$_POST["pnotes"];
$pname=$_POST["pname"];

pg_exec($dbh,"INSERT INTO recomended_procedures (proceduree,patientid,date_recommend,notes) VALUES({$pname},0,{$penqueue},{$pnotes});");
session_start();
pg_close($dbh);
}
if(isset($_POST['pname'])) {
    psubmit();
}
?>
                </form>
            </div>
            <br>
            <div class="procedures">
                <table>
                    <tr>
                        <th>Procedures (past 30 days)</th>
                        <th>Enqueued</th>
                        <th>Doctor&apos;s notes</th>
                    </tr>
<?php
$dbh = pg_connect("host=lemuria dbname=medical_server user=cis4150 password=blibber");
if(!$dbh){
    echo "<p>Error: Database could not connect.</p>";
    exit;
}
session_start();
$pnames = pg_exec($dbh, "SELECT proceduree FROM recomended_procedures;");
$dates = pg_exec($dbh, "SELECT date_recommend FROM recomended_procedures;");
$notes = pg_exec($dbh, "SELECT notes FROM recomended_procedures;");
for($i=0;$i<count($pnames);$i++){
    $s=$pnames[$i];
    $d=$dates[$i];
    $n=$notes[$i];
    echo("<tr>");
    echo("<td>" . $s . "</td>");
    echo("<td>" . $d . "</td>");
    echo("<td>" . $n . "</td>");
    echo("</tr>");
}
pg_close($dbh);
?>
                </table>
            </div>
        </div>
    </body>
</html>
