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

    <div class="main-container">
        <form action="login.php" method="post" class="main-form projects-container">
            <h1>Login</h1>

            <label for="name">Username</label>
            <input type="text" name="name" id="name">

            <label for="password">Password</label>
            <input type="password" name="password" id="password">

            <button type="submit">Login</button>
            <button type="button"><a href="register.php">Créer un compte utilisateur</a></button>
        </form>
    </div>

<?php require('./layout/footer.php');