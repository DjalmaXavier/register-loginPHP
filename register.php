<?php

include("database.php");
$nofill = false;
$usernameCheck = false;
$passwordCheck = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["login"])) {
    try {
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $pass = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

        if (!empty($_POST["password"]) || !empty($_POST["username"])) {
            $check = checkUser($conn, $username);
            if (!$check) {
                $pass = password_hash($pass, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (user, password) VALUES ('{$username}', '{$pass}')";
                mysqli_query($conn, $sql);
                mysqli_close($conn);
                echo "Registered!";
            } else {
                $usernameCheck = true;
            }
        } else {
            $nofill = true;
        }
    } catch (mysqli_sql_exception) {
        echo "User not registred";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>My Mail</title>
</head>

<body>
    <div class="d-flex flex-column justify-content-center">
        <div class="container-fluid p-5 bg-dark text-white text-center">
            <h1>Inbox Master</h1>
            <h3>Send and receive e-mails</h3>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        </div>
        <div class="p-5 d-flex justify-content-center">
            <form action="register.php" method="post">
                <div class="mb-3 mt-3">
                    <label for="text" class="form-label">Username:</label>
                    <input type="text" class="form-control" name="username">
                    <?php if ($usernameCheck) : ?>
                        <p class="text-danger d-flex justify-content-center">User already exists</p>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="pwd" class="form-label">Password:</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="d-flex flex-column justify-content-lg-center ">
                    <input type="submit" class="btn btn-primary" name="login" value="Register">
                    <?php if ($nofill) : ?>
                        <p class="text-danger d-flex justify-content-center">Fill both labels to continue</p>
                    <?php endif; ?>
                    <p class="d-flex justify-content-center m-3">Already have a account?</p>
                    <button class="btn btn-link"><a href="index.php">Back to login</a></button>
                </div>
            </form>
        </div>
    </div>

</body>



</html>