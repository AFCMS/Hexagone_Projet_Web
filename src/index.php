<?php require('./layout/header.php');
global $projectsManager;
global $projectsReviewManager;
?>
<?php
// Vérifie si l'utilisateur est connecté
if ($_SESSION && $_SESSION["is_connected"]) {
    $name = $_SESSION["is_connected"];
    echo "<div style='display: flex; flex-direction: column; gap: 1rem; padding: 1rem'>
        <h1 class='mt-2'>Mon super site !</h1>
        Vous êtes connecté
        <br><strong>$name</strong>
    </div>";
} else {
    echo "Vous n'êtes pas connecté";
}


// Récupère la liste des projets
$projects = $projectsManager->list();
?>

    <div style='display: flex; flex-direction: column; gap: 1rem; max-width: 36rem; padding: 1rem'>
        <?php foreach ($projects as $project) :
            $avg = $projectsReviewManager->getAvgForProject($project->getId());
            $avgText = ($avg == null ? 'Pas encore de note' : $avg);
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
                            <input type="hidden" name="id" value="<?php echo $project->getId() ?>">
                            <button type="submit">Supprimer</button>
                        </form>
                    <?php endif; ?>
                    <?php if ($_SESSION && $_SESSION["is_connected"]) : ?>
                        <button type="button"><a
                                href="create_review.php?project_id=<?php echo $project->getId() ?>">Review</a>
                        </button>
                    <?php else : ?>
                        <button type="button"><a href="login.php">Review</a></button>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>


<?php require("./layout/footer.php"); ?>