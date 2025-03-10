<?php require 'header.php';?>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Génération d'un token CSRF pour sécuriser le formulaire
session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<form action="traitement.php" method="POST">
    <div class="champ-formulaire">
        <label for="titre">Titre de l'œuvre</label>
        <input type="text" name="titre" id="titre" required maxlength="255" placeholder="Ex: La Joconde" autocomplete="off">
    </div>
    
    <div class="champ-formulaire">
        <label for="artiste">Auteur de l'œuvre</label>
        <input type="text" name="artiste" id="artiste" required maxlength="255" placeholder="Ex: Léonard de Vinci" autocomplete="off">
    </div>
    
    <div class="champ-formulaire">
        <label for="image">URL de l'image</label>
        <input type="url" name="image" id="image" required placeholder="Ex: https://example.com/image.jpg" autocomplete="off">
    </div>
    
    <div class="champ-formulaire">
        <label for="description">Description</label>
        <textarea name="description" id="description" required maxlength="1000" placeholder="Décrivez l'œuvre ici..."></textarea>
    </div>
    
    <!-- Champ caché pour la sécurité CSRF -->
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

    <input type="submit" value="Valider" name="submit"/>
</form>

<?php require 'footer.php'; ?>
