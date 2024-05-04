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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #333;
            margin: 0;
            padding: 0;
        }

        .login-section {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-form {
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

        .login-btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        .login-btn:hover {
            background-color: #0056b3;
        }

        .message-container {
            margin-top: 20px;
            padding: 10px;
            border-radius: 4px;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
        }

        .register-link {
            display: block;
            text-align: center;
            margin-top: 20px;
        }

        .register-link a {
            text-decoration: none;
            color: #007bff;
            padding: 10px 20px;
            background-color: #fff;
            border: 1px solid #007bff;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .register-link a:hover {
            background-color: #007bff;
            color: #fff;
        }
    </style>
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
