<?php include "../header.php" ?>
<?php include "../config/db.php"; ?>

<?php 
$users = $conn->query("SELECT * FROM users");



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


    if ($conn->query($sql) === TRUE ) {
        if (empty($_FILES["fileToUpload"]["name"])){
            echo "Ticket Created Successfully";
        }elseif(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFilePath)) {
            echo "Ticket Created Successfully";
        } else {
            echo "File upload failed!";
        }
        echo $ticketAssignee;
    } else {
        echo "Database Error: " . $conn->error;
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

                    <div class="input-wpr"><label class="form-label">Attach File</label>
                        <input name="fileToUpload" id="fileToUpload" type="file">
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
    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Toggle right offcanvas</button>

<div class="offcanvas  offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Offcanvas right</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        ...
    </div>

     <div class="offcanvas-footer">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
</div>
<?php include "../footer.php" ?>