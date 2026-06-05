<?php
$pageTitre = "connexion";
$metaDescription = "La métadescription du site";
require __DIR__ . '/templates/header.php';
?>
<h2>Connexion</h2>

<form method="POST">
    <p>
        <label for="pseudo" class="obligatoire">Pseudo :</label>
        <input type="text" id="pseudo" name="pseudo" placeholder="Champs obligatoire" required minlength="2" maxlength="255">
    </p>

    <p>
        <label for="mdp" class="obligatoire">Mot de passe :</label>
        <input type="password" id="mdp" name="mdp" placeholder="Champs obligatoire" required minlength="8" maxlength="72">
    </p>
    <p>
        <button type="submit">Connexion</button>
    </p>
    <a href="inscription.php">Pas encore inscrit ?</a>
</form>
<?php require __DIR__ . '/templates/footer.php' ?>