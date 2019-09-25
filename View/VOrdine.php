<?php
require_once 'Indice.php';
/**
 * Classe che si occupa dell'input-output dei contenuti riguardanti gli utenti. In particolare della "validazione" dei dati inseriti
 * nelle form richiamando metodi di livello entity e del passaggio degli appositi parametri a Smarty per la costruzione dei template.
 * @package View
 *
 */

class VOrdine
{
    private $smarty;

    public function __construct()
    {
        $this->smarty = ConfSmarty::configuration();
    }

    public function MostraListaProdotti($antipasti, $primi, $secondi, $contorni, $pizze, $dolci, $bevande, $cate)
    {
/*
        $this->smarty->assign('lista_antipasti',$antipasti);
        $this->smarty->assign('lista_primi',$primi);
        $this->smarty->assign('lista_secondi',$secondi);
        $this->smarty->assign('lista_contorni',$contorni);
        $this->smarty->assign('lista_pizze',$pizze);
        $this->smarty->assign('lista_dolci',$dolci);
        $this->smarty->assign('lista_bevande',$bevande);
        $this->smarty->assign('lista_categoria',$cate);
*/






        $antipasti = FRistorante::loadProdottiByCategoria("Antipasti");
        $primi = FRistorante::loadProdottiByCategoria("Primi");
        $secondi = FRistorante::loadProdottiByCategoria("Secondi");
        $contorni = FRistorante::loadProdottiByCategoria("Contorni");
        $pizze = FRistorante::loadProdottiByCategoria("Pizze");
        $dolci = FRistorante::loadProdottiByCategoria("Dolci");
        $bevande = FRistorante::loadProdottiByCategoria("Bevande");


        $prova = 'palla';
        $prova2 = 'palla2';
        $array_giorni = array('Lunedì: 08:00-17:00', 'Martedì: 09:30-19:40', 'Mercoledì: 09:30-19:40', 'Giovedì: 09:30-19:40',  'Venerdì: 09:30-19:40', 'Sabato: 09:30-19:40',  'Domenica: Chiuso');
        $cate = array('Antipasti','Primi','Secondi','Contorni','Pizze','Dolci','Bevande');
        $this->smarty->assign('lista_antipasti',$antipasti);
        $this->smarty->assign('lista_primi',$primi);
        $this->smarty->assign('lista_secondi',$secondi);
        $this->smarty->assign('lista_contorni',$contorni);
        $this->smarty->assign('lista_pizze',$pizze);
        $this->smarty->assign('lista_dolci',$dolci);
        $this->smarty->assign('lista_bevande',$bevande);
        $this->smarty->assign('lista_prodotti',$primi);
        $this->smarty->assign('lista_categoria',$cate);
        $this->smarty->assign('elementi_totali_carrello',0);
        $this->smarty->assign('sede','Via Michelangelo');
        $this->smarty->assign('cellulare',328493920);
        $this->smarty->assign('telefono_fisso',3244244242);
        $this->smarty->assign('nome_proprietario','Giacomo');
        $this->smarty->assign('nome_proprietario','Giacomo');
        $this->smarty->assign('giudizio_complessivo',4.3);
        $this->smarty->assign('giorni_apertura',$array_giorni);
        $this->smarty->assign('prova',$prova);
        $this->smarty->assign('stato_apertura','SI');
        $this->smarty->assign('prova2',$prova2);
        $this->smarty->assign('prezzoTotale',10);
        $this->smarty->assign('quant',3);
        $this->smarty->assign('puntiDisponibili',3422);
        $this->smarty->assign('Totale',99);






        $this->smarty->display('EffettuaOrdine.html');
    }
}