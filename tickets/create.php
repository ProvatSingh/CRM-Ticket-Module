<?php include "../header.php" ?>
<?php include "../config/db.php"; ?>

<?php 
$users = $conn->query("SELECT * FROM users");
$success = "";
$error = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ticketName = $_POST['ticket-name'];
    $ticketDescription = $_POST['ticket-description'];
    $createdBy = $_SESSION['user_id'];
    $ticketAssigneeArray = $_POST['ticket-assignee']; // array
    $ticketAssignee = implode(",", $ticketAssigneeArray); // convert to string
    $targetDir = "../uploads/";
    $fileName = basename($_FILES["fileToUpload"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $sql = "INSERT INTO tickets (name, description, file, created_by, assigned_to)
                VALUES ('$ticketName', '$ticketDescription', '$fileName', '$createdBy', '$ticketAssignee')";


    if ($conn->query($sql) === TRUE) {

        if (!empty($fileName)) {

            if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFilePath)) {
                $error = "Ticket created but file upload FAILED!";
            } else {
                $success = "Ticket created successfully!";
            }

        } else {
            $success = "Ticket created successfully!";
        }

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
                <h1>Create New Ticket</h1>
            </div>
            <div class="default-form ">
                <form action="create.php" method="POST" enctype="multipart/form-data">
                    <div class="input-wpr">
                        <label class="form-label">Ticket Name</label>
                        <input type="text" name="ticket-name" placeholder="Enter ticket name" required>
                    </div>

                    <div class="input-wpr">
                        <label class="form-label">Description</label>
                        <textarea name="ticket-description" rows="4" placeholder="Enter ticket description"
                            required></textarea>
                    </div>

                    <div class="input-wpr file-upload-wpr"><label class="form-label">Attach File</label>
                        <input name="fileToUpload" class="file-upload-fld" type="file" >

                        <div class="file-upload-preview">
                            <img src="" alt="" id="blah">
                        </div>
                    </div>
                    <div class="input-wpr"> <label class="form-label">Assign To</label>

                        <select id="select-beast" name="ticket-assignee[]" autocomplete="off" required multiple>
                            <option value="" disabled selected>Select Assignee</option>
                            <?php 
                                if($users->num_rows>0){
                                    foreach($users as $user){
                                        echo "<option value='" .$user['id']."'>" .$user['name']."</option>";
                                    }
                                } 
                            ?>


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