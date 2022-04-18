<h2><?= $this->bind['title']?></h2>
<div id="container-page" >
<?= $this->bind['errorMessage']??"" ?>
<?= $this->bind["form"]  ?>
<div class="legend">
    Première fois sur le cabinet : 
    
    <a href="<?= $GLOBALS['_router']->generate('signup') ?>">S'inscrire</a>
    
</div>
</div>