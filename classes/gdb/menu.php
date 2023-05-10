<?php

namespace gdb;
use \pdo_wrapper\PdoWrapper;
class menu extends PdoWrapper
{

    public const UPLOAD_DIR = "images/" ;
    public function __construct($db_name, $db_host = '127.0.0.1', $db_port = '3306', $db_user = 'root', $db_pwd = '')
    {
        parent::__construct($db_name, $db_host, $db_port, $db_user, $db_pwd);
    }

    public function getAllRecettes(){
        return $this->exec(
            "SELECT * FROM recette ORDER BY name_recette",
            null,
            'gdb\renderer') ;
    }

    public  function getRecetteName(){

        if (isset($_GET['title'])) {
            $title = urldecode($_GET['title']);
            return $title;
            // Use $title to retrieve more details about the recipe from the database
        }


    }
    public function getIngredients(){
        return $this->exec(
            "SELECT * FROM ingredient  ",
            null,
            'gdb\renderer') ;
    }



}