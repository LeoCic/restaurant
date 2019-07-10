<?php
require_once 'ELuogo.php';
require_once 'EProdotto.php';


 //vedere se mettere metoto aggiungi prodotto al catalogo


 abstract class  ERistorante{
    static private $Sede;
    static private $Cellulare;
    static private $TelefonoFisso;
    static private $Proprietario;
    static private $Nome;
    static private $GiudizioComplessivo;
    static private $StatoApertura;
    static private $Giorni_Di_Apertura = array('lunedi' => false , 'martedi' => false , 'mercoledi' => false , 'giovedi' => false , 'venerdi' => false , 'sabato' => false , 'domenica' => false );
    static private $CatalogoProdotti = array(); // di prodotti
    static private $AvvisiAttivi;
    static private $ChiusoStraordinario;
    static private $PromozioniAttive = array(); //di bool
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

    public static function setCellulare( String $Cellulare) : void
    {
        self::$Cellulare = $Cellulare;
    }

    public static function getCellulare() : voif
    {
        return self::$Cellulare;
    }

    public static function getTelefonoFisso() : String
    {
        return self::$TelefonoFisso;
    }

    public static function setTelefonoFisso( String $TelefonoFisso) : void
    {
        self::$TelefonoFisso = $TelefonoFisso;
    }

    public static function getProprietario() : String
    {
        return self::$Proprietario;
    }

    public static function setProprietario(String $Proprietario) : void
    {
        self::$Proprietario = $Proprietario;
    }

    public static function getNome() : String
    {
        return self::$Nome;
    }

    public static function setNome(String $Nome) : void
    {
        self::$Nome = $Nome;
    }

    public static function getGiudizioComplessivo() : float
    {
        return self::$GiudizioComplessivo;
    }

    public static function setGiudizioComplessivo( float $GiudizioComplessivo) : void
    {
        self::$GiudizioComplessivo = $GiudizioComplessivo;
    }

    public static function getStatoApertura() : bool
    {
        return self::$StatoApertura;
    }

    public static function setStatoApertura( bool $StatoApertura) :void
    {
        self::$StatoApertura = $StatoApertura;
    }

    public static function getGiorniDiApertura() : array
    {
        /* VERSIONE CON DATETIME
         foreach (self::$Giorni_Di_Apertura as $key => $value)
        {
            $Giorni_Di_Apertura[] = new DateTime(($value->format('d-m-Y') ));
        }
        return $Giorni_Di_Apertura;*/

        return self::$Giorni_Di_Apertura;

    }

    public static function setGiorniDiApertura( array $Giorni_Di_Apertura) :void
    {

        /*foreach($Giorni_Di_Apertura as $key=>$value)
        {
            self::$Giorni_Di_Apertura[] = new DateTime($value -> format('d-m-Y'));
        }*/
        self::$Giorni_Di_Apertura = $Giorni_Di_Apertura ;

    }

    public static function setAttive(array $Attive) :void
    {
        self::$Attive[0] = $Attive[0];
        self::$Attive[1] = $Attive[1];
    }

    public static function getAttive() : array // di bool
    {
        return self::$Attive;
    }

    public static function setEntitaScontoBase(float $EntitaScontoBase) : void
    {
        self::$EntitaScontoBase=$EntitaScontoBase;
    }

    public static function getEntitaScontoBase(): float
    {
        return self::$EntitaScontoBase;
    }

    public static function setEntitaScontoAPunti(float $EntitaScontoAPunti) :void
    {
        self::$EntitaScontoAPunti = $EntitaScontoAPunti;
    }

    public static function getEntitaScontoAPunti() :float
    {
        return self::$EntitaScontoAPunti;
    }

    public static function getAvvisiAttivi() : bool
    {
        return self::$AvvisiAttivi;
    }

    public static function setAvvisiAttivi( bool $AvvisiAttivi): void
    {
        self::$AvvisiAttivi = $AvvisiAttivi;
    }

    public static function getChiusoStraordinario() : bool
    {
        return self::$ChiusoStraordinario;
    }

    public static function setChiusoStraordinario(bool $ChiusoStraordinario): void
    {
        self::$ChiusoStraordinario = $ChiusoStraordinario;
    }

    public static function getPromozioniAttive(): array // di bool
    {
        return self::$PromozioniAttive;
    }

    public static function setPromozioniAttive(array $PromozioniAttive): void
    {
        self::$PromozioniAttive = $PromozioniAttive;
    }

    public static function getCatalogoProdotti() : array //di prodotti
    {
        //se fosse composizione
        /*foreach(self::$CatalogoProdotti as $key => $val) {
            $CatalogoProdotti[] = new EProdotto($val->getNome(), $val->getID(), $val->getPrezzo(), $val->getDescrizione(), $val->getIngredienti(), $val->getBiologico(), $val->getCategoria());
        }*/

        return self::$CatalogoProdotti;
    }

    public static function setCatalogoProdotti(array $CatalogoProdotti): void
    {
        //se fosse composizione
        /*foreach($CatalogoProdotti as $key => $val) {
            self::$CatalogoProdotti[] = new EProdotto($val->getNome(), $val->getID(), $val->getPrezzo(), $val->getDescrizione(), $val->getIngredienti(), $val->getBiologico(), $val->getCategoria());
            */
        self::$CatalogoProdotti = $CatalogoProdotti;
    }
    public static function setSingoloProdotto(EProdotto $prod)
    {
        array_push(self::$CatalogoProdotti, $prod);

    }





    public static function AvvisaUtentiAbituali() : void
    {

    }

    public static function toString() : String
    {

        print ("giorni di apertura :");
        print_r(self::$Giorni_Di_Apertura);
        print"\n";
        foreach (self::$CatalogoProdotti as $key => $value)
            print "nome = "."$value->getNome()"."\t";
        print ("Promozioni attive :");
        print_r(self::$PromozioniAttive);
        print"\n";

        return "sede : ".self::getSede()->getComune()."\t".self::getSede()->getProvincia()."\t".self::getSede()->getVia()
            ."\t".self::getSede()->getN_Civico()."\n"."cellulare : ".self::$Cellulare."\n"."TelefonoFisso : ".
            self::$TelefonoFisso."\n"."proprietario : ".self::$Proprietario."\n"."nome : ".self::$Nome.
            "\n"."Giudizio Complessivo : ".self::$GiudizioComplessivo."\n"."Stato Apertura : "
            .self::$StatoApertura."\n"."avvisi attivi : ".self::$AvvisiAttivi."\n"."chiuso straordinario : ".self::$ChiusoStraordinario
            ."\n"."entita sconto base : ".self::$EntitaScontoBase."\n"."entita sconto a punti : ".self::$EntitaScontoAPunti;
    }



}
//necessari per il test di alcuni get e set

//setSede
/*
 $luogo = new ELuogo("L'Aquila" , "AQ" , "germania" , "4");
 ERistorante::setSede($luogo);
 ERistorante::setCellulare("3484366708");
 ERistorante::setTelefonoFisso("0862727319");
 ERistorante::setProprietario("alessio");
 ERistorante::setNome("alessio");
 ERistorante::setGiudizioComplessivo(3.6);
 ERistorante::setStatoApertura(true);
 ERistorante::setAvvisiAttivi(true);
 ERistorante::setChiusoStraordinario(false);
 $attive =array(true,true);
 ERistorante::setPromozioniAttive($attive);
 ERistorante::setEntitaScontoAPunti(1.2);
 ERistorante::setEntitaScontoBase(3.5);
*/
//$prodotto[1] = new EProdotto("pasta", "1","33", "molto buona","pasta pomodoro","false","primi");
//$prodotto[2] = new EProdotto("pastaaa", "12","33", "molto buona","pasta pomodoro","false","primi");
//ERistorante::setCatalogoProdotti($prodotto);
 //print ERistorante::toString();
//set giorni di apertura
/*
$data_di_prova =  array('lunedi' => true , 'martedi' => false , 'mercoledi' => false , 'giovedi' => true , 'venerdi' => false , 'sabato' => false , 'domenica' => true );
ERistorante::setGiorniDiApertura($data_di_prova);
$prova = ERistorante::getGiorniDiApertura();
print_r($prova);
*/





