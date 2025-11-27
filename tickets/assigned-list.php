<?php include "../header.php" ?>
<?php include "../config/db.php"; ?>

<?php
$userId=$_SESSION['user_id'];
$myCrTickets = $conn->query("SELECT * FROM tickets WHERE created_by=$userId");
$myAsnTickets = $conn->query("SELECT * FROM tickets WHERE FIND_IN_SET($userId, assigned_to)");
// $users = $conn->query("SELECT * FROM users WHERE id=$userId");
$tickets=[];

if($myCrTickets->num_rows > 0){
    while($items = $myCrTickets->fetch_assoc()){
        $tickets[]=$items;
    };
};

// if($users->num_rows > 0){
//     $userRow = $users->fetch_assoc();
// }

// assign names to assigned tickets
foreach ($myAsnTickets as $ticket) {
 $assigneIds = explode(",", $ticket["assigned_to"]);  
    $assignedNames = [];

    foreach ($assigneIds as $id) {
        $result = $conn->query("SELECT name FROM users WHERE id = $id");

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $assignedNames[] = $row["name"];
        }
    }
}

// If update button pressed
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $row = $conn->query("UPDATE tickets SET status='$status' WHERE id=$id");
    header("Location: assigned-list.php");
}

foreach ($myAsnTickets as $ticket) {
 $assigneIds = explode(",", $ticket["assigned_to"]);  
    $assignedNames = [];

    foreach ($assigneIds as $id) {
        $result = $conn->query("SELECT name FROM users WHERE id = $id");

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $assignedNames[] = $row["name"];
        }
    }}

?>


<div class="main-wrapper">
    <section class="ticket-list-sec pt-0">
        <div class="container">
            <table class="table my-assigned-tk responsive nowrap">
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
                    <?php foreach ($myAsnTickets as $ticket) { ?>
                    <tr>
                        <td><?= $ticket["id"]; ?></td>
                        <td><?= $ticket["name"]; ?></td>
                        <td><?= $ticket["description"]; ?></td>
                        <td><select id="status_<?= $ticket['id'] ?>" required>
                                <option <?= $ticket['status']=="open"?'selected':'' ?>>Open</option>
                                <option <?= $ticket['status']=="pending"?'selected':'' ?>>pending</option>
                                <option <?= $ticket['status']=="inprogress"?'selected':'' ?>>inprogress</option>
                                <option <?= $ticket['status']=="completed"?'selected':'' ?>>completed</option>
                                <option <?= $ticket['status']=="onhold"?'selected':'' ?>>onhold</option>
                            </select></td>
                        <td><?= $_SESSION['user_name']; ?></td>
                        <td><?= $ticket["created_at"]; ?></td>
                        <td><?php echo implode(", ", $assignedNames);?></td>
                        <td>
                            <div class="table-action">

                                <div class="table-action-btn view-ticket" data-id="<?= $ticket['id']; ?>"
                                    data-name="<?= $ticket['name']; ?>"
                                    data-description="<?= $ticket['description']; ?>"
                                    data-status="<?= $ticket['status']; ?>" data-file="<?= $ticket['file']; ?>"
                                    data-created-by="<?= $_SESSION['user_name'] ?>"
                                    data-assigned="<?=  implode(", ",  $assignedNames); ?>"
                                    data-created="<?= $ticket['created_at']; ?>"
                                    data-updated="<?= $ticket['updated_at']; ?>"
                                    data-completed="<?= $ticket['completed_at']; ?>"
                                    data-deleted="<?= $ticket['deleted_at']; ?>" data-bs-toggle="offcanvas"
                                    data-bs-target="#edit-created-ticket" aria-controls="edit-created-ticket">
                                    View
                                </div> |
                                <form method="POST"
                                    onsubmit="setStatusValue(<?= $ticket['id'] ?>); return confirm('Are you sure you want to update?');">
                                    <input type="hidden" name="id" value="<?= $ticket['id'] ?>">
                                    <input type="hidden" name="status" id="hidden_status_<?= $ticket['id'] ?>">
                                    <button type="submit" name="update" class="table-action-btn">Update</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</div>


<script>
function setStatusValue(id) {
    let selected = document.getElementById('status_' + id).value;
    document.getElementById('hidden_status_' + id).value = selected;
}
</script>
<?php include "../footer.php" ?>