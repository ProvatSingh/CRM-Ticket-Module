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
                            <td><?= $ticket["status"]; ?></td>
                            <td><?= $_SESSION['user_name']; ?></td>
                            <td><?= $ticket["created_at"]; ?></td>
                            <td>
                                <?php
                                    $assigneIds = explode(",", $ticket["assigned_to"]);  
                                    $names = [];

                                    foreach ($assigneIds as $id) {
                                        $result = $conn->query("SELECT name FROM users WHERE id = $id");

                                        if ($result && $result->num_rows > 0) {
                                            $row = $result->fetch_assoc();
                                            $names[] = $row["name"];
                                        }
                                    }

                                    echo implode(", ", $names);
                                ?>
                            </td>

                            <td>
                                <a href="view.php?id=<?= $ticket['id']; ?>">View</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
        </div>
    </section>
</div>

<?php include "../footer.php" ?>