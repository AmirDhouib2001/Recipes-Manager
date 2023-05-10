<?php
require __DIR__ . '/../classes/Autoloader.php';
session_start();

Autoloader::register();

use gdb\renderer ;
use gdb\Search ;

$gdb = new \gdb\Search("recettes") ;
if (isset($_POST["search"])) {
    $datas = $gdb->getRecetteBySeach();
}else{
    $datas=null;
}
if(isset($_POST["menu-item"])){
    $radio = $gdb->getRecetteByRadio();
}else{
    $radio=null;
}
?>

<?php ob_start() ?>



    <section class="liste_recette">
<?php if($datas) {
    foreach ($datas as $d) {
        $renderer = new \gdb\renderer();
        $renderer->name_recette = $d->name_recette;
        $renderer->description = $d->description;
        $renderer->Imgsrc = $d->Imgsrc;
        $renderer->getHTML();
    }
}else

?>
    <section class="liste_recette">
<?php if($radio) {
    foreach ($radio as $d) {
        $renderer = new \gdb\renderer();
        $renderer->name_recette = $d->name_recette;
        $renderer->description = $d->description;
        $renderer->Imgsrc = $d->Imgsrc;
        $renderer->getHTML();
    }
}
?>



<?php $content=ob_get_clean() ?>
<?php \recettes\Template::render($content) ?>