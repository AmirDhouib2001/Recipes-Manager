<?php

namespace gdb;
use gdb\menu;
class renderer
{


    public function getHTML(){ ?>
        <div class="wrapper">
        <article>
            <h1><?= $this->name_recette ?></h1>
            <div class="imagerecette">
                <?php if($this->Imgsrc != null) : ?>
                    <img src="<?= $GLOBALS['DOCUMENT_DIR'] . "../" . \gdb\menu::UPLOAD_DIR . $this->Imgsrc ?>

                <?php endif; ?>
            <h3><?= $this->name_recette ?></h3>

                <div class="overlay overlay1">
                    <?= $this->description ?>

                </div>
            </div>
        </article>

    <?php }


}