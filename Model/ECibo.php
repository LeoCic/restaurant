<?php

require 'EProdotto.php';

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

    public function getCongelato() : bool {return $this->Congelato;}

    public function setCongelato(bool $Congelato) : void {$this->Congelato = $Congelato;}

    public function getVegano() : bool {return $this->Vegano;}

    public function setVegano(bool $Vegano) : void {$this->Vegano = $Vegano;}

    public function getGlutine() : bool {return $this->Glutine;}

    public function setGlutine(bool $Glutine) : void {$this->Glutine = $Glutine;}

    public function getIntegrale() : bool {return $this->Integrale;}

    public function setIntegrale(bool $Integrale) : void {$this->Integrale = $Integrale;}

    public function toString() : String {

        return $this->getNome()."\n".$this->getIDProdotto()."\n".$this->getPrezzo()."\n".$this->getDescrizione()."\n".$this->getIngredienti()."\n".$this->getBiologico()."\n".$this->getCategoria()."\n".$this->getCongelato()."\n".$this->getVegano()."\n".$this->getGlutine()."\n".$this->getIntegrale();
    }
}
