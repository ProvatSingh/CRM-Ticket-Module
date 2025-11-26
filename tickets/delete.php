<?php include "../header.php" ?>;
<?php include "../config/db.php"?>; 
<?php
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
?>;

<?php include "../footer.php" ?>;
