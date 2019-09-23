<?php

require_once 'Indice.php';

class EUtente
{
    private $Nome;
    private $Cognome;
    private $NomeUtente;
    private $Email;
    private $Telefono;
    private $Password;
    private $Punti;
    private $OrdiniCumulati;
    private $DataUltimoOrdine;

    public function __construct(String $Nome, String $Cognome, String $NomeUtente, String $Email, String $Telefono, String $Password)
    {
        $this->Nome = $Nome;
        $this->Cognome = $Cognome;
        $this->NomeUtente = $NomeUtente;
        $this->Email = $Email;
        $this->Telefono = $Telefono;
        $this->Password = password_hash("$Password", PASSWORD_DEFAULT);
        $this->Punti = 0;
        $this->OrdiniCumulati = 0;
        $this->DataUltimoOrdine = null;
    }

    public function getNome(): String { return $this->Nome; }

    public function setNome(String $Nome): void { $this->Nome = $Nome; }

    public function getCognome(): String { return $this->Cognome; }

    public function setCognome(String $Cognome): void { $this->Cognome = $Cognome; }

    public function getNomeUtente(): String { return $this->NomeUtente; }

    public function setNomeUtente(String $NomeUtente): void { $this->NomeUtente = $NomeUtente; }

    public function getEmail(): String { return $this->Email; }

    public function setEmail(String $Email): void { $this->Email = $Email; }

    public function getTelefono(): String { return $this->Telefono; }

    public function setTelefono(String $Telefono): void { $this->Telefono = $Telefono; }

    public function getPasswordHash(): String { return $this->Password; } //non deve mai essere possibile estrarre delle password in chiaro

    public function setPassword(String $Password): void
    {
        $this->Password = password_hash("$Password", PASSWORD_DEFAULT);
    }

    public function getPunti(): int { return $this->Punti; }

    public function setPunti(int $Punti): void { $this->Punti = $Punti; }

    public function getOrdiniCumulati(): int { return $this->OrdiniCumulati; }

    public function setOrdiniCumulati(int $OrdiniCumulati): void { $this->OrdiniCumulati = $OrdiniCumulati; }

    public function getDataUltimoOrdine(): DateTime
    {
        try
        {
            if (is_null($this->DataUltimoOrdine) == FALSE) return new DateTime ($this->DataUltimoOrdine->format('Y-m-d'));
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            return null;
        }
    }

    public function setDataUltimoOrdine(String $DataUltimoOrdine): void
    {
        $this->DataUltimoOrdine = DateTime::createFromformat('Y-m-d', "$DataUltimoOrdine");
    }

    public function toString(): String
    {
        if (empty($this->DataUltimoOrdine))
        {
            return $this->getNome() . "\n" . $this->getCognome() . "\n" . $this->getNomeUtente() . "\n" . $this->getEmail() . "\n" . $this->getTelefono() . "\n" . $this->getPasswordHash() . "\n" . $this->getPunti() . "\n" . $this->getOrdiniCumulati() . "\n" . "L'utente non ha mai effettuato un ordine";
        }
        else return $this->getNome() . "\n" . $this->getCognome() . "\n" . $this->getNomeUtente() . "\n" . $this->getEmail() . "\n" . $this->getTelefono() . "\n" . $this->getPasswordHash() . "\n" . $this->getPunti() . "\n" . $this->getOrdiniCumulati() . "\n" . $this->getDataUltimoOrdine()->format('Y-m-d');
    }
}

//$prova = new EUtente('Giacomo', 'Palla', 'giacpall', 'giacpall@gmail.com','+527492847263','palla');
//echo $prova->toString();