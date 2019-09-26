<?php

require_once 'Indice.php';

class COrdine
{


    public function EffettuaOrdine()
    {
        session_start();
        $view = new VOrdine();
        $passato = $_SESSION['Mario'];
        //$view->prova($passato);
        print($passato);



    }


    public function MostraListaProdotti()

    {
        session_start();
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
        print_r($_SERVER['REQUEST_URI']);
        $Mario = 'Mario';
        $_SESSION['Mario'] = $Mario;

        //print_r($_SERVER);
        print_r($_SESSION);
    }
}