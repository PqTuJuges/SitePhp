<?php
$pageTitre       = "Connexion";
$metaDescription = "La métadescription du site";
require __DIR__ . '/traitements/traitement-connexion.php';

if (est_connecte()) {
    header('Location: ' . BASE_URL . '/profil.php');
    exit;
}
require __DIR__ . '/templates/header.php';
?>

<h2>Connexion</h2>

<?php if (isset($_GET['inscription']) && $_GET['inscription'] === 'succes') : ?>
    <p>Inscription réussie ! Vous pouvez maintenant vous connecter.</p>
<?php endif; ?>

<?php if ($messageGlobal !== '') : ?>
    <p><?= e($messageGlobal) ?></p>
<?php endif; ?>

<form method="POST" action="connexion.php">

    <p>
        <label for="connexion_pseudo" class="obligatoire">Pseudo :</label>
        <input type="text" id="connexion_pseudo" name="connexion_pseudo" placeholder="Champ obligatoire" required minlength="2" maxlength="255" value="<?= e($anciennesValeurs['connexion_pseudo'] ?? '') ?>"
        >
        <?php if (!empty($erreurs['connexion_pseudo'])) : ?>
            <span class="erreur"><?= e($erreurs['connexion_pseudo']) ?></span>
        <?php endif; ?>
    </p>

    <p>
        <label for="connexion_motDePasse" class="obligatoire">Mot de passe :</label>
        <input type="password" id="connexion_motDePasse" name="connexion_motDePasse" placeholder="Champ obligatoire" required minlength="8" maxlength="72"
        >
        <?php if (!empty($erreurs['connexion_motDePasse'])) : ?>
            <span class="erreur"><?= e($erreurs['connexion_motDePasse']) ?></span>
        <?php endif; ?>
    </p>

    <p>
        <button type="submit">Se connecter</button>
    </p>

    <p>
        <a href="inscription.php">Pas encore inscrit ? Créer un compte</a>
    </p>

</form>

<?php require __DIR__ . '/templates/footer.php'; ?>