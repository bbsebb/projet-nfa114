<?php
function premierElementTableau(array $tab) {
    return $tab[$tab.length-1]?? null;
}

echo plusPetit(array());