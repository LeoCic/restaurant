<?php

require_once 'Indice.php';

class COrdine
{

    public function prova()
    {
        print "pippo";
        $smarty = new Smarty();
        $smarty->display('DatiPagamento.html');
    }
}