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
    public function generateModificationForm(string $action = '/', string $username = null, $message = null): void
    {
        $tags = $this->getTags();
        $selectedTags = $this->getSelectedTags();
        $ingredients = $this->getIngredients();
        $selectedIngredients = $this->getSelectedIngredients();

        if (isset($_POST['modifier'])) :
            ?>
            <form method="post" action="<?php $action?>" class="card" id="login-form1" enctype="multipart/form-data">
                <legend style="text-align: center">Modification</legend>
                <div class="form-group">
                    <input type="text" name="NomRecette" placeholder="Nom de la Recette" value="<?php echo $username ?>" autofocus>
                    <input type="text" name="Description" placeholder="Description">

                    <div>
                        Tags:
                        <?php foreach ($tags as $tag) : ?>
                            <input type="checkbox" name="Tags[]" value="<?php echo $tag->nomTag; ?>" <?php echo (in_array($tag->nomTag, $selectedTags)) ? 'checked' : ''; ?>>
                            <?php echo $tag->nomTag; ?>
                        <?php endforeach; ?>
                    </div>

                    <div>
                        Ingredients:
                        <?php foreach ($ingredients as $ingredient) : ?>
                            <input type="checkbox" name="Ingredients[]" value="<?php echo $ingredient->name_ingredient; ?>" <?php echo (in_array($ingredient->name_ingredient, $selectedIngredients)) ? 'checked' : ''; ?>>
                            <?php echo $ingredient->name_ingredient; ?>
                        <?php endforeach; ?>
                    </div>

                    <div>
                        Upload Image:
                        <input type="file" name="Image">
                    </div>
                </div>

                <button type="submit" name="modification" class="btn btn-outline-danger">MODIFIER</button>
            </form>
        <?php
        endif;
    }

    public function getSelectedTags()
    {
        $name = $this->getRecetteName();
        $selectedTags = $this->exec(
            "SELECT tag.nomTag
        FROM tag
        JOIN listetags ON tag.idTag = listetags.idTag
        JOIN recette ON listetags.idRecette = recette.idRecette
        WHERE recette.name_recette LIKE '%$name%'",
            null
        );

        if ($selectedTags) {
            return array_column($selectedTags, 'nomTag');
        }

        return [];
    }


    public function updateRecipe($new_name, $new_description)
    {
        // Update the recipe in the database using the recipe ID
        if (isset($_POST["modification"])) {
            $name = $this->getRecetteName();
            $query1 = "SELECT idRecette FROM recette WHERE recette.name_recette LIKE '$name'";
            $result = $this->exec($query1, null);

            if (!$result) {
                echo "Recipe not found.";
                return;
            }

            $id = $result[0]->idRecette;

            // Update recipe details
            $query = "UPDATE recette SET name_recette='$new_name', description='$new_description' WHERE idRecette='$id'";
            $this->exec($query, null);

            // Handle ingredient deletion
            $selectedIngredients = $_POST['Ingredients'] ?? array();
            $this->deleteUnusedIngredients($id, $selectedIngredients);

            // Handle tag deletion
            $selectedTags = $_POST['Tags'] ?? array();
            $this->deleteUnusedTags($id, $selectedTags);

            // Handle image upload
            if (isset($_FILES['Image']) && $_FILES['Image']['error'] === UPLOAD_ERR_OK) {
                $image_name = $_FILES['Image']['name'];
                $image_tmp = $_FILES['Image']['tmp_name'];
                $image_size = $_FILES['Image']['size'];
                // Check if the uploaded file is an image
                if (exif_imagetype($image_tmp)) {
                    // Specify the target directory to store the uploaded image
                    $target_dir = "/projetweb/images/";
                    $target_file = $target_dir . basename($image_name);
                    // Move the uploaded image to the target directory
                    if (move_uploaded_file($image_tmp, $target_file)) {
                        // Update the image source in the database
                         $queryUpdateImage = "UPDATE recette SET Imgsrc='$target_file' WHERE idRecette='$id'";
                         $this->exec($queryUpdateImage, null);
                    } else {
                        echo "Failed to upload the image."
                        ; }
                } else { echo "Invalid image file.";
                } }


        }
    }

    public function deleteUnusedIngredients($recipeId, $selectedIngredients)
    {
        $query = "DELETE FROM listeingredient WHERE idRecette='$recipeId'";
        $this->exec($query, null);

        if (!empty($selectedIngredients)) {
            $selectedIngredients = array_map(function ($ingredient) {
                return "'$ingredient'";
            }, $selectedIngredients);

            $selectedIngredientsStr = implode(',', $selectedIngredients);
            $query = "INSERT INTO listeingredient (idRecette, idIngredient) 
                  SELECT '$recipeId', idIngredient FROM ingredient WHERE name_ingredient IN ($selectedIngredientsStr)";
            $this->exec($query, null);
        }
    }
    public function getSelectedIngredients() {
        $name = $this->getRecetteName();
        $selectedIngredients = $this->exec( "SELECT ingredient.name_ingredient FROM ingredient JOIN listeingredient ON ingredient.idIngredient = listeingredient.idIngredient
        JOIN recette ON listeingredient.idRecette = recette.idRecette 
        WHERE recette.name_recette LIKE '%$name%'",
            null, 'gdb\renderer' );
        if ($selectedIngredients) { return array_column($selectedIngredients, 'name');
        } return [];
    }
    public function deleteUnusedTags($recipeId, $selectedTags)
    {
        $query = "DELETE FROM listetags WHERE idRecette='$recipeId'";
        $this->exec($query, null);

        if (!empty($selectedTags)) {
            $selectedTags = array_map(function ($tag) {
                return "'$tag'";
            }, $selectedTags);

            $selectedTagsStr = implode(',', $selectedTags);
            $query = "INSERT INTO listetags (idRecette, idTag) 
                  SELECT '$recipeId', idTag FROM tag WHERE nomTag IN ($selectedTagsStr)";
            $this->exec($query, null);
        }
    }
    public function getTags(){
        $name=$this->getRecetteName();
        return $this->exec(
            "SELECT tag.nomTag  
FROM tag
JOIN listetags  ON tag.idTag = listetags.idTag
JOIN recette  ON listetags.idRecette = recette.idRecette 
WHERE recette.name_recette LIKE '%$name%'",
            null) ;
    }




}