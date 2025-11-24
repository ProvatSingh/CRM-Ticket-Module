<?php
session_start();
include "../config/db.php";


if($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_email = $_POST['user-email'];
    $user_password = $_POST['user-password'];
    $exist_email = $conn->query("SELECT * FROM users WHERE email='$user_email'");

    if($exist_email->num_rows > 0){
        $row = $exist_email->fetch_assoc();
        if(password_verify($user_password, $row['password'])){
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            header("Location: /CRM-Ticket-Module/index.php");
            exit;
        } else {
            $message = "Incorrect password";
        }
    } else {
        $message = "Email not found";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> CRM Ticket Module</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/CRM-Ticket-Module/assets/css/main.css">
</head>


<body>
    <section class="py-5 d-flex align-items-center h-100">
        <div class="container">
            <div class="auth-form-wpr">
                <div class="sec-head">
                    <div class="logo text-center mb-5">
                        CRM Ticket Module
                    </div>
                </div>

                <div class="default-form login-form">
                    <h3 class="text-center">Login</h3>
                    <form action="login.php" method="POST">
                        <div class="input-wpr">
                            <label>Email</label>
                            <input type="email" name="user-email" required>
                        </div>

                        <div class="input-wpr">
                            <label>Password</label>
                            <input type="password" name="user-password" required>
                        </div>

                        <div class="submit-wpr">
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </div>
                    </form>

                    <?php if(!empty($message)) {
                        echo "<div class='alert alert-danger'>$message</div>";
                    } ?>
                </div>

                <div class="register-link text-center mt-4">
                    <p>Don't have an account? <a href="register.php">Register here</a></p>
                </div>
            </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>