<?php

require_once 'Indice.php';

abstract class  ERistorante
{
    static private $Sede;
    static private $Cellulare;
    static private $TelefonoFisso;
    static private $Proprietario;
    static private $Nome;
    static private $Giorni_Di_Apertura = array('lunedi' => false , 'martedi' => false , 'mercoledi' => false , 'giovedi' => false , 'venerdi' => false , 'sabato' => false , 'domenica' => false );
    static private $CatalogoProdotti = array(); // di prodotti
    static private $EntitaScontoBase;
    static private $EntitaScontoAPunti;

    public static function getSede(): ELuogo
    {
        return new ELuogo(self::$Sede->getComune() , self::$Sede->getProvincia() , self::$Sede->getVia() , self::$Sede->getN_Civico());
    }

    public static function setSede(ELuogo $Sede) : void
    {
        self::$Sede = new ELuogo($Sede->getComune() , $Sede->getProvincia() , $Sede->getVia() , $Sede->getN_Civico());
    }

    public static function setCellulare( String $Cellulare) : void { self::$Cellulare = $Cellulare; }

    public static function getCellulare() : string { return self::$Cellulare; }

    public static function getTelefonoFisso() : String { return self::$TelefonoFisso; }

    public static function setTelefonoFisso( String $TelefonoFisso) : void { self::$TelefonoFisso = $TelefonoFisso; }

    public static function getProprietario() : String { return self::$Proprietario; }

    public static function setProprietario(String $Proprietario) : void { self::$Proprietario = $Proprietario; }

    public static function getNome() : String { return self::$Nome; }

    public static function setNome(String $Nome) : void { self::$Nome = $Nome; }

    public static function getGiorniDiApertura() : array { return self::$Giorni_Di_Apertura; }

    public static function setGiorniDiApertura( array $Giorni_Di_Apertura) :void { self::$Giorni_Di_Apertura = $Giorni_Di_Apertura ; }

    public static function setEntitaScontoBase(float $EntitaScontoBase) : void { self::$EntitaScontoBase=$EntitaScontoBase; }

    public static function getEntitaScontoBase(): float { return self::$EntitaScontoBase; }

    public static function setEntitaScontoAPunti(float $EntitaScontoAPunti) :void { self::$EntitaScontoAPunti = $EntitaScontoAPunti; }

    public static function getEntitaScontoAPunti() :float { return self::$EntitaScontoAPunti; }

    public static function getCatalogoProdotti() : array { return self::$CatalogoProdotti; }

    public static function getProdottiByCategoria(String $categoria) : array
    {
        $prodotti = array();
        foreach (self::$CatalogoProdotti as $val)
        {
            if($val->getCategoria() === $categoria) array_push($prodotti, $val);
        }
        return $prodotti;
    }

    public static function setCatalogoProdotti(array $CatalogoProdotti): void { self::$CatalogoProdotti = $CatalogoProdotti; }

    public static function setSingoloProdotto(EProdotto $prod) { array_push(self::$CatalogoProdotti, $prod); }

    public static function toString() : String
    {
        return "sede : ".self::getSede()->getComune()."\t".self::getSede()->getProvincia()."\t".self::getSede()->getVia()
            ."\t".self::getSede()->getN_Civico()."\n"."cellulare : ".self::$Cellulare."\n"."TelefonoFisso : ".
            self::$TelefonoFisso."\n"."proprietario : ".self::$Proprietario."\n"."nome : ".self::$Nome.
            "\n"."entita sconto base : ".self::$EntitaScontoBase."\n"."entita sconto a punti : ".self::$EntitaScontoAPunti;
    }
}