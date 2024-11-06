<?php
    include 'header.php';
    include 'bdd.php';
    $bdd = connexion();
    $oeuvres = $bdd->query('SELECT * FROM oeuvres');

?>
<div id="liste-oeuvres">
    <?php foreach($oeuvres as $oeuvre) {?>
        <article class="oeuvre">
            <a href="oeuvre.php?id=<?= $oeuvre['id'] ?>">
                <img src="<?= $oeuvre['image'] ?>" alt="<?= $oeuvre['titre'] ?>">
                <h2><?= $oeuvre['titre'] ?></h2>
                <p class="description"><?= $oeuvre['artiste'] . "<br>"; ?>                 
                <?php
                date_default_timezone_set("Europe/Paris"); 
                echo date('d/m/Y h:i:sa')  ; ?>
                </p>

            </a>
        </article>
    <?php  } ?>
</div>
<?php include 'footer.php'; ?>
