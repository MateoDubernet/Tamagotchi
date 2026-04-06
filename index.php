<?php
require_once __DIR__ . '/migrations/setup.php';

// Redirection vers la page de login
header('Location: /connexion/login.php');
exit;