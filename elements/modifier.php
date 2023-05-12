<?php
require __DIR__ . '/../classes/Autoloader.php';
Autoloader::register();
session_start() ;

use gdb\renderer ;
use gdb\menu ;
$button =new renderer();
$gdb = new \gdb\menu("recettes");
ob_start();
if(isset($_POST['modifier'])) {
    $gdb->generateModificationForm();
}

    if (isset($_POST['modification'])) {
        $new_name = $_POST['NomRecette'];
        $new_description = $_POST['Description'];
        // Update the recipe in the database
        $gdb->updateRecipe($new_name, $new_description);
    }


$code = ob_get_clean() ;
\recettes\Template::render($code);
