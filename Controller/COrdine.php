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


    }

    public function InfoRistorante()
    {
        //mancano giorni di apertura
        FRistorante::loadRistorante();
        $luogo = ERistorante::getSede();
        $sede = $luogo->getComune().","."Via"." ".$luogo->getVia()." ".$luogo->getN_Civico();
       $cellulare = ERistorante::getCellulare();
       $telefono_fisso = ERistorante::getTelefonoFisso();
       $nome_proprietario = ERistorante::getProprietario();
       $giudizio_complessivo = ERistorante::getGiudizioComplessivo();
       $stato_apertura = ERistorante::getStatoApertura();
        $array_giorni = array('Lunedì: 08:00-17:00', 'Martedì: 09:30-19:40', 'Mercoledì: 09:30-19:40', 'Giovedì: 09:30-19:40',  'Venerdì: 09:30-19:40', 'Sabato: 09:30-19:40',  'Domenica: Chiuso');
       // $giorni_di_apertura = ERistorante::getGiorniDiApertura();
        if ($stato_apertura == true)
           $stato_apertura = "SI";
       else
           $stato_apertura = "NO";
        $view = new VOrdine();
        $smarty = $view->InfoRistorante($sede ,$cellulare ,$telefono_fisso ,$nome_proprietario , $giudizio_complessivo,$stato_apertura ,  $array_giorni   );
         return $smarty;
    }

}