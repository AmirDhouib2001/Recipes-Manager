<?php
require __DIR__ . '/../classes/Autoloader.php';


Autoloader::register();
session_start() ;

use gdb\renderer ;
use gdb\menu ;

$gdb = new \gdb\menu("recettes") ;
$data =$gdb->getIngredients();
?>

<?php ob_start() ?>
<?php ?>


<?php foreach ($data as $d): ?>
    <?= $d->getHTMLingredient(); ?>
<?php endforeach;?>



<?php $content=ob_get_clean() ?>
<?php \recettes\Template::render($content) ?>