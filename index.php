

<?php
include 'header.php';
?>

<div class="main-wrapper">

        <div class="container mb-5">
            <h2>Welcome to Ticket CRM</h2>
            <p>Hello, <?php echo $_SESSION["user_name"]?></p>
        </div>
        <div class="container mb-5">
            <div class="dashboard d-flex ">
                <div class="box border rounded-3 px-4 py-4">
                    <h3>Total Tickets</h3>
                    <p>12</p>
                </div>

                <div class="box border rounded-3 px-4 py-4">
                    <h3>Pending</h3>
                    <p>5</p>
                </div>

                <div class="box border rounded-3 px-4 py-4">
                    <h3>In Progress</h3>
                    <p>4</p>
                </div>

                <div class="box border rounded-3 px-4 py-4">
                    <h3>Completed</h3>
                    <p>3</p>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="quick-links">
                <a href="tickets/create.php" class="btn">+ Create Ticket</a>
                <a href="tickets/list.php" class="btn">View Tickets</a>
            </div>
        </div>

    </body>

    </html>



</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>