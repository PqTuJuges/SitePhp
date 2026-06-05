<?php
$pageTitre = "inscription";
$metaDescription = "La métadescription du site";
require __DIR__ . '/templates/header.php';
?>
<h2>Inscription</h2>
<form method="POST">
    <p>
        <label for="inscri_peusdo" class="obligatoire">Inscription peusdo :</label>
        <input type="text" id="inscri_pseudo" name="inscri_pseudo" placeholder="Champ obligatoire" required minlength="2" maxlength="255">
    </p>

    <p>
        <label for="inscri_email" class="obligatoire">Inscription E-mail :</label>
        <input type="email" id="inscri_email" name="inscri_email" placeholder="Champ obligatoire"
            required>
    </p>

    <p>
        <label for="inscri_mdp" class="obligatoire">Inscription mot de passe :</label>
        <input type="password" id="inscri_mdp" name="inscri_mdp" placeholder="Champ obligatoire" required minlength="8" maxlength="72">
    </p>

    <p>
        <label for="inscri_conf_mdp" class="obligatoire">Inscription mot de passe confirmation :</label>
        <input type="password" id="inscri_conf_mdp" name="inscri_conf_mdp" placeholder="Champ obligatoire" required minlength="8" maxlength="72">
    </p>
    <p>
    <button type="submit">Creer le compte</button>
    </p>
</form>

<?php require __DIR__ . '/templates/footer.php' ?>