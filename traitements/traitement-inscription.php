<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../core/gestion-formulaire.php';
require_once __DIR__ . '/../core/gestionBdd.php';
require_once __DIR__ . '/../core/gestionAuthentification.php';

$erreurs          = [];
$anciennesValeurs = [];
$messageGlobal    = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $pseudoEstUnique = function(string $valeur): bool
    {
        try
        {
            $pdo  = obtenirConnexionBdd();
            $stmt = $pdo->prepare('SELECT COUNT(*) FROM t_utilisateur_uti WHERE uti_pseudo = :pseudo');
            $stmt->bindValue(':pseudo', $valeur, PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            $pdo   = null;
            return $count === 0;
        }
        catch (PDOException $e)
        {
            $pdo = null;
            return true;
        }
    };

    $emailEstUnique = function(string $valeur): bool
    {
        try
        {
            $pdo  = obtenirConnexionBdd();
            $stmt = $pdo->prepare('SELECT COUNT(*) FROM t_utilisateur_uti WHERE uti_email = :email');
            $stmt->bindValue(':email', $valeur, PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            $pdo   = null;
            return $count === 0;
        }
        catch (PDOException $e)
        {
            $pdo = null;
            return true;
        }
    };

    $reglesDesChamps = [
        'inscription_pseudo' => [
            'required' => true,
            'minMax'   => [2, 255],
            'unique'   => $pseudoEstUnique,
        ],
        'inscription_email' => [
            'required' => true,
            'type'     => 'email',
            'unique'   => $emailEstUnique,
        ],
        'inscription_motDePasse' => [
            'required' => true,
            'minMax'   => [8, 72],
        ],
        'inscription_motDePasse_confirmation' => [
            'required' => true,
            'minMax'   => [8, 72],
            'confirm'  => 'inscription_motDePasse',
        ],
    ];

    [$erreurs, $messageGlobal, $anciennesValeurs] = validerChamps($_POST, $reglesDesChamps);

    if (empty($erreurs))
    {
        $pdo = null;
        try
        {
            $pdo = obtenirConnexionBdd();

            $motDePasseHache = password_hash($_POST['inscription_motDePasse'], PASSWORD_BCRYPT);

            $stmt = $pdo->prepare('
                INSERT INTO t_utilisateur_uti
                    (uti_pseudo, uti_email, uti_motdepasse, uti_compte_active, uti_code_activation)
                VALUES
                    (:pseudo, :email, :motdepasse, 1, NULL)
            ');

            $stmt->bindValue(':pseudo',     lireChampTexte($_POST, 'inscription_pseudo'), PDO::PARAM_STR);
            $stmt->bindValue(':email',      lireChampTexte($_POST, 'inscription_email'),  PDO::PARAM_STR);
            $stmt->bindValue(':motdepasse', $motDePasseHache,                            PDO::PARAM_STR);

            $stmt->execute();

            header('Location: ' . BASE_URL . '/connexion.php?inscription=succes');
            exit;
        }
        catch (PDOException $e)
        {
            $messageGlobal = 'Une erreur technique est survenue, veuillez réessayer.';
        }
        finally
        {
            $pdo = null;
        }
    }
}