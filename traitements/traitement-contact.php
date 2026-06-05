<?php
require_once __DIR__ . '/../core/gestion-formulaire.php';

$erreurs = [];
$messageGlobal = "";
$anciennesValeurs = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom     = trim($_POST['nom']     ?? '');
    $prenom  = trim($_POST['prenom']  ?? '');
    $email   = trim($_POST['email']   ?? '');
    $message = trim($_POST['message'] ?? '');

    if (mb_strlen($nom) < 2 || mb_strlen($nom) > 255) {
        $erreurs['nom'] = "Le nom doit comporter entre 2 et 255 caractères.";
    }

    if ($prenom !== '' && (mb_strlen($prenom) < 2 || mb_strlen($prenom) > 255)) {
        $erreurs['prenom'] = "Le prénom doit comporter entre 2 et 255 caractères.";
    }

    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs['email'] = "L'adresse e-mail n'est pas valide.";
    }

    if (mb_strlen($message) < 10 || mb_strlen($message) > 3000) {
        $erreurs['message'] = "Le message doit comporter entre 10 et 3000 caractères.";
    }

    if (empty($erreurs)) {

        $destinataire = "email.test@laragon.mailPit";

        $sujet = "Projet Framework - Formulaire de contact";

        // Corps du mail en HTML
        $corps = '
        <html>
        <body>
            <h2>Nouveau message depuis le formulaire de contact</h2>
            <table>
                <tr>
                    <td><strong>Nom :</strong></td>
                    <td>' . htmlspecialchars($nom, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</td>
                </tr>
                <tr>
                    <td><strong>Prénom :</strong></td>
                    <td>' . htmlspecialchars($prenom, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</td>
                </tr>
                <tr>
                    <td><strong>E-mail :</strong></td>
                    <td>' . htmlspecialchars($email, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</td>
                </tr>
                <tr>
                    <td><strong>Message :</strong></td>
                    <td>' . nl2br(htmlspecialchars($message, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) . '</td>
                </tr>
            </table>
        </body>
        </html>';

        // En-têtes du mail
        $entetes  = "From: Site Web <no-reply@monsite.com>\r\n";
        $entetes .= "To: " . $destinataire . "\r\n";
        $entetes .= "Reply-To: " . $email . "\r\n";
        $entetes .= "Content-Type: text/html; charset=UTF-8\r\n";
        $entetes .= "Content-Transfer-Encoding: 8bit\r\n";

        mail($destinataire, $sujet, $corps, $entetes);

        $messageGlobal = "Votre message a bien été envoyé, merci !";
    } else {
        $messageGlobal = "Le formulaire contient des erreurs, veuillez les corriger.";
        $anciennesValeurs = [
            'nom'     => $nom,
            'prenom'  => $prenom,
            'email'   => $email,
            'message' => $message,
        ];
    }
}
