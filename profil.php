<?php
$pageTitre       = "Profil";
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/core/gestionAuthentification.php';
require_once __DIR__ . '/core/gestionBdd.php';
require_once __DIR__ . '/core/gestion-formulaire.php';
if(!est_connecte()){
    header('Location: ' . BASE_URL . '/connexion.php');
            exit;
}

$pdo = null;
$id = $_SESSION['utilisateurID'];
$utilisateur = null;

try
{
    $pdo = obtenirConnexionBdd();

    $stmt = $pdo->prepare('
        SELECT uti_pseudo, uti_email
        FROM t_utilisateur_uti
        WHERE uti_id = :id
    ');
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
}
catch (PDOException $e)
{
    $messageErreur = 'Une erreur technique est survenue.';
}
finally
{
    $pdo = null;
}
?>
<?php
require_once __DIR__ . '/templates/header.php';
?>
<h2>Profil</h2>
<p>Pseudo : <?= e($utilisateur['uti_pseudo']) ?> </p>
<p>Email : <?= e($utilisateur['uti_email']) ?></p>
<form action="<?= BASE_URL ?>/traitements/traitement-deconnexion.php" method="post">
<p><button type="submit">Deconnexion</button></p>
</form> 
<?php 
require_once __DIR__ . '/templates/footer.php'; 
?>