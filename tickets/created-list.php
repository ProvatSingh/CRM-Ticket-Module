<?php include "../header.php" ?>
<?php include "../config/db.php"; ?>

<?php
$userId=$_SESSION['user_id'];
$myCrTickets = $conn->query("SELECT * FROM tickets WHERE created_by=$userId");
$myAsnTickets = $conn->query("SELECT * FROM tickets WHERE FIND_IN_SET($userId, assigned_to)");
$tickets=[];

// Fetch created tickets start
if($myCrTickets->num_rows > 0){
    while($items = $myCrTickets->fetch_assoc()){
        $tickets[]=$items;
    };
};
// Fetch created tickets end

// Delete function start
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM tickets WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully.";
        header("Location: created-list.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
}
// Delete function end


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
                           	 echo implode(", ", $names); ?></td>
                        <td>
                            <div class="table-action">
                                <div class="table-action-btn view-ticket" data-id="<?= $ticket['id']; ?>"
                                    data-name="<?= $ticket['name']; ?>"
                                    data-description="<?= $ticket['description']; ?>"
                                    data-status="<?= $ticket['status']; ?>" data-file="<?= $ticket['file']; ?>"
                                    data-created-by="<?= $_SESSION['user_name'] ?>"
                                    data-assigned="<?=  implode(", ", $names); ?>"
                                    data-created="<?= $ticket['created_at']; ?>"
                                    data-updated="<?= $ticket['updated_at']; ?>"
                                    data-completed="<?= $ticket['completed_at']; ?>"
                                    data-deleted="<?= $ticket['deleted_at']; ?>" data-bs-toggle="offcanvas"
                                    data-bs-target="#edit-created-ticket" aria-controls="edit-created-ticket">
                                    View
                                </div> |
                                <a href="edit.php?id=<?= $ticket['id']; ?> " class="table-action-btn">Edit</a>|
                                <form  method="POST"
                                    onsubmit="return confirm('Are You Sure To Delete <?= $ticket['id']; ?> ?');">
                                    <input type="hidden" name="id" value="<?= $ticket['id'] ?>">
                                    <button class="table-action-btn" type="submit" name="delete">Delete</button>
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
<?php include "../footer.php" ?>

