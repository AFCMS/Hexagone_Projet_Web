<?php require('./layout/header.php');

global $usersManager;

if ($_POST) {
    if ($_POST["name"] == "" || $_POST["password"] == "") {
        echo "Please fill all fields";
        return;
    }

    if (strlen($_POST["name"]) < 3) {
        echo "Username must be at least 3 characters long";
        return;
    }

    if (strlen($_POST["password"]) < 3) {
        echo "Password must be at least 3 characters long";
        return;
    }

    $_POST["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT);


    $user = $usersManager->readByName($_POST["name"]);
    if ($user !== false) {
        echo "This username is already taken";
        return;
    }

    $usersManager->create($_POST);

    $_SESSION["is_connected"] = $_POST["name"];

    echo "<script>window.location.href='index.php'</script>";
}

?>

    <h1>Register</h1>
    <form action="register.php" method="post" class="main-form">
        <label for="name">Username</label>
        <input type="text" name="name" id="name">

        <label for="password">Password</label>
        <input type="password" name="password" id="password">

        <button type="submit">Register</button>
        <button type="button"><a href="login.php">Se connecter</a></button>
    </form>

<?php require('./layout/footer.php'); ?>