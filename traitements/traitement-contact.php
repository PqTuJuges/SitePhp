<?php
require_once __DIR__ . '/../core/gestion-formulaire.php';
$erreurs = [];
$messageGlobal = "";
$anciennesValeurs = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(!isset($_POST['nom']) || mb_strlen(trim($_POST['nom'])) < 2 || mb_strlen(trim($_POST['nom'])) > 255) {
        $erreurs['nom'] = "Le nom doit comporter entre 2 et 255 caractères.";
    }
    if(isset($_POST['prenom']) && (mb_strlen(trim($_POST['prenom'])) < 2 || mb_strlen(trim($_POST['prenom'])) > 255)) {
        $erreurs['prenom'] = "Le prénom doit comporter entre 2 et 255 caractères.";
    }
    if(!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $erreurs['email'] = "L'email n'est pas valide.";
    }
    if(empty($erreurs)) {
        $messageGlobal = "Merci pour votre message !";
    } else {
        $messageGlobal = "Veuillez corriger les erreurs ci-dessous.";
        $anciennesValeurs = $_POST;
    }
    
}