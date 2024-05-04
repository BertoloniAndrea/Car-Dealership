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
    $admin_check = 0;

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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #333;
            margin: 0;
            padding: 0;
        }

        .registration-section {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .registration-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .submit-btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }

        .message-container {
            margin-top: 20px;
            padding: 10px;
            border-radius: 4px;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
        }

        .login-link {
            display: block;
            text-align: center;
            margin-top: 20px;
        }

        .login-link a {
            text-decoration: none;
            color: #007bff;
            padding: 10px 20px;
            background-color: #fff;
            border: 1px solid #007bff;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .login-link a:hover {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>

<body>
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