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
echo "<div style='display: flex; flex-direction: column; gap: 1rem; max-width: 36rem; padding: 1rem'>";
foreach ($projects as $project) {
    $avg = $projectsReviewManager->getAvgForProject($project['id']);
    $avgText = ($avg == null ? 'Pas encore de note' : $avg);
    echo "<div class='project'>
            <div style='display: flex; flex-direction: row; align-items: center; gap: 1rem; position: relative;'>
                <img class='projet-image' src='" . $project['icon_url'] . "' alt='Icone du projet'>
                <h2 style='height: 2rem; text-align: center; text-justify: auto'>" . $project['name'] . "</h2>
                <span style='position: absolute; right: 0; top: 0'>Note moyenne : " . $avgText . "</span>
            </div>
            <p>" . $project['description'] . "</p>
            <div style='display: flex; flex-direction: row; gap: 1rem'>
                <button type='button'><a href='" . $project['gh_url'] . "'>GitHub</a></button>";
    if ($_SESSION && $_SESSION["is_connected"] && $_SESSION["is_connected"] == $project['user_name']) {
        echo "<form action='delete.php' method='post'>";
        echo "<input type='hidden' name='id' value='" . $project['id'] . "'>";
        echo "<button type='submit'>Supprimer</button>";
        echo "</form>";
        echo "<button type='button'><a href='update.php?project_id=" . $project['id'] . "'>Modify</a></button>";
    }
    if ($_SESSION && $_SESSION["is_connected"]) {
        echo "<button type='button'><a href='create_review.php?project_id=" . $project['id'] . "'>Review</a></button>";
    }
    echo "</div></div>";
}
echo "</div>";
?>


<?php require("./layout/footer.php"); ?>