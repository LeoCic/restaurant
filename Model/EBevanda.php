<?php

require_once 'Indice.php';

class EBevanda extends EProdotto
{
    private $GradoAlcolico;
    private $Gassato;
    private $Disponibilita;


    public function __construct(String $Nome, int $IDProdotto, float $Prezzo, String $Descrizione, String $Ingredienti, bool $Biologico, String $Categoria, float $GradoAlcolico, bool $Gassato, bool $Disponibilita)
    {

        parent::__construct($Nome, $IDProdotto, $Prezzo, $Descrizione, $Ingredienti, $Biologico, $Categoria);
        $this->GradoAlcolico = $GradoAlcolico;
        $this->Gassato = $Gassato;
        $this->Disponibilita = $Disponibilita;
    }


    public function getGradoAlcolico() : float {return $this->GradoAlcolico;}

    public function setGradoAlcolico(float $GradoAlcolico) : void {$this->GradoAlcolico = $GradoAlcolico;}

    public function getGassato() : bool {return $this->Gassato;}

    public function setGassato(bool $Gassato) : void {$this->Gassato = $Gassato;}

    public function getDisponibilita() : bool {return $this->Disponibilita;}

    public function setDisponibilita(bool $Disponibilita) : void {$this->Disponibilita = $Disponibilita;}

    public function toString() : String
    {

        return $this->getNome()."\n".$this->getIDProdotto()."\n".$this->getPrezzo()."\n".$this->getDescrizione()."\n".$this->getIngredienti()."\n".$this->getBiologico()."\n".$this->getCategoria()."\n".$this->getGradoAlcolico()."\n".$this->getGassato()."\n".$this->getDisponibilita();
    }
}
