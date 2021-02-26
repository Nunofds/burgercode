<?php

function est_connecte(): bool
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return !empty($_SESSION['email']);
}

function forcer_utilisateur_connecte(): void
{
    if (!isset($_SESSION['email'])) {
        header('Location: login.php');
        exit();
    }
}
