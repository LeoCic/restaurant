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

    public function GestioneAccount()
    {
        session_start();
        $utente = FUtente::load($_SESSION['username']);
        $this->smarty->assign('NOME_UTENTE', $_SESSION['username']);
        $this->smarty->assign('TELEFONO', $utente->getTelefono());
        $this->smarty->assign('EMAIL', $utente->getEmail());
        $this->smarty->display('GestioneAccount.html');
    }

    public function GestioneAccountErrore($error)
    {
        $utente = FUtente::load($_SESSION['username']);
        $this->smarty->assign('NOME_UTENTE', $_SESSION['username']);
        $this->smarty->assign('TELEFONO', $utente->getTelefono());
        $this->smarty->assign('EMAIL', $utente->getEmail());
        $this->smarty->assign('error', $error);
        $this->smarty->display('GestioneAccount.html');
    }

}

