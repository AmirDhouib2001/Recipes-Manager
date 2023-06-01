<?php
require __DIR__ . '/../classes/Autoloader.php';
Autoloader::register();
session_start();
ob_start();
// Connexion à la BDD
$db_name = "recettes";
$db_host = "127.0.0.1";
$db_port = "3306";
$db_user = "root";
$db_pwd = "";

try {
    $dsn = 'mysql:dbname=' . $db_name . ';host=' . $db_host . ';port=' . $db_port;
    $pdo = new PDO($dsn, $db_user, $db_pwd);
} catch (\Exception $ex) {
    die("Erreur : " . $ex->getMessage());
}

if (!empty($_POST)) {
    if (
        !empty($_POST['title']) && !empty($_POST['descr']) && !empty($_POST['cat']) && !empty($_POST['fileInput'])
    ) {
        $title = htmlspecialchars($_POST['title']);
        $descr = htmlspecialchars($_POST['descr']);
        $cat = htmlspecialchars($_POST['cat']);
        $fileInput = htmlspecialchars($_POST['fileInput']);

        $inserer = "INSERT INTO `recettes`.`recette` (`name_recette`, `description`, `catégorie`, `Imgsrc`) VALUES (:title, :descr, :cat, :fileInput)";

        $statements = $pdo->prepare($inserer);
        $statements->bindValue(":title", $title, PDO::PARAM_STR);
        $statements->bindValue(":descr", $descr);
        $statements->bindValue(":cat", $cat, PDO::PARAM_STR);
        $statements->bindValue(":fileInput", $fileInput, PDO::PARAM_STR);

        $statements->execute() or die(var_dump($statements->errorInfo()));

        // Récupérer l'id de la recette insérée
        $lastInsertedRecetteId = $pdo->lastInsertId();

        // Ajouter les ingrédients
        $ingredientsString = htmlspecialchars($_POST['ingredients']);
        $ingredients = explode(",", $ingredientsString);

        foreach ($ingredients as $ingredient) {
            $existingIngredientQuery = "SELECT idIngredient FROM ingredient WHERE name_ingredient = :ingredientName";
            $existingIngredientStatement = $pdo->prepare($existingIngredientQuery);
            $existingIngredientStatement->bindValue(':ingredientName', trim($ingredient));
            $existingIngredientStatement->execute();

            if ($existingIngredientStatement->rowCount() === 0) {
                $insertIngredientQuery = "INSERT INTO ingredient (name_ingredient) VALUES (:ingredientName)";
                $insertIngredientStatement = $pdo->prepare($insertIngredientQuery);
                $insertIngredientStatement->bindValue(':ingredientName', trim($ingredient));
                $insertIngredientStatement->execute();
            }

            $getIngredientIdQuery = "SELECT idIngredient FROM ingredient WHERE name_ingredient = :ingredientName";
            $getIngredientIdStatement = $pdo->prepare($getIngredientIdQuery);
            $getIngredientIdStatement->bindValue(':ingredientName', trim($ingredient));
            $getIngredientIdStatement->execute();

            if ($getIngredientIdStatement->rowCount() > 0) {
                $ingredientId = $getIngredientIdStatement->fetch(PDO::FETCH_COLUMN);
                $insertIngredientRecetteQuery = "INSERT INTO listeingredient (idRecette, idIngredient) VALUES (:recetteId, :ingredientId)";
                $insertIngredientRecetteStatement = $pdo->prepare($insertIngredientRecetteQuery);
                $insertIngredientRecetteStatement->bindValue(':recetteId', $lastInsertedRecetteId);
                $insertIngredientRecetteStatement->bindValue(':ingredientId', $ingredientId);
                $insertIngredientRecetteStatement->execute();
            }
        }

        // Ajouter les tags
        $tagsString = htmlspecialchars($_POST['tags']);
        $tags = explode(",", $tagsString);

        foreach ($tags as $tag) {
            $existingTagQuery = "SELECT idTag FROM tag WHERE nomTag = :tagName";
            $existingTagStatement = $pdo->prepare($existingTagQuery);
            $existingTagStatement->bindValue(':tagName', trim($tag));
            $existingTagStatement->execute();

            if ($existingTagStatement->rowCount() === 0) {
                $insertTagQuery = "INSERT INTO tag (nomTag) VALUES (:tagName)";
                $insertTagStatement = $pdo->prepare($insertTagQuery);
                $insertTagStatement->bindValue(':tagName', trim($tag));
                $insertTagStatement->execute();
            }

            $getTagIdQuery = "SELECT idTag FROM tag WHERE nomTag = :tagName";
            $getTagIdStatement = $pdo->prepare($getTagIdQuery);
            $getTagIdStatement->bindValue(':tagName', trim($tag));
            $getTagIdStatement->execute();

            if ($getTagIdStatement->rowCount() > 0) {
                $tagId = $getTagIdStatement->fetch(PDO::FETCH_COLUMN);
                $insertTagRecetteQuery = "INSERT INTO listetags (idRecette, idTag) VALUES (:recetteId, :tagId)";
                $insertTagRecetteStatement = $pdo->prepare($insertTagRecetteQuery);
                $insertTagRecetteStatement->bindValue(':recetteId', $lastInsertedRecetteId);
                $insertTagRecetteStatement->bindValue(':tagId', $tagId);
                $insertTagRecetteStatement->execute();
            }
        }

        echo "<h1 style='text-align: center; color: green'> Recette ajoutée </h1>";
    } else {
        die("compléter le formulaire");
    }
}

?>

    <div id="container">
        <form method="post">
            <label for="title">Nom de Recettes</label>
            <input type="text" id="title" name="title" placeholder="">

            <label for="descr">description des recettes</label>
            <input type="text" id="descr" name="descr" placeholder="">

            <label for="cat">Catégorie</label>
            <input type="text" id="cat" name="cat" placeholder="Entrée,Plat de résistance,Dessert">

            <label for="ingredients">Ingrédients (séparés par des virgules)</label>
            <input type="text" id="ingredients" name="ingredients" placeholder="">

            <label for="tags">Tags (séparés par des virgules)</label>
            <input type="text" id="tags" name="tags" placeholder="">

            <div class="mb-3">
                <p>Image</p>
                <div class="card" id="preview">
                    <label for="fileInput" class="form-label" style="display: flex; justify-content: center">
                        <img style="border: 1px black solid; width: 100px; height: 100px" id="preview-image" src=""/>
                    </label>
                </div>
                <input class="form-control" type="file" id="fileInput" name="fileInput" accept="image/png, image/gif, image/jpeg">
            </div>

            <div class="mb-3">
                <button id="submit-button" type="submit" class="btn btn-primary" style="width: 100%" disabled>Envoyer</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const submitButton = document.getElementById("submit-button");
            const preview = document.getElementById("preview-image");
            const reader = new FileReader();

            reader.onload = (e) => {
                preview.src = reader.result;
            };

            const fileInput = document.getElementById("fileInput");
            fileInput.addEventListener('change', () => {
                let file = fileInput.files[0];

                if (file && file.type.split('/')[0] === "image") {
                    reader.readAsDataURL(fileInput.files[0]);
                    submitButton.disabled = false;
                } else {
                    submitButton.disabled = true;
                    preview.src = "";
                }
            });
        });
    </script>


<?php


$code = ob_get_clean();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Le formulaire a été soumis, traiter les données ici
    // ...
    // Rediriger ou afficher un message de succès, etc.
}

\recettes\Template::render($code);
?>