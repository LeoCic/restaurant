<?php

require_once '../Indice.php';

class COrdine
{

    public function prova()
    {
        $smarty = new Smarty();
        $smarty->display('DatiPagamento.html');
    }
}