<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <script src="js/allscript.js"></script>
    <style>
        html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
        body{
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
    </style>
</head>
<body id="login-body">
<div class="login-container">
        <span class="user-login-logo"><i class="fa fa-user-circle"></i></span>
        <h2>Login</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="login-form">
            <p>
                <input class="w3-input" type="text" name="username" id="username" placeholder="Username" required>
            </p>
            <p>
                <input class="w3-input" type="password" name="password" id="password" placeholder="Password" required>
            </p>
            <button class="w3-btn w3-green w3-block" type="button">Login</button><br><br>
        </form>
        <a href="forgotpassword.php" class="forgot-password">Forgot Password?</a>

        <?php
        // Database connection
        $conn = "database/conn.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $error_message = ""; 

            
            $stmt = $mysqli->prepare("SELECT password FROM admin_tb WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                $stmt->bind_result($hashed_password_from_db);
                $stmt->fetch();

                // Verify password
                if (password_verify($password, $hashed_password_from_db)) {
                    
                    header("Location: index.php");
                    exit();
                } else {
                    $error_message = "Invalid username or password";
                }
            } else {
                $error_message = "Invalid username or password";
            }

            $stmt->close();
        }

        // Display error message if login fails
        if (!empty($error_message)) {
            echo "<p class='error-message'>$error_message</p>";
        }
        ?>
    </div>
</body>
</html>