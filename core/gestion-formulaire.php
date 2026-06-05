<?php

declare(strict_types=1);
function e(string $texte): string
{
    return htmlspecialchars($texte, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
function lireChampTexte($tableauDonnees, $nomChamp)
{
    return trim($tableauDonnees[$nomChamp] ?? "");
}
function longueurString($valeurChamp, $longueurMin, $longueurMax)
{
    return mb_strlen($valeurChamp) < $longueurMin || mb_strlen($valeurChamp) > $longueurMax;
}
function emailEstValide($valeurChamp)
{
    return filter_var($valeurChamp, FILTER_VALIDATE_EMAIL);
}
function validerChamps($entreesUtilisateur, $reglesDesChamps)
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
        }
    }
    if (empty($erreurs)) {
        $messageGlobal = "Le formulaire a bien été envoyé ✅";
        $anciennesValeurs = [];
    } else {
        $messageGlobal = "Le formulaire contient des erreurs ❌";
    }
    return [$erreurs, $messageGlobal, $anciennesValeurs];
}
