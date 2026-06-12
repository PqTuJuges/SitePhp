<?php
$pageTitre = "Contact";
$metaDescription = "La métadescription du site";

require __DIR__ . '/traitements/traitement-contact.php';

$vieuxNom     = htmlspecialchars($anciennesValeurs['nom']     ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$vieuxPrenom  = htmlspecialchars($anciennesValeurs['prenom']  ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$vieuxEmail   = htmlspecialchars($anciennesValeurs['email']   ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$vieuxMessage = htmlspecialchars($anciennesValeurs['message'] ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

require __DIR__ . '/templates/header.php';
?>

<h2>Contact</h2>

<form method="POST">
	<p>
		<label for="nom" class="obligatoire">Nom :</label>
		<input type="text" id="nom" name="nom" placeholder="Champ obligatoire"
			required minlength="2" maxlength="255" value="<?= $vieuxNom ?>">
	</p>
	<?php if (!empty($erreurs['nom'])): ?>
		<div class="erreur"><?= htmlspecialchars($erreurs['nom']) ?></div>
	<?php endif ?>

	<p>
		<label for="prenom">Prénom :</label>
		<input type="text" id="prenom" name="prenom"
			minlength="2" maxlength="255" value="<?= $vieuxPrenom ?>">
	</p>
	<?php if (!empty($erreurs['prenom'])): ?>
		<div class="erreur"><?= htmlspecialchars($erreurs['prenom']) ?></div>
	<?php endif ?>

	<p>
		<label for="email" class="obligatoire">E-mail :</label>
		<input type="email" id="email" name="email" placeholder="Champ obligatoire"
			required value="<?= $vieuxEmail ?>">
	</p>
	<?php if (!empty($erreurs['email'])): ?>
		<div class="erreur"><?= htmlspecialchars($erreurs['email']) ?></div>
	<?php endif ?>

	<p>
		<label for="message">Votre message :</label>
		<textarea name="message" id="message" cols="30" rows="5"
			required minlength="10" maxlength="3000"><?= $vieuxMessage ?></textarea>
	</p>
	<?php if (!empty($erreurs['message'])): ?>
		<div class="erreur"><?= htmlspecialchars($erreurs['message']) ?></div>
	<?php endif ?>

	<button type="submit">Envoyer</button>

	<?php if (!empty($messageGlobal)): ?>
		<div class="message-global"><?= htmlspecialchars($messageGlobal) ?></div>
	<?php endif ?>
</form>

<?php require __DIR__ . '/templates/footer.php' ?>