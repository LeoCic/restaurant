<?php

require_once 'ELuogo.php';

class EUtente
{
    private $Nome;
    private $Cognome;
    private $NomeUtente;
    private $Email;
    private $Telefono;
    private $LuogoNascita;
    private $DataNascita;
    private $Password;
    private $Punti;
    private $OrdiniCumulati;
    private $DataUltimoOrdine;

    public function __construct(String $Nome, String $Cognome, String $NomeUtente, String $Email, String $Telefono, ELuogo $LuogoNascita, String $DataNascita, String $Password)
    {
        $this->Nome = $Nome;
        $this->Cognome = $Cognome;
        $this->NomeUtente = $NomeUtente;
        $this->Email = $Email;
        $this->Telefono = $Telefono;
        $this->LuogoNascita = new ELuogo ($LuogoNascita->getComune(), $LuogoNascita->getProvincia(), $LuogoNascita->getVia(), $LuogoNascita->getN_Civico());
        $this->DataNascita = DateTime::createFromformat('Y-m-d', $DataNascita);
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

    public function getLuogoNascita(): ELuogo
    {
        return new ELuogo ($this->LuogoNascita->getComune(), $this->LuogoNascita->getProvincia(), $this->LuogoNascita->getVia(), $this->LuogoNascita->getN_Civico());
    }

    public function setLuogoNascita(ELuogo $LuogoNascita): void
    {
        $this->LuogoNascita = new ELuogo ($LuogoNascita->getComune(), $LuogoNascita->getProvincia(), $LuogoNascita->getVia(), $LuogoNascita->getN_Civico());
    }

    public function getDataNascita(): DateTime
    {
        try {
            return new DateTime ($this->DataNascita->format('Y-m-d'));
        } catch (Exception $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public function setDataNascita(String $DataNascita): void
    {
        $this->DataNascita = DateTime::createFromformat('Y-m-d', "$DataNascita");
    }

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
        try {
            return new DateTime ($this->DataUltimoOrdine->format('Y-m-d'));
        } catch (Exception $e) {
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
        if (empty($this->DataUltimoOrdine)) {
            return $this->getNome() . "\n" . $this->getCognome() . "\n" . $this->getNomeUtente() . "\n" . $this->getEmail() . "\n" . $this->getTelefono() . "\n" . $this->getLuogoNascita()->getComune() . "\n" . $this->getLuogoNascita()->getProvincia() . "\n" . $this->getLuogoNascita()->getVia() . "\n" . $this->getLuogoNascita()->getN_Civico() . "\n" . $this->getDataNascita()->format('Y-m-d') . "\n" . $this->getPasswordHash() . "\n" . $this->getPunti() . "\n" . $this->getOrdiniCumulati() . "\n" . "L'utente non ha mai effettuato un ordine";
        } else return $this->getNome() . "\n" . $this->getCognome() . "\n" . $this->getNomeUtente() . "\n" . $this->getEmail() . "\n" . $this->getTelefono() . "\n" . $this->getLuogoNascita()->getComune() . "\n" . $this->getLuogoNascita()->getProvincia() . "\n" . $this->getLuogoNascita()->getVia() . "\n" . $this->getLuogoNascita()->getN_Civico() . "\n" . $this->getDataNascita()->format('Y-m-d') . "\n" . $this->getPasswordHash() . "\n" . $this->getPunti() . "\n" . $this->getOrdiniCumulati() . "\n" . $this->getDataUltimoOrdine()->format('Y-m-d');
    }
}