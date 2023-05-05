<?php
require __DIR__ . '/../classes/Autoloader.php';
Autoloader::register();
session_start();

use classes\recettes\Template;
use recettes\AjoutRecette;

$recette=new AjoutRecette();

if (isset($_POST['Nom_Recette']) and isset($_POST['Tag'])){
    //recupere les données de la nouvelles recette
    $Nom_Recette = $_POST['Nom_Recette'] ;
    $Imgsrc = $_POST['Imgsrc'] ;
    $description=$_POST['description'];
    if (!empty($tag) and !empty($Nom_Recette) and !empty($ingredients)){
        createRecette($Nom_Recette,$description,$Imgsrc);
        header("Location: /projetweb/index.php");
        exit() ;
    }
}
ob_start();
$recette->generate_recipe_form();
$code=ob_get_clean();
Template::render($code);