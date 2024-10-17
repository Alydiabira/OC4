<?php include( 'header.php');
$id = $_GET['id'];
$o = null;

include('oeuvres.php');
foreach($oeuvres as $oeuvre) {
    if ($id == $oeuvre['id']) {
        $o = $oeuvre;
    }
}
?>

    <article id="detail-oeuvre">
        <div id="img-oeuvre">
            <img src="<?php echo $o['image']; ?>" alt="<?php echo $o['titre']; ?>">
        </div>
        <div id="contenu-oeuvre">
            <h1><?php echo $o['titre']; ?></h1>
            <p class="description"><?php echo $o['artist']; ?></p>
            <p class="description-complete">
            <?php echo $o['description']; ?>
            </p>
        </div>
    </article>
    <?php include( 'footer.php'); ?>

