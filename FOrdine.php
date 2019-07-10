<?php

require 'FDatabase.php';
require_once 'EOrdine.php';

abstract class FOrdine
{
    public static function load(float $id) : EOrdine
    {
        $conn = FDataBase::Connect();
        $sql = " SELECT * FROM Ordine WHERE (IDOrdine='$id') ";
        $riss = $conn->query($sql);
        if ($riss->rowCount() === 1)
        {
            $ris = $riss->fetchAll();
            $ordine = new EOrdine($ris[0][0], $ris[0][1], $ris[0][2], $ris[0][3], $ris[0][4], $ris[0][5], $ris[0][6], $ris[0][7], $ris[0][8], $ris[0][9], $ris[0][10]);
            return $ordine;
        }
    }

    public static function exists(float $id) : bool
    {
        $conn = FDataBase::Connect();
        $sql = " SELECT * FROM Ordine WHERE (IDOrdine='$id') ";
        $riss = $conn->query($sql);
        $ris = $riss->fetchAll();
        if (count($ris) === 1) return 1;
        else return 0;
    }

    public static function store(EOrdine $ordine) : bool
    {
        $IDOrdine = $ordine->getID();
        $DataOrdinazione = $ordine->getDataOrdinazione()->format('Y-m-d H:i:s');
        $DataConsegna = $ordine->getDataConsegna()->format('Y-m-d H:i:s');
        $Nota = $ordine->getNota();
        $PrezzoTotale = $ordine->getPrezzoTotale();
        $TipoPagamento = $ordine->getTipoPagamento();
        $StatoOrdine = $ordine->getStatoOrdine();
        $PuntiUsati = $ordine->getPuntiUsati();
        $TelefonoConsegna = $ordine->getTelefonoConsegna();
        $NomeUtente = $ordine->getNomeUtente();
        $IDLuogo = $ordine->getIDLuogo();

        $conn = FDataBase::Connect();
        $sql = "INSERT INTO Ordine (`IDOrdine`, `DataOrdinazione`, `DataConsegna`, `Nota`, `PrezzoTotale`, `TipoPagamento`, `StatoOrdine`, `PuntiUsati`, `TelefonoConsegna`, `NomeUtente`, `IDLuogo`) VALUES('$IDOrdine' , '".addslashes("$DataOrdinazione")."' , '".addslashes("$DataConsegna")."' , '" . addslashes("$Nota") . "' , '$PrezzoTotale' , '" . addslashes("$TipoPagamento") . "' , '" . addslashes("$StatoOrdine") . "' , '$PuntiUsati' , '" . addslashes("$TelefonoConsegna") . "' , '" . addslashes("$NomeUtente") . "' , '$IDLuogo')";
        $riss = $conn->query($sql);
        if (is_bool($riss))
            return 0;
        else if (is_object($riss))
            return 1;

    }

    public static function update(EOrdine $ordine) : bool
    {
        $IDOrdine = $ordine->getID();
        $DataOrdinazione = $ordine->getDataOrdinazione()->format('Y-m-d H:i:s');
        $DataConsegna = $ordine->getDataConsegna()->format('Y-m-d H:i:s');
        $Nota = $ordine->getNota();
        $PrezzoTotale = $ordine->getPrezzoTotale();
        $TipoPagamento = $ordine->getTipoPagamento();
        $StatoOrdine = $ordine->getStatoOrdine();
        $PuntiUsati = $ordine->getPuntiUsati();
        $TelefonoConsegna = $ordine->getTelefonoConsegna();
        $NomeUtente = $ordine->getNomeUtente();
        $IDLuogo = $ordine->getIDLuogo();


        $conn = FDataBase::Connect();
        $sql =" UPDATE Ordine SET DataOrdinazione = '" . addslashes($DataOrdinazione) . "' , DataConsegna = '" . addslashes($DataConsegna) . "' , Nota = '" . addslashes($Nota) . "' , PrezzoTotale = '$PrezzoTotale' , TipoPagamento = '" . addslashes($TipoPagamento) . "' , StatoOrdine = '" . addslashes($StatoOrdine) . "' , PuntiUsati = '$PuntiUsati' , TelefonoConsegna = '" . addslashes($TelefonoConsegna) . "' , NomeUtente = '" . addslashes($NomeUtente) . "' , IDLuogo = '$IDLuogo' WHERE IDOrdine = '$IDOrdine' " ;
        $riss = $conn->query($sql);
        if (is_bool($riss) )
            return 0;
        else if(is_object($riss))
            return 1;

    }

    public static function delete (float $id) : bool
    {
        $conn = FDataBase::Connect();
        $sql ="DELETE FROM Ordine WHERE IDOrdine = '$id'";
        $riss = $conn->query($sql);
        if (is_bool($riss) )
            return 0;
        else if(is_object($riss))
            return 1;
    }
}


/*$test = FOrdine::load(111);
print $test->toString1();
print "\n";
print "\n";


if(FOrdine::exists(568)){print "si";}
else{print "no";}*/

/*$prodotti = array();
$giudizio = new EGiudizio('fantastico',44,'11-11-11 15:33:00',3,13);
$luogo = new ELuogo('vicovaro','RM','giuseppe mazzini','7');
$cibo = new ECibo('pane',865,2,'pane con farina integrale','acqua,farina,sale',1,'pane',0,0,1,1);
$bevanda = new EBevanda('acqua',55,1,'gassata','acqua,sali minerali',1,'Bevande',0,1,0);
array_push($prodotti, $bevanda);
array_push($prodotti, $cibo);

$ordine = new EOrdine(111,'2019-12-12 14:36:12','2019-12-12 15:00:00','citofonare al terzo piano',34.5,'contanti','ok',3,'486548654','massimo',3);
FOrdine::store($ordine);*/

//FOrdine::delete(111);



//$test->setPrezzoTotale(200);
//FOrdine::update($test);
//print $test->toString1();