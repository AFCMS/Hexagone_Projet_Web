<?php require('./layout/header.php');
global $projectsManager;
global $projectsReviewManager;

// TODO: filter projects
$projects = $projectsManager->list();
?>
    <div class="main-container">
        <div class="projects-container">
            <?php foreach ($projects as $project) :
                $avg = $projectsReviewManager->getAvgForProject($project->getId());
                $avgText = ($avg == null ? 'Pas encore de note' : $avg);
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