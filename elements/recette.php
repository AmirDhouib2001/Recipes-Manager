<?php
require __DIR__ . '/../classes/Autoloader.php';


Autoloader::register();
session_start() ;

use gdb\renderer ;
use gdb\menu ;

$gdb = new \gdb\menu("recettes");
$button=new renderer();
$data =$gdb->getIngredients();
$desc=$gdb->getRecettedescription();
$button->generatebutton()
?>
<?php
?>

<?php ob_start() ;

?>


<?php foreach ($desc as $d): ?>
<?= $d->getHTMLdescription1(); ?>
<?php endforeach;?>


<?php foreach ($data as $d): ?>
    <?= $d->getHTMLingredient(); ?>
<?php endforeach;?>

<?php $gdb->DeleteRecette() ;?>



<?php $content=ob_get_clean() ?>

<?php \recettes\Template::render($content) ?>
<?php ;?>

