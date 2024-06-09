<?php require('./layout/header.php');
global $projectsManager;
global $projectsReviewManager;

// TODO: filter projects
if ($_GET && $_GET["search"]) {
    $projects = $projectsManager->listFiltered($_GET["search"]);
} else {
    $projects = $projectsManager->list();
}
?>
    <div class="main-container">
        <div class="projects-container">
            <div class="project">
                <form action="index.php" method="get" class=""
                      style="display: flex; flex-direction: row; align-items: baseline; gap: 1rem">
                    <label for="search">Rechercher un projet</label>
                    <input type="text" name="search" id="search"
                           value="<?php echo ($_GET && $_GET["search"]) ? $_GET["search"] : "" ?>">
                    <input type="submit" class="bouton" style="">
                </form>
            </div>
            <?php foreach ($projects as $project) :
                $avg = $projectsReviewManager->getAvgForProject($project->getId());
                $avgText = ($avg == null ? 'Pas encore de note' : starsHTML($avg));
                ?>
                <div class="project">
                    <div class="project-header">
                        <img class="projet-image" src="<?php echo $project->getIconUrl() ?>" alt="Icone du projet">
                        <h2>
                            <a href="project.php?project_id=<?php echo $project->getId() ?>"
                               style=""><?php echo $project->getName() ?></a>
                        </h2>
                        <span><?php echo $avgText ?></span>
                    </div>
                    <p><?php echo $project->getDescription() ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


<?php require("./layout/footer.php"); ?>