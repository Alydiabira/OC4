<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start(); // Démarrage de la session pour stocker les erreurs et valider le CSRF

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];

    // Vérification du token CSRF
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $errors[] = "Token CSRF invalide.";
    }

    // Nettoyage et validation des champs
    $titre = trim($_POST['titre'] ?? '');
    $artiste = trim($_POST['artiste'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $image = trim($_POST['image'] ?? '');

    // Vérification des champs obligatoires
    if (empty($titre)) {
        $errors[] = "Le titre est requis.";
    }

    if (empty($artiste)) {
        $errors[] = "L'artiste est requis.";
    }

    if (empty($description) || strlen($description) < 3) {
        $errors[] = "La description est requise et doit contenir au moins 3 caractères.";
    }

    if (empty($image) || !filter_var($image, FILTER_VALIDATE_URL)) {
        $errors[] = "L'URL de l'image est invalide ou manquante.";
    } else {
        // Vérification si l'URL est une image valide
        $image_headers = @getimagesize($image);
        if ($image_headers === false) {
            $errors[] = "L'URL fournie n'est pas une image valide.";
        }
    }

    // Gestion des erreurs : redirection avec message
    if (!empty($errors)) {
        $_SESSION['form_errors'] = $errors;
        $_SESSION['form_data'] = $_POST; // Sauvegarde les entrées de l'utilisateur
        header('Location: ajouter.php');
        exit;
    }

    // Sécurisation des entrées utilisateur avant insertion
    $titre = htmlspecialchars($titre, ENT_QUOTES, 'UTF-8');
    $artiste = htmlspecialchars($artiste, ENT_QUOTES, 'UTF-8');
    $description = htmlspecialchars($description, ENT_QUOTES, 'UTF-8');
    $image = htmlspecialchars($image, ENT_QUOTES, 'UTF-8');

    // Connexion à la base de données et insertion avec gestion des erreurs PDO
    include 'bdd.php';
    $bdd = connexion();

    try {
        $requete = $bdd->prepare('INSERT INTO oeuvres (titre, description, artiste, image) VALUES (?, ?, ?, ?)');
        $requete->execute([$titre, $description, $artiste, $image]);

        // Suppression du token CSRF après l'insertion
        unset($_SESSION['csrf_token']);

        // Redirection vers la page de l'œuvre ajoutée
        header('Location: oeuvre.php?id=' . $bdd->lastInsertId());
        exit;
    } catch (PDOException $e) {
        // Gestion de l'erreur SQL et redirection avec message
        $_SESSION['form_errors'] = ["Une erreur est survenue lors de l'enregistrement : " . $e->getMessage()];
        $_SESSION['form_data'] = $_POST;
        header('Location: ajouter.php');
        exit;
    }
} else {
    header('Location: ajouter.php');
    exit;
}
