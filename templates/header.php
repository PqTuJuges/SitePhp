<?php
require_once __DIR__ . "/../config/config.php"
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="<?php echo $metaDescription ?? 'Bienvenue sur notre site web par défaut.'; ?>">
    <title><?php echo $pageTitre ?? 'Mon Site Web - Accueil'; ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="<?= BASE_URL ?>/index.php">Accueil</a></li>
                <li><a href="<?= BASE_URL ?>/contact.php">Contact </a></li>
                <li><a href="<?= BASE_URL ?>/connexion.php">Connexion</a></li>
            </ul>
        </nav>
    </header>
    <main>