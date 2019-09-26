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

        $this->smarty->assign('lista_antipasti',$antipasti);
        $this->smarty->assign('lista_primi',$primi);
        $this->smarty->assign('lista_secondi',$secondi);
        $this->smarty->assign('lista_contorni',$contorni);
        $this->smarty->assign('lista_pizze',$pizze);
        $this->smarty->assign('lista_dolci',$dolci);
        $this->smarty->assign('lista_bevande',$bevande);
        $this->smarty->assign('lista_categoria',$cate);


        $prova = 'palla';
        $prova2 = 'palla2';
        $array_giorni = array('Lunedì: 08:00-17:00', 'Martedì: 09:30-19:40', 'Mercoledì: 09:30-19:40', 'Giovedì: 09:30-19:40',  'Venerdì: 09:30-19:40', 'Sabato: 09:30-19:40',  'Domenica: Chiuso');

        $this->smarty->assign('elementi_totali_carrello',0);
        $this->smarty->assign('sede','Via Michelangelo');
        $this->smarty->assign('cellulare',328493920);
        $this->smarty->assign('telefono_fisso',3244244242);
       // $this->smarty->assign('nome_proprietario','Giacomo');
        $this->smarty->assign('nome_proprietario','Giacomo');
        $this->smarty->assign('giudizio_complessivo',4.3);
        //da prendere
        $this->smarty->assign('giorni_apertura',$array_giorni);

        $this->smarty->assign('stato_apertura','SI');
        $this->smarty->assign('prezzoTotale',10);
        //da vedere
        $this->smarty->assign('quant',3);
        $this->smarty->assign('puntiDisponibili',3422);
      //  $this->smarty->assign('Totale',99);


        $this->smarty->display('EffettuaOrdine.html');
    }

    public function prova($prova)
    {
        $this->smarty->assign('nome_proprietario', $prova);
        $this->smarty->display('EffettuaOrdine.html');

    }
}