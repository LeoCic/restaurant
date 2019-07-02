<?php

require "EProdotto.php";
class EBevanda extends EProdotto {
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

    public function getGradoAlcolico() : String {

        if ($this->GradoAlcolico == 1){
            return "Si";
        }
        else {
            return "No";
        }
    }

    public function setGradoAlcolico(float $GradoAlcolico) : void {$this->GradoAlcolico = $GradoAlcolico;}

    public function getGassato() : String {

        if ($this->Gassato == 1){
            return "Si";
        }
        else {
            return "No";
        }
    }

    public function setGassato(bool $Gassato) : void {$this->Gassato = $Gassato;}

    public function getDisponibilita() : String {

        if ($this->Disponibilita == 1){
            return "Si";
        }
        else {
            return "No";
        }
    }

    public function setDisponibilita(bool $Disponibilita) : void {$this->Disponibilita = $Disponibilita;}

    public function toString() : String {

        parent::toString();
        return $this->getGradoAlcolico()."\n".$this->getGassato()."\n".$this->getDisponibilita();
    }
}

$test = new EBevanda("fanta",34,3,"dissetante","acqua,zucchero",0,"Bevande",0,1,1);
$test->setDisponibilita(0);
print $test->toString();
