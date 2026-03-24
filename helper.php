<?php
// helper.php

/**
 * Vérifie si l'utilisateur est authentifié en regardant si une session existe.
 * @return bool
 */
function check_auth() {
    // Si la clé 'user_id' existe dans la session, l'utilisateur est connecté.
    return isset($_SESSION['user_id']);
}
?>