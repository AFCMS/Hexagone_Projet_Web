<?php require('./layout/header.php');

global $db;
global $projectsManager;

if (!$_SESSION && !$_SESSION['is_connected']) {
    echo "<script>window.location.href='login.php'</script>";
}

if ($_POST) {

    $project = $projectsManager->get($_POST['project_id']);

    if ($project->getUserName() !== $_SESSION['is_connected']) {
        echo "You can't edit this project" . "<br>";
        echo "It has been created by " . $project->getUserName();
        return;
    }

    if ($_FILES['icon']['size'] < 200000) {
        $fileName = $project->getName() . '.' . pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION);

        if (!is_dir('uploads')) {
            mkdir('uploads');
        }

        $targetFile = 'uploads/' . $fileName;
        print_r($_FILES['icon']['tmp_name']);
        if (pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION) == "png") {

            if (file_exists($project->getIconUrl())) {
                unlink($project->getIconUrl());
            }
            move_uploaded_file($_FILES['icon']['tmp_name'], $targetFile);


            echo "<script>window.location.href='index.php'</script>";
        } else {
            echo "File must be a PNG";
            return;
        }
    }

    $projectsManager->update([
        'id' => $_POST['project_id'],
        'description' => $_POST['description']
    ]);

    # echo implode(", ", $db->errorInfo());
    return;
}

if (!$_GET["project_id"] || !is_numeric($_GET["project_id"])) {
    echo "<script>window.location.href='index.php'</script>";
}

$project = $projectsManager->get($_GET["project_id"]);

if ($project->getUserName() !== $_SESSION['is_connected']) {
    echo "You can't edit this project" . "<br>";
    echo "It has been created by " . $project->getUserName();
    return;
}

?>

    <h1>Edit project</h1>

    <form action="update.php" method="post" enctype="multipart/form-data" class="main-form">
        <input type="hidden" name="project_id" value="<?php echo $project->getId(); ?>">
        <label for="icon">Icon</label>
        <input type="file" name="icon" id="icon" accept="image/png" required>

        <label for="description">Description</label>
        <textarea name="description" id="description" maxlength="2048"
                  required><?php echo $project->getDescription(); ?></textarea>

        <input type="submit" value="Edit project" class="bouton">
    </form>

<?php require('./layout/footer.php'); ?>