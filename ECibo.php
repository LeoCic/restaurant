<?php

require "EProdotto.php";
class ECibo extends EProdotto {
    private $Congelato;
    private $Vegano;
    private $Glutine;
    private $Integrale;


    public function __construct(String $Nome, int $IDProdotto, float $Prezzo, String $Descrizione, String $Ingredienti, bool $Biologico, String $Categoria, bool $Congelato, bool $Vegano, bool $Glutine, bool $Integrale)

    {

        parent::__construct($Nome, $IDProdotto, $Prezzo, $Descrizione, $Ingredienti, $Biologico, $Categoria);
        $this->Congelato = $Congelato;
        $this->Vegano = $Vegano;
        $this->Glutine = $Glutine;
        $this->Integrale = $Integrale;
    }

    public function getCongelato() : String {

        if ($this->Congelato == 1){
            return "Si";
        }
        else {
            return "No";
        }
    }

    public function setCongelato(bool $Congelato) : void {$this->Congelato = $Congelato;}

    public function getVegano() : String {

        if ($this->Vegano == 1){
            return "Si";
        }
        else {
            return "No";
        }
    }

    public function setVegano(bool $Vegano) : void {$this->Vegano = $Vegano;}

    public function getGlutine() : String {

        if ($this->Glutine == 1){
            return "Si";
        }
        else {
            return "No";
        }
    }

    public function setGlutine(bool $Glutine) : void {$this->Glutine = $Glutine;}

    public function getIntegrale() : String {

        if ($this->Integrale == 1){
            return "Si";
        }
        else {
            return "No";
        }
    }

    public function setIntegrale(bool $Integrale) : void {$this->Integrale = $Integrale;}

    public function toString() : String {

        parent::toString();
        return $this->getCongelato()."\n".$this->getVegano()."\n".$this->getGlutine()."\n".$this->getIntegrale();
    }




}

$test = new ECibo("pasta", 456, 6.5, "deliziosa", "farina, acqua...",1,"Primi",0,0,1,0);
$test->setVegano(1);
echo $test->toString();
