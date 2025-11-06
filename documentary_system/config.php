<?php
$host = "localhost";
$user = "root"; // default XAMPP username
$pass = "";     // leave empty unless you set one
$dbname = "documentary";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("❌ Database connection failed: " . $conn->connect_error);
}
?>
