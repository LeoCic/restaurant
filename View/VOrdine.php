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

    public function MostraListaProdotti($smarty ,$antipasti, $primi, $secondi, $contorni, $pizze, $dolci, $bevande, $cate)
    {
        $this->smarty = $smarty;

        $this->smarty->assign('lista_antipasti',$antipasti);
        $this->smarty->assign('lista_primi',$primi);
        $this->smarty->assign('lista_secondi',$secondi);
        $this->smarty->assign('lista_contorni',$contorni);
        $this->smarty->assign('lista_pizze',$pizze);
        $this->smarty->assign('lista_dolci',$dolci);
        $this->smarty->assign('lista_bevande',$bevande);
        $this->smarty->assign('lista_categoria',$cate);



        $this->smarty->assign('elementi_totali_carrello',0);

        //da prendere
        $this->smarty->assign('prezzoTotale',10);
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

    public function InfoRistorante($sede ,$cellulare ,$telefono_fisso ,$nome_proprietario , $giudizio_complessivo,$stato_apertura ,  $array_giorni)
    {
        $this->smarty->assign('giorni_apertura',$array_giorni);
        $this->smarty->assign('sede',$sede);
        $this->smarty->assign('cellulare',$cellulare);
        $this->smarty->assign('telefono_fisso',$telefono_fisso);
        $this->smarty->assign('nome_proprietario',$nome_proprietario);
        $this->smarty->assign('giudizio_complessivo',$giudizio_complessivo);
        $this->smarty->assign('stato_apertura',$stato_apertura);

        return $this->smarty;

    }
}