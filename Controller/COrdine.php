<?php

require_once 'Indice.php';

class COrdine
{

    public function prova()
    {
        $smarty = ConfSmarty::configuration();

        $smarty->assign('sede', 'Via Michelangelo');
        $smarty->display('EffettuaOrdine.html');

    }

    public function EffettuaOrdine()
    {
print ("dasfesfda");
    }


    public function MostraListaProdotti()

    {
        $view = new VOrdine();

        $antipasti = FRistorante::loadProdottiByCategoria("Antipasti");
        $primi = FRistorante::loadProdottiByCategoria("Primi");
        $secondi = FRistorante::loadProdottiByCategoria("Secondi");
        $contorni = FRistorante::loadProdottiByCategoria("Contorni");
        $pizze = FRistorante::loadProdottiByCategoria("Pizze");
        $dolci = FRistorante::loadProdottiByCategoria("Dolci");
        $bevande = FRistorante::loadProdottiByCategoria("Bevande");

        $cate = array('Antipasti','Primi','Secondi','Contorni','Pizze','Dolci','Bevande');
        $view->MostraListaProdotti($antipasti, $primi, $secondi, $contorni, $pizze, $dolci, $bevande, $cate);
    }
}