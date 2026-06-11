<?php
function obtenirConnexionBdd(): PDO
{
    $nomDuServeur   = 'localhost';
    $nomBDD         = 'bdd_projet_web';
    $nomUtilisateur = 'root';
    $motDePasse     = '';

    $dsn = "mysql:host=$nomDuServeur;dbname=$nomBDD;charset=utf8mb4";

    $pdo = new PDO($dsn, $nomUtilisateur, $motDePasse);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $pdo;
}