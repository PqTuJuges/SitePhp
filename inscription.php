<?php
$pageTitre       = "Inscription";
$metaDescription = "La métadescription du site";
require __DIR__ . '/traitements/traitement-inscription.php';

if (est_connecte()) {
    header('Location: ' . BASE_URL . '/profil.php');
    exit;
}
require __DIR__ . '/templates/header.php';
?>

<h2>Inscription</h2>

<?php if ($messageGlobal !== '') : ?>
    <p><?= e($messageGlobal) ?></p>
<?php endif; ?>

<form method="POST" action="inscription.php">

    <p>
        <label for="inscription_pseudo" class="obligatoire">Pseudo :</label>
        <input type="text" id="inscription_pseudo" name="inscription_pseudo" placeholder="Champ obligatoire" required minlength="2" maxlength="255" value="<?= e($anciennesValeurs['inscription_pseudo'] ?? '') ?>"
        >
        <?php if (!empty($erreurs['inscription_pseudo'])) : ?>
            <span class="erreur"><?= e($erreurs['inscription_pseudo']) ?></span>
        <?php endif; ?>
    </p>

    <p>
        <label for="inscription_email" class="obligatoire">Adresse e-mail :</label>
        <input type="email" id="inscription_email" name="inscription_email" placeholder="Champ obligatoire" required value="<?= e($anciennesValeurs['inscription_email'] ?? '') ?>"
        >
        <?php if (!empty($erreurs['inscription_email'])) : ?>
            <span class="erreur"><?= e($erreurs['inscription_email']) ?></span>
        <?php endif; ?>
    </p>

    <p>
        <label for="inscription_motDePasse" class="obligatoire">Mot de passe :</label>
        <input type="password" id="inscription_motDePasse" name="inscription_motDePasse" placeholder="Champ obligatoire" required minlength="8" maxlength="72"
        >
        <?php if (!empty($erreurs['inscription_motDePasse'])) : ?>
            <span class="erreur"><?= e($erreurs['inscription_motDePasse']) ?></span>
        <?php endif; ?>
    </p>

    <p>
        <label for="inscription_motDePasse_confirmation" class="obligatoire">Confirmer le mot de passe :</label>
        <input type="password" id="inscription_motDePasse_confirmation" name="inscription_motDePasse_confirmation" placeholder="Champ obligatoire" required minlength="8" maxlength="72"
        >
        <?php if (!empty($erreurs['inscription_motDePasse_confirmation'])) : ?>
            <span class="erreur"><?= e($erreurs['inscription_motDePasse_confirmation']) ?></span>
        <?php endif; ?>
    </p>

    <p>
        <button type="submit">Créer le compte</button>
    </p>

</form>

<?php require __DIR__ . '/templates/footer.php'; ?>