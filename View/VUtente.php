<?php

require_once 'ConfSmarty.php';

class VUtente
{
    private $smarty;
    private $valori;


    public function __construct()
    {
        $this->smarty = ConfSmarty::configuration();
        $this->valori = array(
            'Nome' => "",
            'Cognome' => "",
            'NomeUtente' => "",
            'Telefono' => "",
            'Email' => "",
            'Password' => "",
            'ConfermaPassword' => ""
        );
    }

    public function MostraFormRegistrazione()
    {
        $this->smarty->assign('valori', $this->valori);
        $this->smarty->display('RegistrazioneUtente.html');
    }

    public function ControlloFormRegistrazione()
    {
        if (isset($_POST['Nome']))
        {
            $this->valori['Nome'] = $_POST['Nome'];
        }
        else $this->valori['Nome'] = "";

        if (isset($_POST['Cognome']))
        {
            $this->valori['Cognome'] = $_POST['Cognome'];
        }
        else $this->valori['Cognome'] = "";

        if (isset($_POST['NomeUtente']))
        {
            if (FUtente::exists($_POST['NomeUtente']) != 1)
            {
                $this->valori['NomeUtente'] = $_POST['NomeUtente'];
            }
            else
                {
                    $this->smarty->assign('erroreNomeUtente', 'Il Nome Utente scelto è già in uso');
                    $this->smarty->display('RegistrazioneUtente.html');
                }
        }
        else $this->valori['NomeUtente'] = "";

        if (isset($_POST['Telefono']))
        {
            $this->valori['Telefono'] = $_POST['Telefono'];
        }
        else $this->valori['Telefono'] = "";

        if (isset($_POST['Email']))
        {
            $this->valori['Email'] = $_POST['Email'];
        }
        else $this->valori['Email'] = "";

        if (isset($_POST['Password']))
        {
            $this->valori['Password'] = $_POST['Password'];
        }
        else $this->valori['Password'] = "";

        if (isset($_POST['ConfermaPassword']))
        {
            if ($_POST['ConfermaPassword'] === $_POST{'Password'})
            {
                $this->valori['ConfermaPassword'] = $_POST['ConfermaPassword'];
            }
            else
            {
                $this->smarty->assign('errorePassword', 'La password di conferma non corrisponde a quella inserita');
                $this->smarty->display('RegistrazioneUtente.html');
            }
        }
        else $this->valori['ConfermaPassword'] = "";

        return $this->valori;
    }
}

$test = new VUtente();
$controllo = $test->ControlloFormRegistrazione();
print_r($controllo);
