<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/adminLog.css">
</head>

<body>
    <div id="message-container">
        <?php
        // Skontrolujte, či je v URL parameter status
        if (isset($_GET['status']) && $_GET['status'] == 0) {
            echo '<p id="error-message">Nesprávne prihlasovacie údaje. Skúste to znova.</p>';
        }
        if (isset($_GET['status']) && $_GET['status'] == 1) {
            echo '<p id="success-message">Uspesna Registracia!</p>';
        }
        ?>
    </div>
    <div class="login">
        <h1>Login</h1>
        <form method="post" action="login_logic.php">
            <input type="text" name="username" placeholder="Username" required="required" />
            <input type="password" name="password" placeholder="Password" required="required" />
            <button type="submit" name="login" value="Prihlasit" class="btn btn-primary btn-block btn-large">Let me in.</button>
        </form>
        <a class="tlacidlo" href="/phpProjekt/2098_health/admin/register.php">Register</a>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let errorMessage = document.getElementById('error-message');
            let successMessage = document.getElementById('success-message');
            if (errorMessage) {
                setTimeout(function() {
                    errorMessage.style.display = 'none';
                }, 3000);
            }
            if (successMessage) {
                setTimeout(function() {
                    successMessage.style.display = 'none';
                }, 3000);
            }
        });
    </script>

</body>

</html>