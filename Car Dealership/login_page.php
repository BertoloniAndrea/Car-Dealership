<?php

session_start();

$connection = new mysqli("localhost", "root", "", "db_concessionaria");

if ($connection -> connect_error) {
    die("Connection failed: " . $connection -> connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login_submit'])) {
    $nome_account = $_POST['login_username'];
    $password = $_POST['login_password'];

    $query_check = "SELECT password FROM account WHERE nome_account='$nome_account'";
    $result = $connection -> query($query_check);

    if ($result -> num_rows == 1) {
        $row = $result->fetch_assoc();
        $stored_password = $row['password'];

        if (password_verify($password, $stored_password)) {
            header("Location: main_page.php");
            exit();
        } else {
            $login_error = "Credenziali non valide";
        }
    } else {
        $login_error = "Credenziali non valide";
    }
    $connection->close();
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login_page_style.css">
</head>

<body>
    <section class="login-section">
        <div class="login-form">
            <form class="form-login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <fieldset>
                    <div class="input-group">
                        <label for="login_username">Nome Account</label>
                        <input id="login_username" name="login_username" type="text" required>
                    </div>
                    <div class="input-group">
                        <label for="login_password">Password</label>
                        <input id="login_password" name="login_password" type="password" required>
                    </div>
                </fieldset>
                <button type="submit" name="login_submit" class="login-btn">Login</button>
                <div class="register-link">
                    <a href="register_page.php">Register</a>
                </div>
            </form>
            <?php if (!empty($login_error)) { ?>
                <div class="message-container error-message"><?php echo $login_error; ?></div>
            <?php } ?>
        </div>
    </section>
</body>

</html>
