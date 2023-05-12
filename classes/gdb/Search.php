<?php

namespace gdb;
use \pdo_wrapper\PdoWrapper;
class Search extends PdoWrapper
{
    public const UPLOAD_DIR = "images/" ;

    public function __construct($db_name, $db_host = '127.0.0.1', $db_port = '3306', $db_user = 'root', $db_pwd = '')
    {
        parent::__construct($db_name, $db_host, $db_port, $db_user, $db_pwd);
    }

        public function getRecetteBySeach(){
            if(isset($_POST["search"])) {
                $search = $_POST["search"];
                $query = "SELECT * FROM recette ";



                $query .= "WHERE EXISTS (
                    SELECT *
                    FROM listeingredient 
                    JOIN ingredient ON listeingredient.idIngredient = ingredient.idIngredient 
                    WHERE listeingredient.idRecette = recette.idRecette 
                    AND ingredient.name_ingredient LIKE '%$search%') ";

                $query .= "OR EXISTS (
                   SELECT *
                   FROM listetags 
                   JOIN tag ON listetags.idTag=tag.idTag 
                   WHERE listetags.idRecette = recette.idRecette 
                   AND tag.nomTag LIKE '%$search%')";

                $query .= "OR recette.name_recette LIKE '%$search%'";

                 $results=$this->exec($query,null);




                return $results;
            }
        }


    public function getRecetteByRadio(){
        if (isset($_POST['menu-item'])) {
            $items = $_POST['menu-item'];
            if(!empty($items)){
                $items = array_map(function($value) {
                    return "'" . $value . "'";
                }, $items);
                $items_str = implode("','", $items);
                $query = "SELECT * FROM recette 
        JOIN listetags ON recette.idRecette = listetags.idRecette 
        JOIN tag ON listetags.idTag=tag.idTag 
        WHERE tag.nomTag IN ($items_str)";
                return $this->exec($query,null);
            }
        }
    }
}
