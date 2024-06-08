<?php require('./layout/header.php');

global $projectsReviewManager;

if (!$_SESSION && !$_SESSION['is_connected']) {
    echo "<script>window.location.href='login.php'</script>";
}

if ($_POST) {
    $review = $projectsReviewManager->get($_POST['id']);
    if (!$review) {
        // echo "<script>window.location.href='index.php'</script>";
        echo "Review not found";
        return;
    }
    if ($review->getUserName() === $_SESSION['is_connected']) {
        $projectsReviewManager->delete($review->getId());

        echo "<script>window.location.href='project.php?project_id=" . $review->getProjectId() . "'</script>";
    } else {
        echo "You can't delete this project" . "<br>";
        echo "It has been created by " . $review->getUserName();
    }
} else {
    echo "<script>window.location.href='index.php'</script>";
}