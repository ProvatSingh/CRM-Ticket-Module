<?php include "../header.php" ?>
<?php include "../config/db.php"; 

$id =  $_GET['id'];
$users = $conn->query("SELECT * FROM users");
$ticket = $conn->query("SELECT * FROM tickets WHERE id=$id")->fetch_assoc();


// Security: Only author or assignee can edit
if ($ticket['created_by'] != $_SESSION['user_id']) {
    die("You are not allowed to edit this ticket");
}?>

<?php 
$assignedUsers = explode(",", $ticket['assigned_to']);

?>

<?php
$success = "";
$error = "";
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $status = $_POST['status'];
    $ticketAssigneeArray = $_POST['ticket-assignee']; 
    $assigned_to = implode(",", $ticketAssigneeArray); 

    // File upload
    $filePath = $ticket['file']; // old file

    if (!empty($_FILES['ticket_file']['name'])) {
        $filePath = "../uploads/" . time() . "_" . $_FILES['ticket_file']['name'];
        move_uploaded_file($_FILES['ticket_file']['tmp_name'], $filePath);
    }

    $query = "UPDATE tickets SET     
                name='$name',
                description='$desc',
                status='$status',
                assigned_to='$assigned_to',
                file='$filePath',
                updated_at=NOW()
                WHERE id=$id";

    if ($conn->query($query)) {
        echo "<script>alert('Updated!');</script>";
        $success = "Ticket Updated successfully!";
    } else {
        $error = "Database Error: " . $conn->error;
    }
}
?>

<div class="main-wrapper">
  <div class="notification-wpr">
        <?php if (!empty($success)): ?>
        <div class="alert alert-success alert-dismissible fade show " role="alert">
            <?= $success ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show " role="alert">
            <?= $error ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>
    </div>
    <section class="create-ticket-sec py-0">
        <div class="container">
            <div class="sec-head">
                <h1>Edit Ticket : <?= $id ?></h1>
            </div>
            <div class="default-form">
                <form method="POST" enctype="multipart/form-data">
                    <div class="input-wpr">

                        <label>Name</label>
                        <input type="text" name="name" value="<?= $ticket['name'] ?>" required>
                    </div>
                    <div class="input-wpr">

                        <label>Description</label>
                        <textarea name="description" required><?= $ticket['description'] ?></textarea>
                    </div>
                    <select name="status"  hidden>
                        <option <?= $ticket['status']=="open"?'selected':'' ?>>Open</option>
                        <option <?= $ticket['status']=="pending"?'selected':'' ?>>pending</option>
                        <option <?= $ticket['status']=="inprogress"?'selected':'' ?>>inprogress</option>
                        <option <?= $ticket['status']=="completed"?'selected':'' ?>>completed</option>
                        <option <?= $ticket['status']=="onhold"?'selected':'' ?>>onhold</option>
                    </select>
                    <div class="input-wpr">
                        <label class="form-label">Assign To</label>
                        <select id="select-beast" name="ticket-assignee[]" autocomplete="off" required multiple>
                            <option value="" disabled selected>Select Assignee</option>
                            <?php 
                                if($users->num_rows>0){
                                    foreach($users as $user){
                                        $selected = in_array($user['id'], $assignedUsers) ? "selected" : "";
                                        echo "<option  value='" .$user['id']."' ".$selected.">" .$user['name']."</option>";
                                    }
                                } 
                            ?>
                        </select>
                    </div>

                    <!-- <div class="input-wpr">
                        <label>File </label>
                        <input type="file"  value="c:/passwords.txt">
                    </div> -->

                    <div class="input-wpr file-upload-wpr"><label class="form-label">Attach File</label>
                        <input name="ticket_file" class="file-upload-fld" type="file" >

                        <div class="file-upload-preview">
                            <img src="" alt="" id="blah">
                        </div>
                    </div>
                    <div class="submit-wpr">
                        <button type="submit" class="btn" name="update">Update Ticket</button>
                    </div>

                </form>


            </div>
        </div>
    </section>


</div>
<?php include "../footer.php" ?>