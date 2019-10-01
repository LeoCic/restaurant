<?php

require_once 'Indice.php';

class VUtente
{
    private $smarty;


    public function __construct()
    {
        $this->smarty = ConfSmarty::configuration();
    }


    public function MostraFormConErrore($error)
    {
        $this->smarty->assign('error', $error);
        $this->smarty->display('RegistrazioneUtente.html');
    }

    public function MostraFormRegistrazione()
    {
        $this->smarty->display('RegistrazioneUtente.html');
    }

}

