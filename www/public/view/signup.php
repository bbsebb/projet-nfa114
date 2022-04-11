<?php

use App\utils\forms\visitors\VisiteurToHTML;
?>
<h1><?= $this->bind['title']?></h1>
<?= $this->bind['form']->accept(new  VisiteurToHTML()) ?>