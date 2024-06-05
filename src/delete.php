<?php require('./layout/header.php');

global $projectsManager;

if (!$_SESSION && !$_SESSION['is_connected']) {
    echo "<script>window.location.href='login.php'</script>";
}

if ($_POST) {
    $project = $projectsManager->get($_POST['id']);
    if ($project->getUserName() === $_SESSION['is_connected']) {
        $projectsManager->delete($project->getId());
        $file = $project->getIconUrl();
        if (file_exists($file)) {
            unlink($file);
        }
        echo "<script>window.location.href='index.php'</script>";
    } else {
        echo "You can't delete this project" . "<br>";
        echo "It has been created by " . $project->getUserName();
    }
} else {
    echo "<script>window.location.href='index.php'</script>";
}