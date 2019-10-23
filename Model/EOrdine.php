<?php

require_once 'Indice.php';

class EOrdine
{
    private $ID;
    private $DataOrdinazione;
    private $DataConsegna;
    private $Nota;
    private $PrezzoTotale;
    private $ProdottiOrdinati = array();
    private $TipoPagamento;
    private $NomeUtente;
    private $LuogoConsegna;
    private $PuntiUsati;
    private $TelefonoConsegna;
    private $Giudizio;
    private $IDLuogo;


    public function __construct()
    {
        $num_args = func_num_args();
        $args = func_get_args();
        call_user_func_array(array(&$this, '__construct_'. $num_args), $args);
    }


    public function __construct_1(array $ProdottiOrdinati)
    {
        $this->ProdottiOrdinati = $ProdottiOrdinati;
    }


    public function __construct_9(DateTime $DataOrdinazione, DateTime $DataConsegna, String $Nota, float $PrezzoTotale, String $TipoPagamento, int $PuntiUsati, String $TelefonoConsegna, String $NomeUtente, float $IDLuogo)
    {
        $this->DataOrdinazione = $DataOrdinazione;
        $this->DataConsegna = $DataConsegna;
        $this->Nota = $Nota;
        $this->PrezzoTotale = $PrezzoTotale;
        $this->TipoPagamento = $TipoPagamento;
        $this->PuntiUsati = $PuntiUsati;
        $this->TelefonoConsegna = $TelefonoConsegna;
        $this->NomeUtente = $NomeUtente;
        $this->IDLuogo = $IDLuogo;
    }


    public function __construct_11(float $ID, String $DataOrdinazione, String $DataConsegna, String $Nota, float $PrezzoTotale, String $TipoPagamento, int $PuntiUsati, String $TelefonoConsegna, String $NomeUtente, float $IDLuogo)
    {
        $this->ID = $ID;
        $this->DataOrdinazione = DateTime::createFromformat('Y-m-d H:i:s',"$DataOrdinazione");
        $this->DataConsegna = DateTime::createFromformat('Y-m-d H:i:s', "$DataConsegna");
        $this->Nota = $Nota;
        $this->PrezzoTotale = $PrezzoTotale;
        $this->TipoPagamento = $TipoPagamento;
        $this->PuntiUsati = $PuntiUsati;
        $this->TelefonoConsegna = $TelefonoConsegna;
        $this->NomeUtente = $NomeUtente;
        $this->IDLuogo = $IDLuogo;
    }


    public function __construct_13(float $ID, String $DataOrdinazione, String $DataConsegna, String $Nota, float $PrezzoTotale, array $ProdottiOrdinati, String $TipoPagamento, String $NomeUtente, ELuogo $LuogoConsegna, int $PuntiUsati, String $TelefonoConsegna, EGiudizio $Giudizio)
    {
        $this->ID = $ID;
        $this->DataOrdinazione = DateTime::createFromformat('Y-m-d H:i:s',"$DataOrdinazione");
        $this->DataConsegna = DateTime::createFromformat('Y-m-d H:i:s', "$DataConsegna");
        $this->Nota = $Nota;
        $this->PrezzoTotale = $PrezzoTotale;
        $this->ProdottiOrdinati = $ProdottiOrdinati;
        $this->TipoPagamento = $TipoPagamento;
        $this->NomeUtente = $NomeUtente;
        $this->LuogoConsegna = new ELuogo ($LuogoConsegna->getIDLuogo(), $LuogoConsegna->getComune(), $LuogoConsegna->getProvincia(), $LuogoConsegna->getVia(), $LuogoConsegna->getN_Civico() );
        $this->PuntiUsati = $PuntiUsati;
        $this->TelefonoConsegna = $TelefonoConsegna;
        $this->Giudizio = new EGiudizio ($Giudizio->getCommento(), $Giudizio->getPunteggio(), $Giudizio->getIDOrdine());
    }


    public function getID() : float {return $this->ID;}

    public function setID(float $ID) : void {$this->ID = $ID;}

    public function getDataOrdinazione() : DateTime
    {
        try {return new DateTime ($this->DataOrdinazione->format('Y-m-d H:i:s'));}
        catch (Exception $e)
        {
            echo $e->getMessage();
            return null;
        }
    }

    public function setDataOrdinazione(DateTime $DataOrdinazione) : void
    {
        try {$this->DataOrdinazione = new DateTime ($DataOrdinazione->format('Y-m-d H:i:s'));}
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function getDataConsegna() : DateTime
    {
        try {
            return new DateTime ($this->DataConsegna->format('Y-m-d H:i:s'));
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            return null;
        }
    }

    public function setDataConsegna(DateTime $DataConsegna) : void
    {
        try {
            $this->DataConsegna = new DateTime ($DataConsegna->format('Y-m-d H:i:s'));
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function getNota() : String {return $this->Nota;}

    public function setNota(String $Nota) : void {$this->Nota = $Nota;}

    public function getPrezzoTotale() : float
    {
        return $this->PrezzoTotale;
    }

    public function setPrezzoTotale(float $PrezzoTotale) : void {$this->PrezzoTotale = $PrezzoTotale; }

    public function getProdottiOrdinati() : array
    {
        $array1 = array();
        $array2 = array();
        foreach ($this->ProdottiOrdinati as $val)
        {
            if($val[0]->getCategoria() === 'Bevande')
            {
                $item = new EBevanda($val[0]->getNome(), $val[0]->getIDProdotto(), $val[0]->getPrezzo(), $val[0]->getDescrizione(), $val[0]->getIngredienti(), $val[0]->getBiologico(), $val[0]->getCategoria(), $val[0]->getGradoAlcolico(), $val[0]->getGassato(), $val[0]->getDisponibilita());
                array_push($array1, $item, $val[1]);
                array_push($array2, $array1);
                array_pop($array1);
                array_pop($array1);
            } else if ($val[0]->getCategoria() !== 'Bevande')
            {
                $item = new ECibo($val[0]->getNome(), $val[0]->getIDProdotto(), $val[0]->getPrezzo(), $val[0]->getDescrizione(), $val[0]->getIngredienti(), $val[0]->getBiologico(), $val[0]->getCategoria(), $val[0]->getCongelato(), $val[0]->getVegano(), $val[0]->getGlutine(), $val[0]->getIntegrale());
                array_push($array1, $item, $val[1]);
                array_push($array2, $array1);
                array_pop($array1);
                array_pop($array1);
            }
        }
        return $array2;
    }

    public function setProdottiOrdinati(array $ProdottiOrdinati) : void
    {
        $array1 = array();
        $contenitore = array();
        foreach ($ProdottiOrdinati as $val)
        {
            if($val[0]->getCategoria() === 'Bevande')
            {
                $item = new EBevanda($val[0]->getNome(), $val[0]->getIDProdotto(), $val[0]->getPrezzo(), $val[0]->getDescrizione(), $val[0]->getIngredienti(), $val[0]->getBiologico(), $val[0]->getCategoria(), $val[0]->getGradoAlcolico(), $val[0]->getGassato(), $val[0]->getDisponibilita());
                array_push($array1, $item, $val[1]);
                array_push($contenitore, $array1);
                array_pop($array1);
                array_pop($array1);
            } else if ($val[0]->getCategoria() !== 'Bevande')
            {
                $item = new ECibo($val[0]->getNome(), $val[0]->getIDProdotto(), $val[0]->getPrezzo(), $val[0]->getDescrizione(), $val[0]->getIngredienti(), $val[0]->getBiologico(), $val[0]->getCategoria(), $val[0]->getCongelato(), $val[0]->getVegano(), $val[0]->getGlutine(), $val[0]->getIntegrale());
                array_push($array1, $item, $val[1]);
                array_push($contenitore, $array1);
                array_pop($array1);
                array_pop($array1);            }
        }
        $this->ProdottiOrdinati = $contenitore;
    }

    public function addSingoloProdotto(EProdotto $prodotto, int $quantita) : void
    {
        $array1 = array();
        if($prodotto->getCategoria() === 'Bevande')
        {
            $item = new EBevanda($prodotto->getNome(), $prodotto->getIDProdotto(), $prodotto->getPrezzo(), $prodotto->getDescrizione(), $prodotto->getIngredienti(), $prodotto->getBiologico(), $prodotto->getCategoria(), $prodotto->getGradoAlcolico(), $prodotto->getGassato(), $prodotto->getDisponibilita());
            array_push($array1, $item, $quantita);
            array_push($this->ProdottiOrdinati, $array1);
            array_pop($array1);
            array_pop($array1);
        }
        if ($prodotto->getCategoria() !== 'Bevande')
        {
            $item = new ECibo($prodotto->getNome(), $prodotto->getIDProdotto(), $prodotto->getPrezzo(), $prodotto->getDescrizione(), $prodotto->getIngredienti(), $prodotto->getBiologico(), $prodotto->getCategoria(), $prodotto->getCongelato(), $prodotto->getVegano(), $prodotto->getGlutine(), $prodotto->getIntegrale());
            array_push($array1, $item, $quantita);
            array_push($this->ProdottiOrdinati, $array1);
            array_pop($array1);
            array_pop($array1);
        }
    }

    public function getTipoPagamento() : String {return $this->TipoPagamento;}

    public function setTipoPagamento(String $TipoPagamento) : void {$this->TipoPagamento = $TipoPagamento;}

    public function getNomeUtente() : String {return $this->NomeUtente;}

    public function setNomeUtente(String $NomeUtente) : void {$this->NomeUtente = $NomeUtente;}

    public function getLuogoConsegna() : ELuogo
    {
        return new ELuogo ($this->LuogoConsegna->getIDLuogo(), $this->LuogoConsegna->getComune(), $this->LuogoConsegna->getProvincia(), $this->LuogoConsegna->getVia(), $this->LuogoConsegna->getN_Civico());
    }

    public function setLuogoConsegna(ELuogo $LuogoConsegna) : void
    {
        $this->LuogoConsegna = new ELuogo ($LuogoConsegna->getIDLuogo(), $LuogoConsegna->getComune(), $LuogoConsegna->getProvincia(), $LuogoConsegna->getVia(), $LuogoConsegna->getN_Civico() );
    }

    public function getPuntiUsati() : int {return $this->PuntiUsati;}

    public function setPuntiUsati(int $PuntiUsati) : void {$this->PuntiUsati = $PuntiUsati;}

    public function getTelefonoConsegna() : String {return $this->TelefonoConsegna;}

    public function setTelefonoConsegna(String $TelefonoConsegna) : void {$this->TelefonoConsegna = $TelefonoConsegna;}

    public function getGiudizio() : EGiudizio {return $this->Giudizio;}

    public function setGiudizio(EGiudizio $Giudizio) : void {$this->Giudizio = $Giudizio;}

    public function getIDLuogo() : float {return $this->IDLuogo;}

    public function setIDLuogo(int $IDLuogo) : void {$this->IDLuogo = $IDLuogo;}

    public function CalcolaPrezzoTotale() : float
    {
        $PrezzoTotaleOrdine = 0;
        foreach ($this->ProdottiOrdinati as $val)
        {
            $PrezzoTotaleOrdine = $PrezzoTotaleOrdine + ($val[0]->getPrezzo())*($val[1]);
        }
        return $PrezzoTotaleOrdine;
    }

    public function toString() : String
    {
        return $this->getID() . "\n" . $this->getDataOrdinazione()->format("Y-m-d H:i:s") . "\n" . $this->getDataConsegna()->format("Y-m-d H:i:s") . "\n" . $this->getNota() . "\n" . $this->getPrezzoTotale() . "\n" . $this->getTipoPagamento() . "\n" . $this->getNomeUtente() . "\n" . $this->getLuogoConsegna()->getComune() . "\n" . $this->getLuogoConsegna()->getProvincia() . "\n" . $this->getLuogoConsegna()->getVia() . "\n" . $this->getLuogoConsegna()->getN_Civico() . "\n" . $this->getPuntiUsati() . "\n" . $this->getTelefonoConsegna();
    }

    public function toString1() : String
    {
        return $this->getDataOrdinazione()->format("Y-m-d H:i:s") . "\n" . $this->getDataConsegna()->format("Y-m-d H:i:s") . "\n" . $this->getNota() . "\n" . $this->getPrezzoTotale() . "\n" . $this->getTipoPagamento() . "\n" . $this->getPuntiUsati() . "\n" . $this->getTelefonoConsegna() . "\n" . $this->getNomeUtente() . "\n" . $this->getIDLuogo();
    }

    public function CalcolaPrezzoScontato($punti) : float
    {
        FRistorante::loadRistorante();
        return $this->PrezzoTotale - $punti * ERistorante::getEntitaScontoAPunti();
    }

    public function CalcolaPrezzoConCarta() : float
    {
        FRistorante::loadRistorante();
        return $this->PrezzoTotale - (ERistorante::getEntitaScontoBase() * $this->PrezzoTotale) / 100;
    }
}
