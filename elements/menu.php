<?php
require __DIR__ . '/../classes/Autoloader.php';
Autoloader::register();
session_start() ;

use gdb\renderer ;
use gdb\menu ;

$gdb = new \gdb\menu("recettes") ;
$data =$gdb->getAllRecettes();
?>

<?php ob_start() ?>

<div class="title">Recette</div>
<section class="liste_recette">
    <?php foreach ($data as $d): ?>
        <?= $d->getHTML(); ?>
    <?php endforeach;?>


<?php $content=ob_get_clean() ?>
<?php Template::render($content) ?>