<?php
require "classes/Autoloader.php";
Autoloader::register();

use classes\recettes\Template;

session_start();
?>

<?php ob_start() ?>
<div class="welcome">
    Welcome
</div>
<?php $code = ob_get_clean() ?>
<?php \recettes\Template::render($code);?>
