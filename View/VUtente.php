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

    public function MostraFormRegistrazione() { $this->smarty->display('RegistrazioneUtente.html'); }

    public function GestioneAccount()
    {
        $utente = FUtente::load($_SESSION['username']);
        $this->smarty->assign('nome', $utente->getNome());
        $this->smarty->assign('cognome', $utente->getCognome());
        $this->smarty->assign('nome_utente', $_SESSION['username']);
        $this->smarty->assign('telefono', $utente->getTelefono());
        $this->smarty->assign('email', $utente->getEmail());
        $this->smarty->display('GestioneAccount.html');
    }

    public function GestioneAccountErrore($error)
    {
        $utente = FUtente::load($_SESSION['username']);
        $this->smarty->assign('nome', $utente->getNome());
        $this->smarty->assign('cognome', $utente->getCognome());
        $this->smarty->assign('nome_utente', $_SESSION['username']);
        $this->smarty->assign('telefono', $utente->getTelefono());
        $this->smarty->assign('email', $utente->getEmail());
        $this->smarty->assign('error', $error);
        $this->smarty->display('GestioneAccount.html');
    }

    public function EliminaProfilo()
    {
        $this->smarty->assign('nome_utente', $_SESSION['username']);
        $this->smarty->display('EliminaProfilo.html');
    }

    public function RimuoviProfiloErrore($error)
    {
        $this->smarty->assign('error', $error);
        $this->smarty->assign('nome_utente', $_SESSION['username']);
        $this->smarty->display('EliminaProfilo.html');
    }
}