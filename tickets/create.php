<?php include "../header.php" ?>
<?php include "../config/db.php"; ?>

<?php 
//  $result = $conn->query("SELECT * FROM tickets");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ticketName = $_POST['ticket-name'];
    $ticketDescription = $_POST['ticket-description'];
    $ticketStatus = $_POST['ticket-status'];
    $createdBy = $_SESSION['user_id'];
    $ticketAssignee = $_POST['ticket-Assignee'];
    $sql =  "INSERT INTO `tickets`(`name`, `description`, `status`, `file`, `created_by`, `assigned_to` ) 
    VALUES ('$ticketName',' $ticketDescription','$ticketStatus','[value-4]','$createdBy','$ticketAssignee')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error:  $conn->error";
    }
}

?>

<div class="main-wrapper">
    <section class="create-ticket-sec py-0">
        <div class="container">
            <div class="sec-head">
                <h1>Create New Ticket</h1>
            </div>
            <div class="default-form ">
                <form action="create.php" method="POST">
                    <div class="input-wpr">
                        <label class="form-label">Ticket Name</label>
                        <input type="text" name="ticket-name" class="form-control" placeholder="Enter ticket name"
                            required>
                    </div>

                    <div class="input-wpr">
                        <label class="form-label">Description</label>
                        <textarea name="ticket-description" class="form-control" rows="4"
                            placeholder="Enter ticket description" required></textarea>
                    </div>
                    <div class="input-wpr">
                        <label class="form-label">Status</label>
                        <select name="ticket-status" class="form-select" required>
                            <option value="pending">Pending</option>
                            <option value="inprogress">In Progress</option>
                            <option value="completed">Completed</option>
                            <option value="onhold">On Hold</option>
                        </select>
                    </div>
                    <div class="input-wpr"><label class="form-label">Attach File</label>
                        <input name="ticket-attachment" type="file" class="form-control">
                    </div>
                    <div class="input-wpr"> <label class="form-label">Assign To</label>
                        <select name="ticket-Assignee" class="form-select" required>
                            <option value="" disabled selected>Select Assignee</option>
                            <option>User 1</option>
                            <option>User 2</option>
                            <option>User 3</option>
                        </select>
                    </div>

                    <div class="submit-wpr">
                        <button type="submit" class="btn btn-primary">Create Ticket</button>
                    </div>
                </form>

            </div>
        </div>
    </section>
</div>
<?php include "../footer.php" ?>