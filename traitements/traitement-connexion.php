<?php
require_once __DIR__ . '/../core/gestion-formulaire.php';
$erreurs = [];
$messageGlobal = "";
$anciennesValeurs = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $pseudo     = trim($_POST['inscri_pseudo']     ?? '');
    $mdp   = trim($_POST['inscri_mdp']   ?? '');

    if (mb_strlen($pseudo) < 2 || mb_strlen($pseudo) > 255) {
        $erreurs['pseudo'] = "Le pseudo doit comporter entre 2 et 255 caractères.";
    }
    if (mb_strlen($mdp) < 8 || mb_strlen($mdp) > 72) {
        $erreurs['mdp'] = "Le mdp doit comporter entre 8 et 72 caractères.";
    }
    
}
