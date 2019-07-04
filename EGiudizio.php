<?php

class EGiudizio
{
    private $Commento;
    private $Punteggio;
    private $Data;
    private $IDGiudizio;
    private $IDOrdine;

    public function __construct()
    {
        $num_args = func_num_args();
        $args = func_get_args();
        call_user_func_array(array(&$this, '__construct_'. $num_args), $args);
    }

    public function __construct_3(String $Commento, int $Punteggio, float $IDOrdine)
    {
        $this->Commento = $Commento;
        $this->Punteggio = $Punteggio;
        $this->Data = new DateTime();
        $this->IDOrdine = $IDOrdine;
    }

    public function __construct_5(String $Commento, int $Punteggio, String $Data, float $IDOrdine, float $IDGiudizio)
    {
        $this->Commento = $Commento;
        $this->Punteggio = $Punteggio;
        $this->Data = DateTime::createFromformat('Y-m-d H:i:s', "$Data");
        $this->IDOrdine = $IDOrdine;
        $this->IDGiudizio =$IDGiudizio;
    }

    public function getIDGiudizio()
    {
        return $this->IDGiudizio;
    }

    public function getIDOrdine(): float
    {
        return $this->IDOrdine;
    }

    public function setIDOrdine(float $IDOrdine): void
    {
        $this->IDOrdine = $IDOrdine;
    }

    public function getCommento(): String { return $this->Commento; }

    public function getData(): DateTime
    {
        try { return new DateTime ($this->Data->format('Y-m-d, H:i:s')); }
        catch (Exception $e)
        {
            echo $e->getMessage();
            return null;
        }
    }

    public function getPunteggio(): int { return $this->Punteggio; }

    public function setCommento(String $Commento): void { $this->Commento = $Commento; }

    public function setPunteggio(int $Punteggio): void
    {
        if ($Punteggio > 0 && $Punteggio < 6) $this->Punteggio = $Punteggio;
        else echo "Il punteggio non è valido";

    }

    public function toString() : String
    {
        return $this->getIDOrdine()."\n".$this->getPunteggio()."\n".$this->getCommento()."\n".$this->getData()->format('Y-m-d, H:i:s');
    }
}