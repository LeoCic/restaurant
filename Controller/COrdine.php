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
            }
        }
        if( !isset($prodotto))
        {
            print("Scegli almeno un prodotto");
            header("Refresh:2; URL=/restaurant/Ordine/MostraListaProdotti");
        }
        else {

            $prezzo = $ordine_parziale->CalcolaPrezzoTotale();
            session_start();
            $_SESSION['ordine_parziale'] = $ordine_parziale;
            $_SESSION['ordine_parziale']->setPrezzoTotale($prezzo);
            $_SESSION['prezzo_totale'] = $prezzo;

            $view = new VOrdine();
            $smarty = self::InfoRistorante();
            if (!CUtente::isLogged()) $smarty->assign('logged', false);
            else $smarty->assign('logged', true);
            $punti = (FUtente::load($_SESSION['username']))->getPunti();
            $view->RiepilogoOrdine($smarty, $punti);

        }
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
        $view->SceltaTipoPagamento();
    }

    public function MostraDatiPagamento()
    {
        $view = new VOrdine();
        $view->MostraDatiPagamento();
    }

    public function PagamentoCarta()
    {
        session_start();

        $_SESSION['ordine_parziale']->setTipoPagamento("Carta");

        if($_SESSION['sconto'] == false) {
            $_SESSION['ordine_parziale']->setPrezzoTotale($_SESSION['ordine_parziale']->CalcolaPrezzoConCarta());
            $_SESSION['ordine_parziale']->setPrezzoTotale($_SESSION['ordine_parziale']->CalcolaPrezzoScontato($_SESSION['ordine_parziale']->getPuntiUsati()));
            $_SESSION['sconto']= true;
        }

        $view = new VOrdine();
        $view->PagamentoCarta();
    }

    public function PagamentoContanti()
    {
        session_start();
        $_SESSION['ordine_parziale']->setTipoPagamento("Contanti");

        if($_SESSION['sconto'] == false) {
            $_SESSION['ordine_parziale']->setPrezzoTotale($_SESSION['ordine_parziale']->CalcolaPrezzoScontato($_SESSION['ordine_parziale']->getPuntiUsati()));
            $_SESSION['sconto']= true;

        }

          header('Location: /restaurant/Ordine/RiepilogoFinale');
    }

    public function RiepilogoFinale()
    {
        session_start();

        $view = new VOrdine();
        $view->RiepilogoFinale();
    }

    public function ConfermaOrdine()
    {
        session_start();
        $dataOrd = new DateTime();
        $_SESSION['ordine_parziale']->setDataOrdinazione($dataOrd);
        $utente = FUtente::load($_SESSION['username']);
        $utente->setPunti($utente->getPunti() - $_SESSION['ordine_parziale']->getPuntiUsati());
        $utente->setDataUltimoOrdine($dataOrd->format('Y-m-d'));
        $utente->setOrdiniCumulati($utente->getOrdiniCumulati() + 1);
        FUtente::update($utente);






        $luogo_consegna = $_SESSION['ordine_parziale']->getLuogoConsegna();
        $Comune = $luogo_consegna->getComune();
        $Via = $luogo_consegna->getVia();
        $N_Civico = $luogo_consegna->getN_Civico();
        $Provincia = "AQ";
        $luogo = new ELuogo($Comune, $Provincia, $Via, $N_Civico);
        $controllo = FLuogo::exist2($Comune, $Via, $N_Civico);
        if($controllo === false) {FLuogo::store($luogo);}

        $IDL = FLuogo::id($Comune,$Via,$N_Civico);




        $_SESSION['ordine_parziale']->setIDLuogo($IDL);
        $luogo->setIDLuogo($IDL);
        $_SESSION['ordine_parziale']->setLuogoConsegna($luogo);
        $_SESSION['ordine_parziale']->setNomeUtente($_SESSION['username']);



        $dataOrdinazione = $_SESSION['ordine_parziale']->getDataOrdinazione();
        $dataConsegna = $_SESSION['ordine_parziale']->getDataConsegna();
        $Nota = $_SESSION['ordine_parziale']->getNota();
        $PrezzoTotale = $_SESSION['ordine_parziale']->getPrezzoTotale();
        $TipoPagamento = $_SESSION['ordine_parziale']->getTipoPagamento();
        $PuntiUsati = $_SESSION['ordine_parziale']->getPuntiUsati();
        $TelefonoConsegna = $_SESSION['ordine_parziale']->getTelefonoConsegna();
        $NomeUtente = $_SESSION['ordine_parziale']->getNomeUtente();



        $ordineFinale = new EOrdine($dataOrdinazione, $dataConsegna, $Nota, $PrezzoTotale, $TipoPagamento, $PuntiUsati, $TelefonoConsegna, $NomeUtente, $IDL);

        print($ordineFinale->toString1());
        FOrdine::store($ordineFinale);


    }



}