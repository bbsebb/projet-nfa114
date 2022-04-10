<?php

use App\utils\forms\visitors\VisiteurToHTML;
?>
<h1><?= $this->bind["title"]  ?></h1>
<span class="error"><?= $this->bind['errorMessage']??"" ?></span>
<?= $this->bind["form"]->accept(new  VisiteurToHTML())  ?>