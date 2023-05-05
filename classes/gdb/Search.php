<?php

namespace gdb;
use \pdo_wrapper\PdoWrapper;
session_start();
class Search extends PdoWrapper
{

    public function __construct($db_name, $db_host = '127.0.0.1', $db_port = '3306', $db_user = 'root', $db_pwd = 'root')
    {
        parent::__construct($db_name, $db_host, $db_port, $db_user, $db_pwd);
    }

    public function getRecetteBySeach(){
        if(isset($_POST["search"])) {
            $search = $_POST["search"];
            $query = "SELECT recette.* FROM recette ";

            $query .= "WHERE recette.name_recette LIKE '%$search%' ";

            $query .= "OR EXISTS (SELECT * FROM recette_ingredients 
                              JOIN ingredients ON recette_ingredients.ingredient_id = ingredients.id 
                              WHERE recette_ingredients.recette_id = recette.id 
                              AND ingredients.name LIKE '%$search%') ";

            $query .= "OR EXISTS (SELECT * FROM recette_tags 
                              JOIN tags ON recette_tags.tag_id = tags.id 
                              WHERE recette_tags.recette_id = recette.id 
                              AND tags.name LIKE '%$search%')";

            return $this->exec($query);
        }
    }
    public function getRecetteByRadio(){
        if(isset($_POST["menu-item"])){
            $radio=$_POST['menu-item'];
            $query="SELECT * FROM recette_tags 
                              JOIN tags ON recette_tags.tag_id = tags.id 
                              WHERE recette_tags.recette_id = recette.id 
                              AND tags.name LIKE '%$radio%')";
            return $this->exec($query);
        }
    }
}