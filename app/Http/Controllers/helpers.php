<?php
    function buttonGenerate($p, $i, $url){
        if($p==$i)
            return '<a href="'.asset($url.$i).'" class="btn ud btn-outline-link active">'.$i.'</a>';
        else
            return '<a href="'.asset($url.$i).'" class="btn ud btn-outline-link">'.$i.'</a>';
    }

?>