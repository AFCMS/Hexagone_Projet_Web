<?php require('./layout/header.php');
global $projectsManager;
global $projectsReviewManager;

if (!$_SESSION && !$_SESSION['is_connected']) {
    echo "<script>window.location.href='login.php'</script>";
    return;
}

if (!$_GET["project_id"]) {
    echo "<script>window.location.href='index.php'</script>";
    return;
}

if ($_POST) {
    if ($_POST["text"] == "") {
        echo "Please fill all fields";
        return;
    }

    if (!is_numeric($_POST["note"]) || $_POST["note"] < 0 || $_POST["note"] > 5) {
        echo "Please fill all fields";
        return;
    }

    $_POST["project_id"] = $_GET["project_id"];
    $_POST["user_name"] = $_SESSION['is_connected'];

    try {
        $projectsReviewManager->create($_POST);
    } catch (Exception $e) {
        echo "<script>window.location.href='index.php'</script>";
        return;
    }

    echo "<script>window.location.href='index.php'</script>";
    return;
}

?>
    <div class="main-container">
        <form action="create_review.php?project_id=<?php echo $_GET["project_id"] ?>" method="post"
              class="main-form projects-container">
            <h1>Create review</h1>
            <label for="note" style="margin-top: 5px">Note</label>
            <input type="number" name="note" id="note" max="5" min="0" required>

            <label for="text" style="margin-top: 5px">Content</label>
            <textarea name="text" id="text" cols="30" rows="10" required></textarea>

            <button type="submit">Create review</button>
        </form>
    </div>

<?php require('./layout/footer.php'); ?>