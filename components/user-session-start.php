<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: https://crm-ticket-module.fwh.is/auth/login.php");
    exit;
}
?>