<?php require('./layout/header.php');
global $projectsManager;
global $projectsReviewManager;
?>
<?php

$project_id = $_GET["project_id"];

if (!$project_id || !is_numeric($project_id)) {
    echo "<script>window.location.href='index.php'</script>";
    return;
}

$project = $projectsManager->get($project_id);

if (!$project) {
    echo "<script>window.location.href='index.php'</script>";
    return;
}

$avg = $projectsReviewManager->getAvgForProject($project_id);
$avgText = ($avg == null ? 'Pas encore de note' : $avg);

$reviews = $projectsReviewManager->getForProject($project_id);
?>

    <div class="project">
        <div class="project-header">
            <img class="projet-image" src="<?php echo $project->getIconUrl() ?>" alt="Icone du projet">
            <h2><?php echo $project->getName() ?></h2>
            <span><?php echo $avgText ?></span>
        </div>
        <p><?php echo $project->getDescription() ?></p>
        <div class="project-actions">
            <?php if ($_SESSION && $_SESSION["is_connected"] && $_SESSION["is_connected"] == $project->getUserName()) : ?>
                <form action="delete.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $project_id ?>">
                    <button type="submit">Supprimer</button>
                </form>
            <?php endif; ?>
            <?php if ($_SESSION && $_SESSION["is_connected"]) : ?>
                <button type="button"><a href="create_review.php?project_id=<?php echo $project_id ?>">Review</a>
                </button>
            <?php else : ?>
                <button type="button"><a href="login.php">Review</a></button>
            <?php endif; ?>
        </div>
    </div>

<?php require("./layout/footer.php"); ?>