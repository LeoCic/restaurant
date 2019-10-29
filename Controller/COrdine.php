<?php

require_once 'Indice.php';

class COrdine
{
    static function EffettuaOrdine()
    {
        if(!CUtente::isLogged())
        {
            print("Non puoi accedere alla pagina se non sei loggato, effettua il login");
            header("Refresh:3; URL=/restaurant/Homepage");
        }
        else
        {
            $prodotti = array();
            $ordine_parziale = new EOrdine($prodotti);

            foreach($_POST as $key => $value)
            {
                if($value != 0)
                {
                    $prodotto = FProdotto::load($key);
                    $ordine_parziale->addSingoloProdotto($prodotto, $value);
                }
            }
            if(!isset($prodotto) && !isset($_COOKIE['carrello']))
            {
                print("Scegli almeno un prodotto");
                header("Refresh:2; URL=/restaurant/Ordine/MostraListaProdotti");
            }
            else
            {
                if(isset($_COOKIE['carrello']))
                {
                    $array1 = array();
                    $prodottiPost = $ordine_parziale->getProdottiOrdinati();
                    if($prodottiPost != null)
                    {
                        $appoggio = $ordine_parziale->getProdottiOrdinati();
                        $prodottiCarrello = unserialize($_COOKIE['carrello']);
                        foreach($prodottiCarrello as $item)
                        {
                            $giaPresente = false;
                            foreach($prodottiPost as $prodottiDaPost)
                            {
                                if($prodottiDaPost[0]->getIDProdotto() == $item[0]->getIDProdotto())
                                {
                                    foreach($appoggio as $app => $val)
                                    {
                                        if($val[0]->getIDProdotto() == $prodottiDaPost[0]->getIDProdotto()) unset($appoggio[$app]);
                                    }
                                    $giaPresente = true;
                                    array_push($array1, $prodottiDaPost[0], $prodottiDaPost[1] + $item[1]);
                                    array_push($appoggio, $array1);
                                    array_pop($array1);
                                    array_pop($array1);
                                }
                            }
                            if($giaPresente === false)
                            {
                                array_push($array1, $item[0], $item[1]);
                                array_push($appoggio, $array1);
                                array_pop($array1);
                                array_pop($array1);
                            }
                        }
                    }
                    else if($prodottiPost == null)
                    {
                        $prodottiCarrello = unserialize($_COOKIE['carrello']);
                        $appoggio = array();
                        foreach($prodottiCarrello as $item)
                        {
                            array_push($array1, $item[0], $item[1]);
                            array_push($appoggio, $array1);
                            array_pop($array1);
                            array_pop($array1);
                        }
                    }
                    $ordine_parziale->setProdottiOrdinati($appoggio);
                }

                $prezzo = $ordine_parziale->CalcolaPrezzoTotale();

                $_SESSION['ordine_parziale'] = $ordine_parziale;
                $_SESSION['ordine_parziale']->setPrezzoTotale($prezzo);
                $_SESSION['prezzo_totale'] = $prezzo;

                $carrello = serialize($_SESSION['ordine_parziale']->getProdottiOrdinati());
                setcookie("carrello","$carrello",time() + 60*60*24*30,"/","",TRUE);

                $view = new VOrdine();
                $smarty = self::InfoRistorante();
                if(!CUtente::isLogged()) {$smarty->assign('logged', false);}
                else {$smarty->assign('logged', true);}
                $punti = (FUtente::load($_SESSION['username']))->getPunti();
                $view->RiepilogoOrdine($smarty, $punti);
            }
        }
    }

    static function MostraListaProdotti()
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

        $smarty = self::InfoRistorante();

        if(!CUtente::isLogged()) {$smarty->assign('logged', false);}
        else {$smarty->assign('logged', true);}

        $view->MostraListaProdotti($smarty ,$antipasti, $primi, $secondi, $contorni, $pizze, $dolci, $bevande, $cate);
    }

    static function InfoRistorante()
    {
        FRistorante::loadRistorante();
        $nome_ristorante = ERistorante::getNome();
        $luogo = ERistorante::getSede();
        $sede = $luogo->getComune().", "."Via"." ".$luogo->getVia()." ".$luogo->getN_Civico();
        $cellulare = ERistorante::getCellulare();
        $telefono_fisso = ERistorante::getTelefonoFisso();
        $nome_proprietario = ERistorante::getProprietario();
        $array_giorni = array('Lunedì: 08:00-17:00', 'Martedì: 09:30-19:40', 'Mercoledì: 09:30-19:40', 'Giovedì: 09:30-19:40',  'Venerdì: 09:30-19:40', 'Sabato: 09:30-19:40',  'Domenica: Chiuso');
        $view = new VOrdine();
        $smarty = $view->InfoRistorante($nome_ristorante, $sede, $cellulare, $telefono_fisso, $nome_proprietario, $array_giorni);
        return $smarty;
    }

    static function SceltaTipoPagamento()
    {
        if(!CUtente::isLogged())
        {
            print("Non puoi accedere alla pagina se non sei loggato, effettua il login");
            header("Refresh:3; URL=/restaurant/Homepage");
        }
        else
        {
            $data = $_POST['dataconsegna'] . ' ' . $_POST['oraconsegna'] . ':' . '00';
            $data_consegna = DateTime::createFromFormat('Y-m-d H:i:s', $data);

            $differenza = $data_consegna->diff(new DateTime());
            if ($differenza->invert === 1)
            {
                $_SESSION['ordine_parziale']->setDataConsegna($data_consegna);
                $luogo = new ELuogo($_POST['city'], "L'Aquila", $_POST['Via'], $_POST['N_Civico']);
                $_SESSION['ordine_parziale']->setLuogoConsegna($luogo);
                $_SESSION['ordine_parziale']->setTelefonoConsegna($_POST['telefono']);
                $_SESSION['ordine_parziale']->setNota($_POST['note']);
                $_SESSION['ordine_parziale']->setPuntiUsati($_POST['punti_usati']);

                $view = new VOrdine();
                $view->SceltaTipoPagamento();
            }
            else
            {
                $view = new VOrdine();
                $smarty = self::InfoRistorante();
                if (!CUtente::isLogged()) { $smarty->assign('logged', false); }
                else { $smarty->assign('logged', true); }
                $punti = (FUtente::load($_SESSION['username']))->getPunti();
                $error = "La data di consegna inserita è errata";
                $view->RiepilogoOrdineErrore($smarty, $punti, $error);
            }
        }
    }

    static function PagamentoCarta()
    {
        if(!CUtente::isLogged())
        {
            print("Non puoi accedere alla pagina se non sei loggato, effettua il login");
            header("Refresh:3; URL=/restaurant/Homepage");
        }
        else
        {
            $_SESSION['ordine_parziale']->setTipoPagamento("Carta");
            if ($_SESSION['sconto'] == false)
            {
                $_SESSION['ordine_parziale']->setPrezzoTotale(round($_SESSION['ordine_parziale']->CalcolaPrezzoConCarta(),2));
                $_SESSION['ordine_parziale']->setPrezzoTotale(round($_SESSION['ordine_parziale']->CalcolaPrezzoScontato($_SESSION['ordine_parziale']->getPuntiUsati()),2));
                $_SESSION['sconto'] = true;
            }

            $view = new VOrdine();
            $view->PagamentoCarta();
        }
    }

    static function PagamentoContanti()
    {
        if(!CUtente::isLogged())
        {
            print("Non puoi accedere alla pagina se non sei loggato, effettua il login");
            header("Refresh:3; URL=/restaurant/Homepage");
        }
        else
        {
            $_SESSION['ordine_parziale']->setTipoPagamento("Contanti");
            if ($_SESSION['sconto'] == false)
            {
                $_SESSION['ordine_parziale']->setPrezzoTotale(round($_SESSION['ordine_parziale']->CalcolaPrezzoScontato($_SESSION['ordine_parziale']->getPuntiUsati()),2));
                $_SESSION['sconto'] = true;
            }
            header('Location: /restaurant/Ordine/RiepilogoFinale');
        }
    }

    static function RiepilogoFinale()
    {
        if(!CUtente::isLogged())
        {
            print("Non puoi accedere alla pagina se non sei loggato, effettua il login");
            header("Refresh:3; URL=/restaurant/Homepage");
        }
        else
        {
            $view = new VOrdine();
            $view->RiepilogoFinale();
        }
    }

    static function ConfermaOrdine()
    {
        if(!CUtente::isLogged())
        {
            print("Non puoi accedere alla pagina se non sei loggato, effettua il login");
            header("Refresh:3; URL=/restaurant/Homepage");
        }
        else
        {
            $dataOrd = new DateTime();
            $_SESSION['ordine_parziale']->setDataOrdinazione($dataOrd);
            $utente = FUtente::load($_SESSION['username']);
            $utente->setPunti($utente->getPunti() - $_SESSION['ordine_parziale']->getPuntiUsati());
            $utente->setDataUltimoOrdine($dataOrd->format('Y-m-d'));
            if ($_SESSION['ordine_parziale']->getPrezzoTotale() >= 10)  { $utente->setPunti($utente->getPunti() + 1); }

            $numero_ordini = $utente->getOrdiniCumulati();
            $numero_ordini = $numero_ordini + 1;
            $utente->setOrdiniCumulati($numero_ordini);
            FUtente::update($utente);

            $luogo_consegna = $_SESSION['ordine_parziale']->getLuogoConsegna();
            $Comune = $luogo_consegna->getComune();
            $Via = $luogo_consegna->getVia();
            $N_Civico = $luogo_consegna->getN_Civico();
            $Provincia = "AQ";
            $luogo = new ELuogo($Comune, $Provincia, $Via, $N_Civico);
            $controllo = FLuogo::exist2($Comune, $Via, $N_Civico);
            if ($controllo === false) { FLuogo::store($luogo); }

            $IDL = FLuogo::id($Comune, $Via, $N_Civico);

            $_SESSION['ordine_parziale']->setIDLuogo($IDL);
            $luogo->setIDLuogo($IDL);
            $_SESSION['ordine_parziale']->setLuogoConsegna($luogo);
            $_SESSION['ordine_parziale']->setNomeUtente($_SESSION['username']);

            $a = FOrdine::store($_SESSION['ordine_parziale']);
            $b = FOrdine::storeECompostoDa($_SESSION['ordine_parziale']->getProdottiOrdinati(), $_SESSION['lastIDOrdine']);
            if ($a === true && $b === true)
            {
                unset($_COOKIE['carrello']);
                setcookie('carrello', null, -1, '/');
                print("Ordine effettuato con successo!! Grazie per aver scelto 'Il Ristorante'!!");
                header("Refresh:2; URL=/restaurant/Homepage");
                $_SESSION['sconto'] = false;
            }
            else
            {
                print("Ordine non effettuato. Riprova.");
                header("Refresh:2; URL=/restaurant/Ordine/SceltaTipoPagamento");
            }
        }
    }

    static function SvuotaCarrello()
    {
        if(!CUtente::isLogged())
        {
            print("Funzione non disponibile se non sei loggato, effettua il login");
            header("Refresh:3; URL=/restaurant/Homepage");
        }
        else
        {
            unset($_COOKIE['carrello']);
            setcookie('carrello', null, -1, '/');
            header('Location: /restaurant/Ordine/MostraListaProdotti');
        }
    }
}