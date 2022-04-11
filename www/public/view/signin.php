<?php

use App\utils\forms\visitors\VisiteurToHTML;
?>
<h1><?= $this->bind["title"]  ?></h1>
<div id="container-page" >
<?= $this->bind['errorMessage']??"" ?>
<?= $this->bind["form"]->accept(new  VisiteurToHTML())  ?>
<div class="legend">
    Première fois sur le cabinet : 
    
    <a href="<?= $GLOBALS['_router']->generate('signup') ?>">S'inscrire</a>
    
</div>
</div>