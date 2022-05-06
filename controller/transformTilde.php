<?php
 function Sustituto_Cadena($rb){ 
        $rb = str_replace("Ã¡", "&aacute;", $rb);
        $rb = str_replace("Ã©", "&eacute;", $rb);
        $rb = str_replace("Â®", "&reg;", $rb);
        $rb = str_replace("Ã­", "&iacute;", $rb);
        $rb = str_replace("ï¿½", "&iacute;", $rb);
        $rb = str_replace("Ã³", "&oacute;", $rb);
        $rb = str_replace("Ãº", "&uacute;", $rb);
        $rb = str_replace("n~", "&ntilde;", $rb);
        $rb = str_replace("Âº", "&ordm;", $rb);
        $rb = str_replace("Âª", "&ordf;", $rb);
        $rb = str_replace("ÃƒÂ¡", "&aacute;", $rb);
        $rb = str_replace("Ã±", "&ntilde;", $rb);
        $rb = str_replace("Ã‘", "&Ntilde;", $rb);
        $rb = str_replace("ÃƒÂ±", "&ntilde;", $rb);
        $rb = str_replace("n~", "&ntilde;", $rb);
        $rb = str_replace("Ãš", "&Uacute;", $rb);
        return $rb;
    }  
?>