<?php session_start();
    if(isset($_SESSION['user_id'])){
        header("location: /CRM-Ticket-Module/index.php");
        exit;
    };
?>
<?php $message =""; include "../config/db.php"; ?>


<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $_POST["user-name"];
    $user_email = $_POST["user-email"];
    $user_password = password_hash($_POST["user-password"], PASSWORD_DEFAULT);
    $exist_email = $conn->query("SELECT * FROM users where email='$user_email'");
    if ($exist_email->num_rows > 0) {
        echo "Email already exist";
    } else {
        $insert_user = "INSERT INTO users (name, email, password)
        VALUES('$user_name','$user_email','$user_password')";

        if ($conn->query($insert_user)) {
            $_SESSION['user_id'] = $conn->insert_id;
            $_SESSION['user_name'] = $user_name;
            $message = true;
            header("location: /CRM-Ticket-Module/index.php");

        } else {
            echo $conn->error;
             $message = false;
        }
    }
} ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>CRM Ticket Module</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="/CRM-Ticket-Module/assets/css/main.css" />
</head>

<body>
    <section class="py-5 d-flex align-items-center h-100">
        <div class="container">
            <div class="auth-form-wpr">
                <div class="sec-head">
                    <div class="logo text-center mb-5">CRM Ticket Module</div>
                </div>

                <div class="default-form register-form">
                    <h3 class="text-center">Register</h3>
                    <form style="" action="register.php" method="POST">
                        <div class="input-wpr">
                            <label>Name</label>
                            <input type="text" name="user-name" required />
                        </div>
                        <div class="input-wpr">
                            <label>Email</label>
                            <input type="email" name="user-email" required />
                        </div>
                        <div class="input-wpr">
                            <label>Password</label>
                            <input type="password" name="user-password" required />
                        </div>
                        
                        <div class="submit-wpr">
                            <button class="btn w-100" type="submit">Register</button>
                        </div>
                    </form>

                    <?php if(!empty($message)) {
                        echo $message ?  "<div class='alert alert-danger'>sucess</div>" :   "<div class='alert alert-danger'>danger</div>"
                    ; } ?>
                    
                </div>
                 <div class="register-link text-center mt-4">
                    <p>Already have an account? <a href="login.php">Login Here</a></p>
                </div>
            </div>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>