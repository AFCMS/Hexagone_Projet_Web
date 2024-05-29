<?php require('./layout/header.php');

global $usersManager;

if ($_POST) {
    $_POST["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $usersManager->create($_POST);

    $_SESSION["is_connected"] = $_POST["name"];

    echo "<script>window.location.href='index.php'</script>";
}

?>

    <h1>Register</h1>
    <form action="register.php" method="post">
        <label for="name">Username</label>
        <input type="text" name="name" id="name">

        <label for="password">Password</label>
        <input type="password" name="password" id="password">

        <button type="submit">Register</button>
    </form>

    <a href="login.php">Se connecter</a>

<?php require('./layout/footer.php'); ?>