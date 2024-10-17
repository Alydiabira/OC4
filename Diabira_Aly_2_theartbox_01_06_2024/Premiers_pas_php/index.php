<?php
include( 'header.php');
include( 'oeuvres.php');

?>
        <div id="liste-oeuvres">
            <?php foreach($oeuvres as $oeuvre) { ?>
            <article class="oeuvre">
                <a href="oeuvre.php?id=<?php echo $oeuvre['id']; ?>">
                    <img src="<?php echo $oeuvre['image']; ?>" alt="<?php echo $oeuvre['titre']; ?>">
                    <h2><?php echo $oeuvre['titre']; ?></h2>
                    <p class="description"><?php echo $oeuvre['artist']; ?></p>
                </a>
            </article>
            <?php } ?>
            
        </div>
    </main>
        <?php include( 'footer.php'); ?>
