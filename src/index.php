<?php require('./layout/header.php'); ?>
    <h1 class="mt-2">Mon super site !</h1>

<?php
// Vérifie si l'utilisateur est connecté
if ($_SESSION && $_SESSION["is_connected"]) {
    $name = $_SESSION["is_connected"];
    echo "Vous êtes connecté";
    echo "<br><strong>$name</strong>";
} else {
    echo "Vous n'êtes pas connecté";
}
?>

<?php require("./layout/footer.php"); ?>