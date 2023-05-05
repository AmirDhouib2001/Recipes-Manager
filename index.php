<?php
require "classes/Autoloader.php";
Autoloader::register();

use classes\recettes\Template;

session_start();
?>

<?php ob_start() ?>
<div class="">
    <?php echo __DIR__ ?>
</div>
<?php $code = ob_get_clean() ?>
<?php Template::render($code);?>
