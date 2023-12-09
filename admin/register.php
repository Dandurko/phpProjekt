<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="../css/adminLog.css">
</head>

<body>
<div id="message-container">
        <?php
        // Skontrolujte, či je v URL parameter status
        if (isset($_GET['status']) && $_GET['status'] == 0) {
            echo '<p id="error-message">The name is already taken. Please choose another.</p>';
        }
        ?>
    </div>
<div class="login-container">
    <div class="login">
        <h1>Register</h1>
        <form method="post" action="register_logic.php">
            <input minlength="4" type="text" name="username" placeholder="Username" required="required" />
            <input minlength="4" type="password" name="password" placeholder="Password" required="required" />
            <button type="submit" name="register" value="Prihlasit" class="btn btn-primary btn-block btn-large">Let me in.</button>
        </form>
        <a class="tlacidlo" href="/phpProjekt/2098_health/admin/login.php">Login</a>
    </div>
    </div>
        
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var errorMessage = document.getElementById('error-message');

            if (errorMessage) {
                setTimeout(function() {
                    errorMessage.style.display = 'none';
                }, 3000);
            }
        });
    </script>
</body>

</html>
