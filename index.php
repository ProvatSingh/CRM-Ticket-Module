<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php
include 'header.php';
?>
<?php include 'config/db.php';
    $userId=$_SESSION['user_id'];
    $created_Tickets = $conn->query("SELECT * FROM tickets WHERE created_by=$userId");
    $assignedTickets = $conn->query("SELECT * FROM tickets WHERE assigned_to=$userId OR FIND_IN_SET($userId, assigned_to)");
    
    $open_Tickets = $conn->query("SELECT * FROM tickets WHERE status='open' AND created_by=$userId");
    $pending_Tickets = $conn->query("SELECT * FROM tickets WHERE status='pending' AND created_by=$userId");
    $inprogress_Tickets = $conn->query("SELECT * FROM tickets WHERE status='inprogress' AND created_by=$userId");
    $completed_Tickets = $conn->query("SELECT * FROM tickets WHERE status='completed' AND created_by=$userId");
    $onhold_Tickets = $conn->query("SELECT * FROM tickets WHERE status='onhold' AND created_by=$userId");
// echo $pending_Tickets->num_rows;
?>
<div class="main-wrapper">

    <div class="container mb-5">
        <h2>Welcome to Ticket CRM</h2>
        <p>Hello, <?php echo $_SESSION["user_name"]?></p>
    </div>
    <div class="container mb-5">
        <div class="dashboard ">
            <div class="stat-box-wpr">
                <div class="stat-box">
                    <h3>Total Tickets</h3>
                    <p><?php echo $assignedTickets->num_rows + $created_Tickets->num_rows; ?></p>
                </div>
                <div class="stat-box">
                    <h3>Open</h3>
                    <p><?php echo  $open_Tickets->num_rows; ?></p>
                </div>
                <div class="stat-box">
                    <h3>Pendings</h3>
                    <p><?php echo  $pending_Tickets->num_rows; ?></p>
                </div>

                <div class="stat-box">
                    <h3>On Hold</h3>
                    <p><?php echo  $onhold_Tickets->num_rows; ?></p>
                </div>

                <div class="stat-box">
                    <h3>In Progress</h3>
                    <p><?php echo  $inprogress_Tickets->num_rows; ?></p>
                </div>

                <div class="stat-box">
                    <h3>Completed</h3>
                    <p><?php echo  $completed_Tickets->num_rows; ?></p>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include 'footer.php'; ?>