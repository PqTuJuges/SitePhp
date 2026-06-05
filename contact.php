<?php
$titre = "contact";
$metaDescription = "La métadescription du site";
$erreurs = [];
$messageGlobal = "";
$vieuxnom = htmlspecialchars($_POST['nom'] ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$vieuxprenom = htmlspecialchars($_POST['prenom'] ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$vieuxemail = htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$vieuxmessage = htmlspecialchars($_POST['message'] ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

require __DIR__ . "/templates/header.php" ?>
<h1>contact</h1>
<form method="POST">
	<p>
		<label for="nom" class="obligatoire">Nom : </label>
		<input type="text" id="nom" name="nom" placeholder="Champ obligatoire" required minlength="2" maxlength="255" value="<?= $vieuxnom ?>">
	<div>
		<?= $erreurs['nom'] ?? '' ?>
	</div>
	</p>
	<br>
	<p>
		<label for="prenom">Prénom : </label>
		<input type="text" id="prenom" name="prenom" minlength="2" maxlength="255" value="<?= $vieuxprenom ?>">
	<div>
		<?= $erreurs['prenom'] ?? '' ?>
	</div>
	</p>
	<br>
	<p>
		<label for="email" class="obligatoire">e-Mail :</label>
		<input type="email" id="email" name="email" placeholder="Champ obligatoire" required value="<?= $vieuxemail ?>">
	<div>
		<?= $erreurs['email'] ?? '' ?>
	</div>
	</p>
	<br>
	<p>
		<label for="message">Votre message : </label>
		<textarea name="message" id="message" cols="30" rows="5" required minlength="10" maxlength="3000"><?= $vieuxmessage ?></textarea>
	<div>
		<?= $erreurs['message'] ?? '' ?>
	</div>
	</p>
	<button type="submit">Envoyer</button>
	<div>
		<?= $messageGlobal ?>
	</div>
</form>
<?php require __DIR__ . "/templates/footer.php" ?>