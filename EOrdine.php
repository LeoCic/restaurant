<?php

class EOrdine
{
    private $ID;
    private $DataOrdinazione;
    private $DataConsegna;
    private $Nota;
    private $PrezzoTotale;
    /*private $ProdottiOrdinati;*/
    private $TipoPagamento;
    private $StatoOrdine;
    private $NomeUtente;
    private $LuogoConsegna;
    private $PuntiUsati;
    private $TelefonoConsegna;
    private $Giudizio;


    public function __construct(int $ID, String $DataOrdinazione, String $DataConsegna, String $Nota, float $PrezzoTotale, String $TipoPagamento, String $StatoOrdine, String $NomeUtente, ELuogo $LuogoConsegna, int $PuntiUsati, String $TelefonoConsegna, EGiudizio $Giudizio)
    {
        $this->ID = $ID;
        $this->DataOrdinazione = DateTime::createFromformat('Y-m-d, H:i:s',"$DataOrdinazione");
        $this->DataConsegna = DateTime::createFromformat('Y-m-d, H:i:s',"$DataConsegna");
        $this->Nota = $Nota;
        $this->PrezzoTotale = $PrezzoTotale;
        $this->TipoPagamento = $TipoPagamento;
        $this->StatoOrdine = $StatoOrdine;
        $this->NomeUtente = $NomeUtente;
        $this->LuogoConsegna = new ELuogo ($LuogoConsegna->getComune(), $LuogoConsegna->getProvincia(), $LuogoConsegna->getVia(), $LuogoConsegna->getN_Civico() );
        $this->PuntiUsati = $PuntiUsati;
        $this->TelefonoConsegna = $TelefonoConsegna;
        $this->Giudizio = new EGiudizio ($Giudizio->getCommento(), $Giudizio->getPunteggio(), $Giudizio->getNomeUtente());

    }

    public function getID() : int {return $this->ID;}

    public function setID(int $ID) : void {$this->ID = $ID;}

    public function getDataOrdinazione() : DateTime
    {
        try { return new DateTime ( $this->DataOrdinazione->format('Y-m-d, H:i:s')); }
        catch (Exception $e)
        {
            echo $e->getMessage();
            return null;
        }
    }

    public function setDataOrdinazione(String $DataOrdinazione) : void
    {
        $this->DataOrdinazione = DateTime::createFromformat('Y-m-d, H:i:s',"$DataOrdinazione");
    }

    public function getDataConsegna() : DateTime
    {
        try { return new DateTime ( $this->DataConsegna->format('Y-m-d, H:i:s')); }
        catch (Exception $e)
        {
            echo $e->getMessage();
            return null;
        }
    }

    public function setDataConsegna(String $DataConsegna) : void
    {
        $this->DataConsegna = DateTime::createFromformat('Y-m-d, H:i:s',"$DataConsegna");
    }

    public function getNota() : String {return $this->Nota;}

    public function setNota(String $Nota) : void {$this->Nota = $Nota;}

    public function getPrezzoTotale() : float {return $this->PrezzoTotale;}

    public function setPrezzoTotale(float $PrezzoTotale) : void {$this->PrezzoTotale = $PrezzoTotale;}

    public function getTipoPagamento() : String {return $this->TipoPagamento;}

    public function setTipoPagamento(String $TipoPagamento) : void {$this->TipoPagamento = $TipoPagamento;}

    public function getStatoOrdine() : String {return $this->StatoOrdine;}

    public function setStatoOrdine(String $StatoOrdine) : void {$this->StatoOrdine = $StatoOrdine;}

    public function getNomeUtente() : String {return $this->NomeUtente;}

    public function setNomeUtente(String $NomeUtente) : void {$this->NomeUtente = $NomeUtente;}

    public function getLuogoConsegna() : ELuogo
    {
        return new ELuogo ($this->LuogoConsegna->getComune(), $this->LuogoConsegna->getProvincia(), $this->LuogoConsegna->getVia(), $this->LuogoConsegna->getN_Civico());
    }

    public function setLuogoConsegna(ELuogo $LuogoConsegna) : void
    {
        $this->LuogoConsegna = new ELuogo ($LuogoConsegna->getComune(), $LuogoConsegna->getProvincia(), $LuogoConsegna->getVia(), $LuogoConsegna->getN_Civico() );
    }

    public function getPuntiUsati() : int {return $this->PuntiUsati;}

    public function setPuntiUsati(int $PuntiUsati) : void {$this->PuntiUsati = $PuntiUsati;}

    public function getTelefonoConsegna() : String {return $this->TelefonoConsegna;}

    public function setTelefonoConsegna(String $TelefonoConsegna) : void {$this->TelefonoConsegna = $TelefonoConsegna;}

    public function getGiudizio() : EGiudizio
    {
        return new EGiudizio ($this->Giudizio->getCommento(), $this->Giudizio->getPunteggio(), $this->Giudizio->getNomeUtente());
    }

    public function setGiudizio(EGiudizio $Giudizio) : void
    {
        $this->Giudizio = new EGiudizio ($Giudizio->getCommento(), $Giudizio->getPunteggio(), $Giudizio->getNomeUtente());
    }

    public function toString() : String {

        return $this->getID()."\n".$this->getDataOrdinazione()->format("Y-m-d, H:i:s")."\n".$this->getDataConsegna()->format("Y-m-d, H:i:s")."\n".$this->getNota()."\n".$this->getPrezzoTotale()."\n".$this->getTipoPagamento()."\n".$this->getStatoOrdine()."\n".$this->getNomeUtente()."\n".$this->getLuogoConsegna()->getComune()."\n".$this->getLuogoConsegna()->getProvincia()."\n".$this->getLuogoConsegna()->getVia()."\n".$this->getLuogoConsegna()->getN_Civico()."\n".$this->getPuntiUsati()."\n".$this->getTelefonoConsegna()."\n".$this->getGiudizio()->getCommento()."\n".$this->getGiudizio()->getPunteggio()."\n".$this->getGiudizio()->getNomeUtente();
    }
}