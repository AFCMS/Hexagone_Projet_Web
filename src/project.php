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
$avgText = ($avg == null ? 'Pas encore de note' : starsHTML($avg));

$reviews = $projectsReviewManager->getForProject($project_id);
?>

    <div class="main-container">
        <div class="projects-container">
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
                    <button type="button"><a href="update.php?project_id=<?php echo $project_id ?>">Modifier</a>
                        <?php endif; ?>
                        <?php if ($_SESSION && $_SESSION["is_connected"]) :
                            $review = $projectsReviewManager->getUserReview($_SESSION["is_connected"], $project_id)
                            ?>
                            <?php if ($review) : ?>
                            <button type="button">
                                <a href="update_review.php?review_id=<?php echo $review->getId() ?>">Edit review</a>
                            </button>
                            <form action="delete_review.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $review->getId() ?>">
                                <button type="submit">Delete review</button>
                            </form>
                        <?php else: ?>
                            <button type="button"><a
                                    href="create_review.php?project_id=<?php echo $project_id ?>">Review</a>
                            </button>
                        <?php endif; ?>
                        <?php else : ?>
                            <button type="button"><a href="login.php">Review</a></button>
                        <?php endif; ?>
                </div>
            </div>
            <div class="project" style="gap: 2rem">
                <?php foreach ($reviews as $review) : ?>
                    <div class="review"
                         style="border-bottom-color: gray; border-bottom-style: dashed; padding-bottom: 1rem">
                        <div class="review-header" style="margin-bottom: 1rem; position: relative">
                            <span><strong><?php echo $review->getUserName() ?></strong></span>
                            <span
                                style="flex: 1; position: absolute; right: 0; top: 0"><?php echo starsHTML($review->getNote()) ?></span>
                        </div>
                        <p><?php echo $review->getText() ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php require("./layout/footer.php"); ?>