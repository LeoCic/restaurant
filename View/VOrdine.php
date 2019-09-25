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
        $this->smarty->display('EffettuaOrdine.html');
    }
}