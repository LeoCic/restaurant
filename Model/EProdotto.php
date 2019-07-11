<?php

require_once '../Indice.php';

abstract class EProdotto
{
    protected $Nome;
    protected $IDProdotto;
    protected $Prezzo;
    protected $Descrizione;
    protected $Ingredienti;
    protected $Biologico;
    protected $Categoria;


    public function __construct(String $Nome, int $IDProdotto, float $Prezzo, String $Descrizione, String $Ingredienti, bool $Biologico, String $Categoria)

    {
        $this->Nome = $Nome;
        $this->IDProdotto = $IDProdotto;
        $this->Prezzo = $Prezzo;
        $this->Descrizione = $Descrizione;
        $this->Ingredienti = $Ingredienti;
        $this->Biologico = $Biologico;
        $this->Categoria = $Categoria;
    }

    public function getNome() : String {return $this->Nome;}

    public function setNome(String $Nome) : void {$this->Nome = $Nome;}

    public function getIDProdotto() : int {return $this->IDProdotto;}

    public function setIDProdotto(int $IDProdotto) : void {$this->IDProdotto = $IDProdotto;}

    public function getPrezzo() : float {return $this->Prezzo;}

    public function setPrezzo(float $Prezzo) : void {$this->Prezzo = $Prezzo;}

    public function getDescrizione() : String {return $this->Descrizione;}

    public function setDescrizione(String $Descrizione) : void {$this->Descrizione = $Descrizione;}

    public function getIngredienti() : String {return $this->Ingredienti;}

    public function setIngredienti(String $Ingredienti) : void {$this->Ingredienti = $Ingredienti;}

    public function getBiologico() : bool {return $this->Biologico;}

    public function setBiologico(bool $Biologico) : void {$this->Biologico = $Biologico;}

    public function getCategoria() : String {return $this->Categoria;}

    public function setCategoria(String $Categoria) : void {$this->Categoria = $Categoria;}

    public function toString() : String {

        return $this->getNome()."\n".$this->getIDProdotto()."\n".$this->getPrezzo()."\n".$this->getDescrizione()."\n".$this->getIngredienti()."\n".$this->getBiologico()."\n".$this->getCategoria()."\n";
    }
}

