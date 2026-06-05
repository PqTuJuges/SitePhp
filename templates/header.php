<?php
require_once __DIR__ . "/../config/config.php"
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta><?= $metaDescription ?? "valeur par défaut" ?>
    <title><?= $titre ?? "valeur par défaut" ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="<?= BASE_URL ?>/index.php">accueil</li>
                <li><a href="<?= BASE_URL ?>/contact.php">contact</li>
            </ul>
        </nav>
    </header>
    <main>