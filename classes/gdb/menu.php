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

    public function getRecettedescription(){
        $name=$this->getRecetteName();
        return $this->exec(
            "SELECT recette.description FROM recette WHERE recette.name_recette LIKE  '%$name%'",
            null,
            'gdb\renderer') ;
    }
    public function getIngredients(){
        $name=$this->getRecetteName();
        return $this->exec(
            "SELECT *  
FROM ingredient
JOIN listeingredient  ON ingredient.idIngredient = listeingredient.idIngredient 
JOIN recette  ON listeingredient.idRecette = recette.idRecette 
WHERE recette.name_recette LIKE  '%$name%'",
            null,
            'gdb\renderer') ;
    }
    public function DeleteRecette() {
        if (isset($_POST["delete"])) {
            $name = $this->getRecetteName();
            $query = "SELECT idRecette from recette WHERE name_recette='$name'";
            $params = array(':name' => $name);
            $result = $this->exec($query, null);
            $id = $result[0]->idRecette;
            $query2 = "DELETE FROM recette WHERE idRecette='$id'";
            $params2 = array(':id' => $id);
            $this->exec($query2, null);
            header("Location: /projetweb/elements/menu.php");
            exit();
        }
    }

    public function generateModificationForm(string $action='/', string $username=null, $message=null): void{
        if (isset($_POST['modifier'])): ?>
        <form method="post" action="<?php $action ?>" class="card" id="login-form1">
            <legend style="text-align: center">Modification</legend>
            <div class="form-group">
                <input type="text" name="NomRecette" placeholder="Nom de la Recette" value="<?php echo $username ?>" autofocus>
                <input type="text" name="Description" placeholder="Description">
            </div>
            <button type="submit"  name ="modification"class="btn btn-outline-danger">MODIFIER</button>
        </form>
        <?php endif; ?>

        <?php
    }
    public function updateRecipe( $new_name, $new_description) {
        // Update the recipe in the database using the recipe ID
        if (isset($_POST["modification"]))
        $name=$this->getRecetteName();
        $query1 = "SELECT idRecette from recette WHERE name_recette='$name'";
        $result = $this->exec($query1, null);
        $id = $result[0]->idRecette;
        $query = "UPDATE recette SET name_recette='$new_name', description='$new_description' WHERE idRecette='$id'";
        $this->exec($query, null);
        echo "Recipe updated successfully!";
        header("Location: /projetweb/elements/menu.php");
    }






}