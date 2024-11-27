<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si le champ titre est rempli
    if (empty($_POST['titre'])) {
        echo "Le nom est requis.<br>";
    } else {
        $titre = $_POST['titre'];
    }

    // Vérifier si le champ description est rempli et s'il est valide
    if (empty($_POST['artiste'])) {
        echo "La description est requis.<br>";
    } else {
        $artiste = $_POST['artiste'];
        if (!filter_var($description, FILTER_VALIDATE_URL)) {
            echo "L'artiste n'est pas valide.<br>";
        }
    }

    // Vérifier si le champ description est rempli et s'il est valide
    if (empty($_POST['description'])) {
        echo "La description est requis.<br>";
    } else {
        $description = $_POST['description'];
        if (!filter_var($description, FILTER_VALIDATE_URL)) {
            echo "La description n'est pas valide.<br>";
        }
    }

     // Vérifier si le champ email est rempli et s'il est valide
    if (empty($_POST['image'])) {
        echo "L'image est requis.<br>";
    } else {
        $image = $_POST['image'];
        if (!filter_var($image, FILTER_VALIDATE_URL)) {
            echo "L'image n'est pas valide.<br>";
        }
    }

}



if(empty($_POST['titre']) 
    || empty($_POST['artiste']) 
    || empty($_POST['description']) 
    || empty($_POST['image'])
    || strlen($_POST['description']) < 3
    || !filter_var($_POST['image'], FILTER_VALIDATE_URL)) {
    header('Location: ajouter.php?erreur=true');
} else {
    $titre = htmlspecialchars($_POST['titre']);
    $description = htmlspecialchars($_POST['description']);
    $artiste = htmlspecialchars($_POST['artiste']);
    $image = htmlspecialchars($_POST['image']);

    // Puis on insère notre oeuvre en base de données
    include 'bdd.php';
    $bdd = connexion();

    $requete = $bdd->prepare('INSERT INTO oeuvres (titre, description, artiste, image) VALUES (?, ?, ?, ?)');
    $requete->execute([$titre, $description, $artiste, $image]);

    header('Location: oeuvre.php?id=' . $bdd->lastInsertId());
}