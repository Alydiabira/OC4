<?php
include 'header.php';
include 'bdd.php';
$bdd = connexion();

// Récupération des œuvres sous forme de tableau associatif
$oeuvres = $bdd->query('SELECT * FROM oeuvres')->fetchAll(PDO::FETCH_ASSOC);
?>

<div id="liste-oeuvres">
    <?php if (count($oeuvres) > 0): ?>
        <?php foreach($oeuvres as $oeuvre): ?>
            <article class="oeuvre">
                <a href="oeuvre.php?id=<?= htmlspecialchars($oeuvre['id']) ?>">
                    <img src="<?= htmlspecialchars($oeuvre['image']) ?>" alt="<?= htmlspecialchars($oeuvre['titre']) ?>">
                    <h2><?= htmlspecialchars($oeuvre['titre']) ?></h2>
                    <p class="description"><?= htmlspecialchars($oeuvre['artiste']) ?></p>
                </a>
            </article>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucune œuvre disponible pour le moment.</p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
