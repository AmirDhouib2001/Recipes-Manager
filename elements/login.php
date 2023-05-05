<?php
require __DIR__ . '/../classes/Autoloader.php';
Autoloader::register();
session_start() ;

use recettes\Template ;
use recettes\Logger ;

$logger = new Logger() ;

$username = null;
$password = null ;
if (isset($_POST['username']) and isset($_POST['password'])){
    $username = $_POST['username'] ;
    $password = $_POST['password'] ;
    $response = $logger->log(trim($username), trim($password)) ;
    if ($response['granted']){
        $_SESSION['nickname'] = $response['nick'] ;
        header("Location: /projetweb/index.php");
        exit() ;
    }
}

ob_start() ;

if (!isset($response)) :
    $logger->generateLoginForm("", $username);
elseif (!$response['granted']) :
    echo "<div class='recettess' id='error'>" .$response['error']."</div>" ;
    $logger->generateLoginForm("", $username, $response['error']);
endif;

$code = ob_get_clean() ;
Template::render($code);