<?php

include_once("../../require/config.php");
include_once("./functions.php");
include("../../base/head.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $query = "SELECT password FROM users WHERE username = :username";
    $statement = $conn->prepare($query);
    $statement->execute([':username' => $username]);
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    $found_password = $row['password'];
    if (password_verify($_POST['password'], $found_password)) {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $_SESSION['login_admin'] = $username;
        header("location: ./formlogs.php");
    } else {
        $error = "Gebruikersnaam of wachtwoord is onjuist";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Karel Bolbloemen B.V. - Login</title>
</head>

<body>
    <section id="login">
        <div class="container">
            <h1>Login</h1>
            <div class="container-form">
                <form id="form" method="post">
                    <input type="text" name="username" id="username" placeholder="Gebruikersnaam" required>
                    <input type="password" name="password" id="password" placeholder="Wachtwoord" required>
                    <input type="submit" id="form-submit" name="submit" value="Login">
                    <div class="mt-2">
                        <?php if ($error)
                            echo "<div class='alert alert-danger'>$error</div>"; ?>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>

</html>