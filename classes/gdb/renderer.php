<?php

namespace gdb;
use gdb\menu;

class renderer
{



    public function getHTML(){ ?>


        <article>
<h2><a href="recette.php?title=<?= urlencode($this->name_recette) ?>"><?= $this->name_recette ?></a></h2>
            <div class="imagerecette">
                <?php if($this->Imgsrc != null) : ?>
                    <img src="<?= "/projetweb" . "/" . \gdb\Search::UPLOAD_DIR . $this->Imgsrc ?>">

                <?php endif; ?>



        </article>


    <?php }

    public function getHTMLingredient(){ ?>
        <div class="wrapper">
            <article>
                <h2><a href="?title=<?= urlencode($this->name_ingredient) ?>"><?= $this->name_ingredient ?></a></h2>
                <div class="imagerecette">
                    <?php if($this->imgsrc != null) : ?>
                    <img src="<?= "/projetweb" . "/" . \gdb\Search::UPLOAD_DIR . $this->imgsrc ?>">

                <?php endif; ?>


                <div class="overlay overlay1">

                </div>
            </article>
        </div>


    <?php }

        public function getHTMLdescription1(){ ?>

            <article>
                <div class="desc">
                <?= $this->description ?>

                </div>
            </article>


    <?php }
     public function generatebutton(){ ?>
         <?php $logged=isset($_SESSION['nickname']) ?>
         <?php if($logged):?>

             <form method="post">
                <button name="delete" type="submit" class="buttondetruire" onclick="confirmdelete()">Detruire</button>
             </form>
             <form action="/projetweb/elements/modifier.php" method="post">


             <button name="modifier" type="submit" class="buttonmodifier">Modifier</button>
             <form method="post">

         <?php endif; ?>

<?php
     }


}?>