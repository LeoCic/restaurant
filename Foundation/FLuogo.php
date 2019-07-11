<?php
require_once '../Indice.php';


//  query restituisce un oggetto se va a buon fine altrimenti falso su cui posso fare rowCount comunque (se false rida zero righe)
//prima di richiamare la store e load dobbiamo richiamare l'exists
// se le classe torna null facciamo un try catch (NEL CONTROLLORE)
// addslashes i caratteri '  " nulbyte \ non vengono visti come caratteri speciali
//esegue anche ELUogo perchè?
abstract class FLuogo
{

    public static function load(float $id) : ELuogo
    {
        $conn = FDataBase::Connect();
        $sql = " SELECT * FROM luogo WHERE (IDLuogo='$id') ";
        $riss = $conn->query($sql);
        if ($riss->rowCount() == 1) {
            $ris = $riss->fetchAll();
            //print_r($ris);
            $r = new ELuogo($ris[0][0], $ris[0][1], $ris[0][2], $ris[0][3], $ris[0][4]);
            return $r;
        }
    }

    public static function exist(float $id): bool
    {
        $conn = FDataBase::Connect();
        $sql = " SELECT * FROM luogo WHERE (IDLuogo='$id') ";
        $riss = $conn->query($sql);
        $ris = $riss->fetchAll();
        if (count($ris) > 0)
            return 1;
        else
            return 0;

    }

    public static function store(ELuogo $luogo) : bool
    {
        $Comune = $luogo->getComune();
        $Provincia = $luogo->getProvincia();
        $Via = $luogo->getVia();
        $N_Civico = $luogo->getN_Civico();

        $conn = FDataBase::Connect();
        $sql = "INSERT INTO Luogo (Comune, Provincia, Via, N_Civico) VALUES('" . addslashes($Comune) . "' , '$Provincia' , '" . addslashes($Via) . "' , '" . addslashes($N_Civico) . "')";
        $riss = $conn->query($sql);
        if (is_bool($riss) )
            return 0;
        else if(is_object($riss))
            return 1;
    }

    public static function update (ELuogo $luogo) : bool
    {

        $IDLuogo = $luogo->getIDLuogo();
        $Via = $luogo->getVia();
        $N_Civico = $luogo->getN_Civico();
        $conn = FDataBase::Connect();
        $sql =" UPDATE luogo SET Via = '" . addslashes($Via) . "' , N_Civico = '" . addslashes($N_Civico) . "' WHERE IDLuogo = '$IDLuogo' " ;
        $riss = $conn->query($sql);
        if (is_bool($riss) )
            return 0;
        else if(is_object($riss))
            return 1;

    }

    public static function delete (float $id) : bool
    {
        $conn = FDataBase::Connect();
        $sql ="DELETE FROM luogo WHERE IDLuogo = '$id'";
        $riss = $conn->query($sql);
        if (is_bool($riss) )
            return 0;
        else if(is_object($riss))
            return 1;



    }





}

//test dei metodi
/*
$test=new ELuogo("L'Aquila","AQ","Germania",'4\n');
//test della store
$id = $test->getIDLuogo();
if ($id != 0){ //se zero(parametro di default assegnato nell'entity) il luogo non è sul db e deve essere storato
$control = FLuogo::exist($id);
 if ($control === TRUE )
    print "gia esiste per la store"."\n";
else {
$a = FLuogo::store($test);
 if($a === true){
    print "inserita con successo"."\n";}
else print "errore inserimento"."\n"; } }
else if($id===0) {
    $a = FLuogo::store($test);
if($a === true){
    print "inserita con successo"."\n";}
else print "errore inserimento"."\n";}
*/
//test della load e update

/*$control = FLuogo::exist(5);
if ($control=== TRUE) {//sono presenti sul db
    $luogo = FLuogo::load(5);
print $luogo->toString();
    $luogo->setN_Civico("2/af");}
*/
/*
$mazinga = FLuogo::update($luogo);
if ($mazinga == TRUE)
   print"modificato con successo";
else
    print"NON MODIFICATO";
}
else {
    print "NOT TROVATO"."\n";
}
*/
//test delete
/*
$control = FLuogo::exist(4);
if ($control == TRUE) {
    $a = FLuogo::delete(4);
    if ($a == TRUE)
        print"eliminato con successo";
    else
        print"NON ELIMINATO
    ";

}
else
    print"non trovato";
*/

























/* $conn = FDataBase::Connect();
$sql = " SELECT * FROM adfca";
$riss = $conn->query($sql);
if ($riss->rowCount() == 1) {
    $ris = $riss->fetchAll();
print gettype($ris[0][0]);
print($ris[0][0]);
print "\n";
$data = (String) $ris[0][0];
    $a = DateTime::createFromFormat('Y-m-d H:i:s', $data);
    print gettype($a);
    echo $a->format('Y-m-d H:i:s');
        print $a->format('Y-m-d');}
*/

/*       Prova DateTime su db
        $prova = new DateTime();
        $data = $prova->format('Y-m-d');
            $conn = FDataBase::Connect();
        $sql = "INSERT INTO adfca (jh) VALUES('$data')";
    $riss = $conn->query($sql);
    if (is_bool($riss) )
        print "NO";
    else if(is_object($riss))
        print"SI" ;
*/



//print_r($ris);




   /* try {
    $r = FLuogo::load("AQ", "L'Aqudila");
    } catch (TypeError $e)
     {
         print"Luogo non trovato";
     }
*/

