<?php

require_once 'Indice.php';

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
            if ($ris[0][3] === NULL)
            {
                if ($ris[0][8] === NULL) {
                    $ordine = new EOrdine($ris[0][0], $ris[0][1], $ris[0][2], 'NULL', $ris[0][4], $ris[0][5], $ris[0][6], $ris[0][7], 'NULL', $ris[0][9], $ris[0][10]);
                }
                else{$ordine = new EOrdine($ris[0][0], $ris[0][1], $ris[0][2], 'NULL', $ris[0][4], $ris[0][5], $ris[0][6], $ris[0][7], $ris[0][8], $ris[0][9], $ris[0][10]);}
                return $ordine;
            } else if ($ris[0][3] !== NULL)
            {
                if ($ris[0][8] === NULL) {
                    $ordine = new EOrdine($ris[0][0], $ris[0][1], $ris[0][2], $ris[0][3], $ris[0][4], $ris[0][5], $ris[0][6], $ris[0][7], 'NULL', $ris[0][9], $ris[0][10]);
                }
                else{$ordine = new EOrdine($ris[0][0], $ris[0][1], $ris[0][2], $ris[0][3], $ris[0][4], $ris[0][5], $ris[0][6], $ris[0][7], $ris[0][8], $ris[0][9], $ris[0][10]);}
                return $ordine;
            }
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

    public static function store(EOrdine $ordine)
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
        $IDLuogo = $ordine->getLuogoConsegna()->getIDLuogo();
        $ProdottiOrdinati = $ordine->getProdottiOrdinati();

        $conn = FDataBase::Connect();
        foreach($ProdottiOrdinati as $val)
        {
            $ID = $val[0]->getIDProdotto();
            $quantita = $val[1];
            $sql1 = "INSERT INTO E_Composto_Da (`IDOrdine`, `IDProdotto`, `Quantita`) VALUES('$IDOrdine' , '$ID' , '$quantita')";
            $conn->query($sql1);
        }

        $sql = "INSERT INTO Ordine (`DataOrdinazione`, `DataConsegna`, `Nota`, `PrezzoTotale`, `TipoPagamento`, `StatoOrdine`, `PuntiUsati`, `TelefonoConsegna`, `NomeUtente`, `IDLuogo`) VALUES('".addslashes("$DataOrdinazione")."' , '".addslashes("$DataConsegna")."' , '" . addslashes("$Nota") . "' , '$PrezzoTotale' , '" . addslashes("$TipoPagamento") . "' , '" . addslashes("$StatoOrdine") . "' , '$PuntiUsati' , '" . addslashes("$TelefonoConsegna") . "' , '" . addslashes("$NomeUtente") . "' , '$IDLuogo')";
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

$ordine = new EOrdine(122,'2019-12-12 14:36:12','2019-12-12 15:00:00','citofonare al terzo piano',34.5,$prodotti,'contanti','ok','massimo',$luogo,3,'33441234',$giudizio);
FOrdine::store($ordine);*/

//FOrdine::delete(111);



//$test->setPrezzoTotale(200);
//FOrdine::update($test);
//print $test->toString1();



/*$prodotti3 = array();
for ($i=1; $i<6; $i++)
{
    $oggetto = FProdotto::load($i);
    array_push($prodotti3, $oggetto);
}
$bevanda = FProdotto::load(33);
array_push($prodotti3, $bevanda);

$prodotti4 = array(array($prodotti3[0],3),
                   array($prodotti3[1],2),
                   array($prodotti3[2],1),
                   array($prodotti3[3],5),
                   array($prodotti3[4],2),
                   array($prodotti3[5],3));
$giudizio = new EGiudizio('fantastico',44,'11-11-11 15:33:00',3,13);
$luogo = new ELuogo(1,'vicovaro','RM','giuseppe mazzini','7');
$ordine = new EOrdine(23,'2019-01-01 09:20:01','2019-01-01 17:00:00','bussare al 5/b',100,$prodotti4,'baratto','chiuso','mazzeta', $luogo,15,'3387651234', $giudizio);

print $ordine->toString();
print"\n";
print"\n";
$prezzoTotale = $ordine->getPrezzoTotale();
print $prezzoTotale;
print"\n";
print"\n";*/
//$PRODOTTISCELTI = $ordine->getProdottiOrdinati();
//print_r($PRODOTTISCELTI);

/*$datacon = $ordine->getDataConsegna();
$ordine->setDataOrdinazione($datacon);
print"\n";
print $ordine->toString();
print"\n";*/

//FOrdine::store($ordine);

/*$ennesimoTest = FOrdine::load(23);
print $ennesimoTest->toString1();
$ennesimaData = $ennesimoTest->getDataConsegna();*/

/*$prodotti3 = array();
for ($i=1; $i<6; $i++)
{
    $oggetto = FProdotto::load($i);
    array_push($prodotti3, $oggetto);
}
$prodotti4 = array(array($prodotti3[0],3),
                   array($prodotti3[1],2),
                   array($prodotti3[2],1),
                   array($prodotti3[3],5),
                   array($prodotti3[4],2));

$giudizio = new EGiudizio('fantastico',44,'11-11-11 15:33:00',3,13);
$luogo = new ELuogo(1,'vicovaro','RM','giuseppe mazzini','7');
$ordine = new EOrdine(23,'2019-01-01 09:20:01','2019-01-01 17:00:00','citofonare interno 11',200,$prodotti4,'in natura','chiuso','mazzeta', $luogo,15,'3387651234', $giudizio);
$bevanda = FProdotto::load(20);
$ordine->addSingoloProdotto($bevanda,22);
$PRODOTTISCELTI = $ordine->getProdottiOrdinati();
print_r($PRODOTTISCELTI);*/