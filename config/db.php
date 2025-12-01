<?php 
$host = "sql210.infinityfree.com";    // check actual host from InfinityFree
$user = "if0_40542199";               // database username
$pass = "U9cCy84YMxw1";           // database password
$dbname   = "if0_40542199_crm_ticket_db";


$conn = new mysqli($host,$user,$pass,$dbname);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

?>