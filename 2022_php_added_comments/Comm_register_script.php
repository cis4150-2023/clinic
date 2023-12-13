<?php
//This file is to register an account with the webpage
include_once "dbConnection.php";
include_once 'testinput.php';
//test code that scares me
//echo("We are in the fun zone");
//sets variables from a form on the website
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$uname = $_POST['uname'];
$title = $_POST['title'];
$phone = $_POST['phone'];
$email = $_POST['email'];
//this may be a way to differentiate different types of users
$permlevel = '3';
$password=$_POST['password'];
//inserts the data given into the database
$query = <<<INSERTUSER
INSERT INTO Users (user_name, permission, job_title, phone, email, first_name, last_name, pwd) 
VALUES ("$uname", "$permlevel", "$title", "$phone", "$email", "$fname", "$lname", "$password");
INSERTUSER;
//checks if the query can go through or not, determines whether a user was created or not
if($conn->query($query) === TRUE){
    echo("User successfully created");
} else {
    echo("The data was not inserted into the database correctly. Please contact an administrator.");
}
?>