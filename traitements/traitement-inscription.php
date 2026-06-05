<?php
require_once __DIR__ . '/../core/gestion-formulaire.php';
$erreurs = [];
$messageGlobal = "";
$anciennesValeurs = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $pseudo     = trim($_POST['inscri_pseudo']     ?? '');
    $email  = trim($_POST['inscri_email']  ?? '');
    $mdp   = trim($_POST['inscri_mdp']   ?? '');
    $mdpconf = trim($_POST['inscri_conf_mdp'] ?? '');

    if (mb_strlen($pseudo) < 2 || mb_strlen($pseudo) > 255) {
        $erreurs['inscri_pseudo'] = "Le pseudo doit comporter entre 2 et 255 caractères.";
    }

    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs['email'] = "L'adresse e-mail n'est pas valide.";
    }

    if (mb_strlen($mdp) < 8 || mb_strlen($mdp) > 72) {
        $erreurs['inscri_mdp'] = "Le mdp doit comporter entre 8 et 72 caractères.";
    }

    if ($mdpConf === '') {
        $erreurs['inscri_conf_mdp'] = "La confirmation est requise.";
    } elseif ($mdp !== $mdpConf) {
        $erreurs['inscri_conf_mdp'] = "Les mots de passe ne correspondent pas.";
    }



}