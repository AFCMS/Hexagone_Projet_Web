<?php require('./layout/header.php');
global $projectsManager;
global $projectsReviewManager;
?>

<h1 class="mt-2">Create review</h1>

<?php

if (!$_GET["project_id"]) {
    echo "<script>window.location.href='index.php'</script>";
}

if ($_POST) {
    if ($_POST["content"] == "") {
        echo "Please fill all fields";
        return;
    }

    if (!is_numeric($_POST["note"]) || $_POST["note"] < 0 || $_POST["note"] > 5) {
        echo "Please fill all fields";
        return;
    }

    $_POST["project_id"] = $_GET["project_id"];
    $_POST["user_name"] = $_SESSION['is_connected'];

    $projectsReviewManager->create($_POST);

    echo "<script>window.location.href='index.php'</script>";
}

?>

<form action="create_review.php?project_id=<?php echo $_GET["project_id"] ?>" method="post" class="main-form">
    <label for="note">Note</label>
    <input type="number" name="note" id="note" max="5" min="0" required>

    <label for="content">Content</label>
    <textarea name="content" id="content" cols="30" rows="10" required></textarea>

    <button type="submit">Create review</button>
</form>