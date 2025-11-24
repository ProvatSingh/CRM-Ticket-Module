<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /CRM-Ticket-Module/auth/login.php");
    exit;
}
?>