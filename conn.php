<?php
$servername = "localhost";
$username="root";
$password="";
$dbname="students";

$conn = mysqli_connect("localhost", "root", "", "students");

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>