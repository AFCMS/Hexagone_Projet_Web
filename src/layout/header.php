<?php /** @noinspection PhpIncludeInspection */

require_once 'managers/ProjectsManager.php';
require_once 'managers/ProjectsReviewManager.php';
require_once 'managers/UsersManager.php';
require_once 'models/Project.php';
require_once 'models/ProjectReview.php';
require_once 'models/User.php';

$dbname = 'app_db';
$dbuser = 'db_user';
$dbpass = 'db_user_pass';
$db = null;

try {
    $db = new PDO("mysql:host=mysql;dbname=$dbname", $dbuser, $dbpass);
} catch (PDOException $error) {
    echo $error->getMessage();
}

$usersManager = new managers\UsersManager($db);
$projectsManager = new managers\ProjectsManager($db);
$projectsReviewManager = new managers\ProjectsReviewManager($db);
session_start();

?>


<!doctype html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/main.css">
</head>
<body>
<header style="display: flex; align-items: start; justify-content: center; padding-left: 2rem">
    <nav style="align-items: start">
        <ul>
            <li class="bouton"><a href="/index.php">Home</a></li>
            <li class="bouton"><a href="/create.php">Add project</a></li>
            <?php if (isset($_SESSION['is_connected'])): ?>
                <li class="bouton"><a href="/logout.php">Logout</a></li>
            <?php else: ?>
                <li class="bouton"><a href="/login.php">Login</a></li>
                <li class="bouton"><a href="/register.php">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
