<?php
require_once __DIR__ . '/../core/gestion-formulaire.php';
require_once __DIR__ . '/../core/gestionBdd.php';
require_once __DIR__ . '/../core/gestionAuthentification.php';
require_once __DIR__ . '/../config/config.php';
$erreurs          = [];
$anciennesValeurs = [];
$messageGlobal    = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reglesDesChamps = [
        'connexion_pseudo' => [
            'required' => true,
            'minMax'   => [2, 255],
        ],
        'connexion_motDePasse' => [
            'required' => true,
            'minMax'   => [8, 72],
        ],
    ];

    [$erreurs, $messageGlobal, $anciennesValeurs] = validerChamps($_POST, $reglesDesChamps);

    if (empty($erreurs)) {
        $pdo = null;
        try {
            $pdo = obtenirConnexionBdd();

            $stmt = $pdo->prepare('
                SELECT uti_id, uti_pseudo, uti_motdepasse, uti_compte_active
                FROM t_utilisateur_uti
                WHERE uti_pseudo = :pseudo
            ');
            $stmt->bindValue(':pseudo', lireChampTexte($_POST, 'connexion_pseudo'), PDO::PARAM_STR);
            $stmt->execute();

            $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$utilisateur || !password_verify(lireChampTexte($_POST, 'connexion_motDePasse'), $utilisateur['uti_motdepasse'])) {
                $messageGlobal = 'Pseudo ou mot de passe incorrect.';
                $erreurs['connexion_global'] = true;
            } elseif (!$utilisateur['uti_compte_active']) {
                $messageGlobal = 'Votre compte n\'est pas actif.';
                $erreurs['connexion_global'] = true;
            } else {
                connecter_utilisateur($utilisateur['uti_id']);
                header('Location: ' . BASE_URL . '/profil.php');
                exit;
            }
        } catch (PDOException $e) {
            $messageGlobal = 'Une erreur technique est survenue, veuillez réessayer.';
        } finally {
            $pdo = null;
        }
    }
}
