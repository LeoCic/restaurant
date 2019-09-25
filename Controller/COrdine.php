<?php

require_once 'Indice.php';

class COrdine
{

    public function prova()
    {
        $smarty = ConfSmarty::configuration();
        $smarty->display('RegistrazioneUtente.html');
    }
}