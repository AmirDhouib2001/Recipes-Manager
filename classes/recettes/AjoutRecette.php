<?php

namespace recettes;

class AjoutRecette
{
        function generate_recipe_form() {
            // Générer les champs d'ingrédients
            $max_ingredients = 10;
            echo '<label for="nbre ingrediant"> ';
            for ($i = 1; $i <= $max_ingredients; $i++) {
                echo '<label for="ingredient'.$i.'">Ingredient '.$i.': </label><input type="text" id="ingredient'.$i.'" name="ingredients[]" /><br />';
            }

            // Générer les autres champs du formulaire
            echo '<label for="recipe_name">Nom de la recette: </label><input type="text" id="recipe_name" name="recipe_name" /><br />';
            echo '<label for="recipe_description">Description de la recette: </label><textarea id="recipe_description" name="recipe_description"></textarea><br />';
            echo '<label for="recipe_tags">Tags de la recette: </label><input type="text" id="recipe_tags" name="recipe_tags" /><br />';
        }


}