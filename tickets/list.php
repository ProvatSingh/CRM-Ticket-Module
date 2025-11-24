<?php include "../header.php" ?>
<?php include "../config/db.php"; ?>

<?php
$tickets = $conn->query("SELECT * FROM tickets");
$tickets = $conn->query("SELECT * FROM tickets");

?>

<div class="main-wrapper">
    <section>
        <div class="container">
            <h1 class="mb-5">Ticket List</h1>

            <div class="table-responsive">
                <table class="table">
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

                        <?php foreach ($tickets as $ticket): ?>
                            <tr>
                                <td><?php echo $ticket["id"]; ?></td>
                                <td><?php echo $ticket["name"]; ?></td>
                                <td><?php echo $ticket["description"]; ?></td>
                                <td><?php echo ucfirst($ticket["status"]); ?></td>
                                <td><?php echo $ticket["created_by"]; ?></td>
                                <td><?php echo $ticket["created_at"]; ?></td>
                                <td><?php echo $ticket["assigned_to"]; ?></td>
                                <td>
                                    <a href="view.php?id=<?php echo $ticket['id']; ?>">View</a> |
                                    <a href="edit.php?id=<?php echo $ticket['id']; ?>">Edit</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<?php include "../footer.php" ?>
