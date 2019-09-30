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

        //inietto i valori relativi alla info ristorante
        // e salvo $smarty per poi passarla alla successiva vista
        //in modo da mantenere le inforistorante

        $smarty = self::InfoRistorante();
        //passo smarty per tener conto anche delle info ristorante
        $view->MostraListaProdotti($smarty ,$antipasti, $primi, $secondi, $contorni, $pizze, $dolci, $bevande, $cate);

        /*
         * test sessisoni print_r($_SERVER['REQUEST_URI']);
        $Mario = 'Mario';
        $_SESSION['Mario'] = $Mario;

        //print_r($_SERVER);
        print_r($_SESSION);*/
    }

    public function InfoRistorante()
    {
        FRistorante::loadRistorante();
        $luogo = ERistorante::getSede();
        $sede = $luogo->getComune().","."Via"." ".$luogo->getVia()." ".$luogo->getN_Civico();
       $cellulare = ERistorante::getCellulare();
       $telefono_fisso = ERistorante::getTelefonoFisso();
       $nome_proprietario = ERistorante::getProprietario();
       $giudizio_complessivo = ERistorante::getGiudizioComplessivo();
       $stato_apertura = ERistorante::getStatoApertura();
       if ($stato_apertura == true)
           $stato_apertura = "SI";
       else
           $stato_apertura = "NO";
        $view = new VOrdine();
        $smarty = $view->InfoRistorante($sede ,$cellulare ,$telefono_fisso ,$nome_proprietario , $giudizio_complessivo,$stato_apertura   );
         return $smarty;
    }

}