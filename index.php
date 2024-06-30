<?php
include("database.php");
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
            <form action="index.php" method="post">
                <div class="mb-3 mt-3 mw-100">
                    <label for="text" class="form-label">Username:</label>
                    <input type="text" class="form-control" name="username">
                </div>
                <div class="mb-3">
                    <label for="pwd" class="form-label">Password:</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="d-flex flex-column justify-content-lg-center ">
                    <input type="submit" class="btn btn-primary" name="login" value="Login">
                    <p class="d-flex justify-content-center m-3">Don't have a account?</p>
                    <button class="btn btn-link"><a href="register.php">Create a account</a></button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>

<?php
if (isset($_POST["login"])) {
    try {
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        if (!empty($_POST["password"])) {
            //Searching only for one result, because the user is unique.
            $sql = "SELECT * FROM users WHERE user = '{$username}'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $checkPass = password_verify($_POST["password"], $row["password"]);
                if ($checkPass) {
                    echo "Welcome {$username}!";
                } else {
                    echo "Wrong password!";
                }
            }
            mysqli_close($conn);
        } else {
            echo "Password is empty!";
            mysqli_close($conn);
        }
    } catch (mysqli_sql_exception) {
        echo "Not user founded";
        mysqli_close($conn);
    }
}


?>