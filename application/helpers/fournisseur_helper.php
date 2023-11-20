<?php 
    function compareAndMergeArrays($tab1, $tab2) {
        $result = [];
    
        foreach ($tab1 as $item1) {
            // Chercher un élément correspondant dans le tableau 2
            $matchingItem2 = array_filter($tab2, function ($item2) use ($item1) {
                return $item2->idarticle == $item1['idarticle'];
            });
    
            // Si une correspondance est trouvée, utilisez-la, sinon utilisez une valeur par défaut
            $isChecked = !empty($matchingItem2);
            $item1['checked'] = $isChecked;
    
            $result[] = $item1;
        }
    
        return $result;
    }
?>
