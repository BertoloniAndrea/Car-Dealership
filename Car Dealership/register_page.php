<?php

$connection = new mysqli("localhost", "root", "", "db_concessionaria");

if ($connection -> connect_error) {
    die("Connection failed: " . $connection -> connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register_submit'])) {
    $nome_account = $_POST['register_nome_account'];
    $nome = $_POST['register_nome'];
    $cognome = $_POST['register_cognome'];
    $password = $_POST['register_password'];
    $confirm_password = $_POST['password_confirm'];
    $admin_check = false;

    if ($password != $confirm_password) {
        $signup_error = "Le password non corrispondono";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $insert_query = "INSERT INTO account (nome_account, nome, cognome, password, admin_check) VALUES (?, ?, ?, ?, ?)";

        $statement = $connection -> prepare($insert_query);

        if ($statement) {
            $statement -> bind_param("ssssi", $nome_account, $nome, $cognome, $hashedPassword, $admin_check);

            if ($statement -> execute()) {
                $success_message = "Utente registrato.";
                header("Location: login_page.php");
                exit();

            } else {
                $signup_error = "Errore avvenuto durante il processo di registrazione.";
            }

            $statement -> close();
        } else {
            $signup_error = "Errore avvenuto durante il processo di registrazione.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="register_page_style.css">
</head>

<body>
    <nav>
        <h1>Car Dealership</h1>
    </nav>
    <section class="registration-section">
        <form class="registration-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <fieldset>
                <div class="input-group">
                    <label for="register_nome_account">Username</label>
                    <input id="register_nome_account" name="register_nome_account" type="text" required>
                </div>

                <div class="input-group">
                    <label for="register_nome">Nome</label>
                    <input id="register_nome" name="register_nome" type="text" required>
                </div>

                <div class="input-group">
                    <label for="register_cognome">Cognome</label>
                    <input id="register_cognome" name="register_cognome" type="text" required>
                </div>

                <div class="input-group">
                    <label for="register_password">Password</label>
                    <input id="register_password" name="register_password" type="password" required>
                </div>

                <div class="input-group">
                    <label for="password_confirm">Confirm Password</label>
                    <input id="password_confirm" name="password_confirm" type="password" required>
                </div>
            </fieldset>

            <button type="submit" name="register_submit" class="submit-btn">Register</button>

            <div class="login-link">
                <a href="login_page.php">Login</a>
            </div>

        </form>
        <?php if (!empty($success_message)) { ?>
            <div class="message-container success-message"><?php echo $success_message; ?></div>
        <?php } ?>
        <?php if (!empty($signup_error)) { ?>
            <div class="message-container error-message"><?php echo $signup_error; ?></div>
        <?php } ?>
    </section>
</body>

</html>