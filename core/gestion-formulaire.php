<?php

declare(strict_types=1);
function e(string $texte): string
{
    return htmlspecialchars($texte, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
function lireChampTexte(array $tableauDonnees, string $nomChamp): string
{
    return trim($tableauDonnees[$nomChamp] ?? "");
}
function longueurString(string $valeurChamp, int $longueurMin, int $longueurMax): bool
{
    return mb_strlen($valeurChamp) < $longueurMin || mb_strlen($valeurChamp) > $longueurMax;
}
function emailEstValide(string $valeurChamp): bool
{
    return filter_var($valeurChamp, FILTER_VALIDATE_EMAIL) !== false;
}
function validerChamps(array $entreesUtilisateur, array $reglesDesChamps): array
{
    $erreurs = [];
    $anciennesValeurs = [];
    $messageGlobal = "";
    foreach ($reglesDesChamps as $cle => $regle) {
        $valeur = lireChampTexte($entreesUtilisateur, $cle);
        $anciennesValeurs[$cle] = $valeur;
        if ($regle["required"] === true && $valeur === "") {
            $erreurs[$cle] = "Ce champ est obligatoire";
            continue;
        }
        if ($valeur === "") {
            continue;
        }
        if (
            isset($regle["minMax"])
            && longueurString($valeur, $regle["minMax"][0], $regle["minMax"][1])
        ) {
            $erreurs[$cle] = "Ce champ doit faire entre {$regle["minMax"][0]} et {$regle["minMax"][1]} caractères";
        } elseif (isset($regle["type"]) && $regle["type"] === "email" && !emailEstValide($valeur)) {
            $erreurs[$cle] = "Email invalide";
        } elseif (isset($regle["confirm"])) {
            $champReference = lireChampTexte($entreesUtilisateur, $regle["confirm"]);
            if ($valeur !== $champReference) {
                $erreurs[$cle] = "Les mots de passe ne correspondent pas";
            }
        }
        if (!isset($erreurs[$cle]) && isset($regle["unique"]) && !$regle["unique"]($valeur)) {
            $erreurs[$cle] = "Cette valeur est déjà utilisée";
        }
    }
    if (empty($erreurs)) {
        $messageGlobal = "Le formulaire a bien été envoyé";
        $anciennesValeurs = [];
    } else {
        $messageGlobal = "Le formulaire contient des erreurs";
    }
    return [$erreurs, $messageGlobal, $anciennesValeurs];
}
