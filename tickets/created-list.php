<?php include "../header.php" ?>
<?php include "../config/db.php"; ?>

<?php
$userId=$_SESSION['user_id'];
$myCrTickets = $conn->query("SELECT * FROM tickets WHERE created_by=$userId");
$myAsnTickets = $conn->query("SELECT * FROM tickets WHERE FIND_IN_SET($userId, assigned_to)");
$users = $conn->query("SELECT * FROM users WHERE id=$userId");
$tickets=[];

if($myCrTickets->num_rows > 0){
    while($items = $myCrTickets->fetch_assoc()){
        $tickets[]=$items;
    };
};

if($users->num_rows > 0){
    $userRow = $users->fetch_assoc();
}
?>


<div class="main-wrapper">
    <section class="ticket-list-sec pt-0">
        <div class="container">
            <table class="my-created-tk responsive nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Created by</th>
                        <th>Created At</th>
                        <th>Assigned To</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($tickets as $ticket) { ?>
                    <tr>
                        <td><?= $ticket["id"]; ?></td>
                        <td><?= $ticket["name"]; ?></td>
                        <td><?= $ticket["description"]; ?></td>
                        <td><?= $ticket["status"]; ?></td>
                        <td><?= $_SESSION['user_name']; ?></td>
                        <td><?= $ticket["created_at"]; ?></td>
                        <td><?php 
                                    $assigneIds = explode(",", $ticket["assigned_to"]);  
                                    $names = [];

                                    foreach ($assigneIds as $id) {
                                        $result = $conn->query("SELECT name FROM users WHERE id=$id");
                                        if ($result && $result->num_rows > 0) {
                                            $row = $result->fetch_assoc();
                                            $names[] = $row["name"];
                                        }
                                    }
                                    echo implode(", ", $names);
                                    ?></td>
                        <td class="table-action-links">
                            <a href="view.php?id=<?= $ticket['id']; ?>" data-bs-toggle="offcanvas"
                                data-bs-target="#edit-created-ticket" aria-controls="edit-created-ticket">View</a> |
                            <a href="edit.php?id=<?= $ticket['id']; ?>">Edit</a>|
                            <form action="delete.php" method="POST" onsubmit="return confirm('Delete this item?');">
                                <input type="hidden" name="id" value="<?= $ticket['id'] ?>">
                                <button class="my-created-tk-delt" type="submit" name="delete">Delete</button>
                            </form>
                        </td>

                    </tr>
                    <?php } ?>



                </tbody>
            </table>
        </div>
    </section>
</div>
<?php include "../footer.php" ?>

<!-- <div class="offcanvas  offcanvas-end" tabindex="-1" id="edit-created-ticket" aria-labelledby="edit-created-ticketLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="edit-created-ticketLabel">Tickets Id: <?= $ticket["id"]; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="default-form">
            <form action="create-list.php" method="POST" enctype="multipart/form-data">
                <div class="input-wpr">
                    <label class="form-label">Ticket Name</label>
                    <input type="text" value="<?= $ticket["name"]; ?>" name="ticket-name" value
                        placeholder="Enter ticket name" required>
                </div>

                <div class="input-wpr">
                    <label class="form-label">Description</label>
                    <textarea name="ticket-description" rows="4" placeholder="Enter ticket description"
                        required><?= $ticket["description"]; ?></textarea>
                </div>

                <div class="input-wpr"><label class="form-label">Attach File</label>
                    <input name="fileToUpload" value="" id="fileToUpload" type="file">
                </div>
                <div class="input-wpr"> <label class="form-label">Assign To</label>

                    <select id="select-beast" name="ticket-assignee[]" autocomplete="off" required multiple>
                        <option value="<?= $ticket["name"]; ?>" disabled selected><?= $ticket["name"]; ?></option>
                        <?php 
                                if($$myAsnTickets->num_rows>0){
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

    <div class="offcanvas-footer">
        <button type="button" class="btn" data-bs-dismiss="offcanvas" aria-label="Close">close</button>
    </div>
</div> -->