<?php

namespace gdb;

class renderer
{
    public function getHTML(){ ?>
        <article>
            <div class="image recette">
                <?php if($this->Imgsrc != null) : ?>

                    <img src="<?= $GLOBALS['DOCUMENT_DIR'] . "../" . \gdb\menu::UPLOAD_DIR . $this->Imgsrc ?>">

                <?php endif; ?>
            <h3><?= $this->name ?></h3>

                <div class="overlay overlay1">
                    <h4><Ingredients></h4>
                    <?= $this->description ?>

                </div>
            </div>
        </article>

    <?php }


}