<?php


class EGiudizio
{
    private $Commento;
    private $Punteggio;
    private $Data;
    private $NomeUtente;

    public function __construct(String $Commento, int $Punteggio, String $NomeUtente)
    {
        $this->Commento = $Commento;
        $this->Punteggio = $Punteggio;
        $this->NomeUtente = $NomeUtente;
        $this->Data = new DateTime();
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

    public function getNomeUtente(): String { return $this->NomeUtente; }

    public function getPunteggio(): int { return $this->Punteggio; }

    public function setCommento(String $Commento): void { $this->Commento = $Commento; }

    public function setNomeUtente(String $NomeUtente): void { $this->NomeUtente = $NomeUtente; }

    public function setPunteggio(int $Punteggio): void
    {
        if ($Punteggio > 0 && $Punteggio < 6) $this->Punteggio = $Punteggio;
        else echo "Il punteggio non è valido";

    }

    public function toString() : String
    {
        return $this->getNomeUtente()."\n".$this->getPunteggio()."\n".$this->getCommento()."\n".$this->getData()->format('Y-m-d, H:i:s');
    }
}