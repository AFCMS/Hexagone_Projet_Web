<?php require('./layout/header.php');

global $projectsManager;

function isGithubRepo($url): bool
{
    $githubUrlRegex = '/https:\/\/github\.com\/[a-zA-Z0-9\-]+\/[a-zA-Z0-9\-]+/';

    if (!preg_match($githubUrlRegex, $url)) {
        echo '<script>alert("Invalid GitHub URL");</script>';
        return false;
    }

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_exec($ch);
    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return $statusCode == 200;
}

if (!$_SESSION && !$_SESSION['is_connected']) {
    echo "<script>window.location.href='login.php'</script>";
    return;
}

if ($_POST) {
    if ($_FILES['icon']['size'] < 200000) {
        $fileName = $_POST['name'] . '.' . pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION);

        if (!is_dir('uploads')) {
            mkdir('uploads');
        }

        if (!filter_var($_POST["gh_url"], FILTER_VALIDATE_URL)) {
            echo "Invalid URL";
            return;
        }

        if (!isGithubRepo($_POST["gh_url"])) {
            echo "This is not a valid GitHub repository";
            return;
        }

        $targetFile = 'uploads/' . $fileName;
        print_r($_FILES['icon']['tmp_name']);
        if (pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION) == "png") {
            move_uploaded_file($_FILES['icon']['tmp_name'], $targetFile);

            $_POST['icon_url'] = $targetFile;
            $_POST['user_name'] = $_SESSION['is_connected'];

            $projectsManager->create($_POST);

            echo "<script>window.location.href='index.php'</script>";
        } else {
            echo "File must be a PNG";
        }
    }
}

?>

    <div class="main-container">
        <form action="create.php" method="post" enctype="multipart/form-data" class="main-form projects-container">
            <h1>Add project</h1>
            <label for="name">Project Name</label>
            <input type="text" name="name" id="name" maxlength="256" required>

            <label for="gh_url">GitHub URL</label>
            <input type="url" name="gh_url" id="gh_url" maxlength="256" required
                   placeholder="https://github.com/AFCMS/test_repo">

            <label for="icon">Icon</label>
            <input type="file" name="icon" id="icon" required accept="image/png">

            <label for="description">Description</label>
            <textarea name="description" id="description" maxlength="2048" required></textarea>

            <input type="submit" value="Add project" class="bouton">
        </form>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const form = document.querySelector('.main-form');

                form.addEventListener('submit', function (event) {
                    event.preventDefault(); // Prevent the form from submitting

                    const ghUrlInput = document.getElementById('gh_url');
                    const ghUrl = ghUrlInput.value;

                    // Extract user and repo from GitHub URL
                    const match = ghUrl.match(/github\.com\/([^\/]+)\/([^\/]+)/);
                    if (match) {
                        const user = match[1];
                        const repo = match[2];

                        // GitHub API URL
                        const apiUrl = `https://api.github.com/repos/${user}/${repo}`;

                        // Check if the repository exists
                        fetch(apiUrl)
                            .then(response => {
                                if (response.ok) {
                                    // If the repository exists, submit the form
                                    form.submit();
                                } else {
                                    // If the repository does not exist, show an error
                                    alert('GitHub repository does not exist. Please enter a valid repository URL.');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('An error occurred while validating the GitHub URL.');
                            });
                    } else {
                        alert('Please enter a valid GitHub URL.');
                    }
                });
            });
        </script>
    </div>

<?php require('./layout/footer.php'); ?>