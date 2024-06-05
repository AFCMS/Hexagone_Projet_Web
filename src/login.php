<?php require('./layout/header.php');
if (isset($_POST['name']) && isset($_POST['password'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];

    global $usersManager;

    $user = $usersManager->readByName($name);

    if ($user && password_verify($_POST['password'], $user->getPassword())) {
        $_SESSION['is_connected'] = $_POST['name'];
    }

    echo "<script>window.location.href='index.php'</script>";
}
?>

    <h1>Login</h1>

    <form action="login.php" method="post" class="main-form">
        <label for="name">Username</label>
        <input type="text" name="name" id="name">

        <label for="password">Password</label>
        <input type="password" name="password" id="password">

        <button type="submit">Login</button>
        <button type="button"><a href="register.php">Créer un compte utilisateur</a></button>
    </form>

<?php
require('./layout/footer.php');