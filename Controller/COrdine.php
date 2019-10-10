<?php

require_once 'Indice.php';

class COrdine
{


    public function EffettuaOrdine()
    {

        //creo array chiava valore con i soli valori di quantita diversi da zero
        $prodotti = array();
        $ordine_parziale = new EOrdine($prodotti);
        $prezzo = 0;

        foreach ($_POST as  $key => $value)
        {
            if($value != 0) {
               $prodotto = FProdotto::load($key);
               $ordine_parziale->addSingoloProdotto($prodotto, $value);
               $prezzo = $ordine_parziale->getPrezzoTotale();
            }
        }
        session_start();
        $_SESSION['ordine_parziale'] = $ordine_parziale;
        $_SESSION['prezzo_totale'] = $prezzo;

        $view = new VOrdine();
        $smarty = self::InfoRistorante();
        if(!CUtente::isLogged())$smarty->assign('logged', false);
        else $smarty->assign('logged', true);
        $punti = (FUtente::load($_SESSION['username']))->getPunti();
        $view->RiepilogoOrdine($smarty,$punti);


    }


    public function MostraListaProdotti()

    {
// fare le assegazioni di logged nella view e non qio nel controller
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

        if(!CUtente::isLogged())$smarty->assign('logged', false);
        else $smarty->assign('logged', true);
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

    public function SceltaTipoPagamento()
    {
        session_start();
        $data = $_POST['dataconsegna'].' '.$_POST['oraconsegna'].':'.'00';
        $data_consegna = DateTime::createFromFormat('Y-m-d H:i:s', $data);
        $_SESSION['ordine_parziale']->setDataConsegna($data_consegna);
        $luogo = new ELuogo($_POST['Comune'], "L'Aquila", $_POST['Via'], $_POST['N_Civico']);
        $_SESSION['ordine_parziale']->setLuogoConsegna($luogo);
        $_SESSION['ordine_parziale']->setTelefonoConsegna($_POST['telefono']);
        $_SESSION['ordine_parziale']->setNota($_POST['note']);
        $_SESSION['ordine_parziale']->setPuntiUsati($_POST['punti_usati']);

        $view = new VOrdine();
        //$view->SceltaTipoPagamento();
    }

    public function MostraDatiPagamento()
    {
        $view = new VOrdine();
        $view->MostraDatiPagamento();
    }

}