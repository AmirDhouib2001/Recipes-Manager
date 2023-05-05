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
    $Tag = $_POST['Tag'] ;
    $ingredients=$_POST['ingredients'];
    if (!empty($tag) and !empty($Nom_Recette) and !empty($ingredients)){
        //TODO Ajouter requete SQL POUR LA NOUVELLE RECETTE
        header("Location: /projetweb/index.php");
        exit() ;
    }
}
ob_start();
$recette->generate_recipe_form();
$code=ob_get_clean();
Template::render($code);