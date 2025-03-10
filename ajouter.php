<?php require 'header.php'; ?>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Génération d'un token CSRF pour sécuriser le formulaire
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Récupération des erreurs s'il y en a
$errors = $_SESSION['form_errors'] ?? [];
$form_data = $_SESSION['form_data'] ?? [];

// Nettoyage des erreurs après affichage
unset($_SESSION['form_errors']);
unset($_SESSION['form_data']);
?>

<!-- Affichage des erreurs si nécessaire -->
<?php if (!empty($errors)): ?>
    <div class="error-messages">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="traitement.php" method="POST">
    <div class="champ-formulaire">
        <label for="titre">Titre de l'œuvre</label>
        <input type="text" name="titre" id="titre" required maxlength="255" 
               placeholder="Ex: La Joconde" autocomplete="off" 
               value="<?= htmlspecialchars($form_data['titre'] ?? '') ?>">
    </div>
    
    <div class="champ-formulaire">
        <label for="artiste">Auteur de l'œuvre</label>
        <input type="text" name="artiste" id="artiste" required maxlength="255" 
               placeholder="Ex: Léonard de Vinci" autocomplete="off"
               value="<?= htmlspecialchars($form_data['artiste'] ?? '') ?>">
    </div>
    
    <div class="champ-formulaire">
        <label for="image">URL de l'image</label>
        <input type="url" name="image" id="image" required 
               placeholder="Ex: https://example.com/image.jpg" autocomplete="off"
               value="<?= htmlspecialchars($form_data['image'] ?? '') ?>">
    </div>
    
    <div class="champ-formulaire">
        <label for="description">Description</label>
        <textarea name="description" id="description" required maxlength="1000" 
                  placeholder="Décrivez l'œuvre ici..."><?= htmlspecialchars($form_data['description'] ?? '') ?></textarea>
    </div>
    
    <!-- Champ caché pour la sécurité CSRF -->
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

    <input type="submit" value="Valider" name="submit"/>
</form>

<?php require 'footer.php'; ?>
