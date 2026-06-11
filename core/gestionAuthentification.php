<?php
function demarrerSession()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}
function connecter_utilisateur(int $id)
{
    demarrerSession();
    $_SESSION['utilisateurID'] = $id;
}

function est_connecte()
{
    demarrerSession();
    if (isset($_SESSION['utilisateurID'])) {
        return true;
    } else {
        return false;
    }
}
function deconnecter_utilisateur()
{
    demarrerSession();
    unset($_SESSION['utilisateurID']);
}
