<?php require('./layout/header.php');

global $db;
global $projectsManager;
global $projectsReviewManager;

if (!$_SESSION && !$_SESSION['is_connected']) {
    echo "<script>window.location.href='login.php'</script>";
    return;
}

if ($_POST) {

    $review = $projectsReviewManager->get($_POST['review_id']);

    if ($review->getUserName() !== $_SESSION['is_connected']) {
        echo "You can't edit this review" . "<br>";
        echo "It has been created by " . $review->getUserName();
        return;
    }

    $projectsReviewManager->update([
        'id' => $_POST['review_id'],
        'note' => $_POST['note'],
        'text' => $_POST['text']
    ]);

    echo "<script>window.location.href='project.php?project_id=" . $review->getProjectId() . "'</script>";
    return;
}

if (!$_GET["review_id"] || !is_numeric($_GET["review_id"])) {
    echo "<script>window.location.href='index.php'</script>";
    return;
}

$review = $projectsReviewManager->get($_GET["review_id"]);

if ($review->getUserName() !== $_SESSION['is_connected']) {
    echo "You can't edit this review" . "<br>";
    echo "It has been created by " . $review->getUserName();
    return;
}

?>

    <div class="main-container">
        <form action="update_review.php" method="post" enctype="multipart/form-data"
              class="main-form projects-container">
            <h1>Edit review</h1>

            <input type="hidden" name="review_id" value="<?php echo $review->getId(); ?>">

            <label for="note">Note</label>
            <input type="number" name="note" id="note" max="5" min="0" required
                   value="<?php echo $review->getNote(); ?>">

            <label for="text">Content</label>
            <textarea name="text" id="text" cols="30" rows="10" required><?php echo $review->getText(); ?></textarea>

            <input type="submit" value="Edit review" class="bouton">
        </form>
    </div>

<?php require('./layout/footer.php'); ?>