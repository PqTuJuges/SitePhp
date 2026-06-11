<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../core/gestionAuthentification.php';

deconnecter_utilisateur();
header('Location: ' . BASE_URL . '/connexion.php');
exit;