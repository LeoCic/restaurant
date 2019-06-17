<?php
require_once 'ELuogo.php';
require_once 'FDatabase.php';
//  query restituisce un oggetto se va a buon fine altrimenti falso su cui posso fare rowCount comunque (se false rida zero righe)
//prima di richiamare la store e load dobbiamo richiamare l'exists
// se le classe torna null facciamo un try catch (NEL CONTROLLORE)
// addslashes i caratteri '  " nulbyte \ non vengono visti come caratteri speciali
//esegue anche ELUogo perchè?
abstract class FLuogo
{

    public static function load(int $id): ELuogo
    {
        $conn = FDataBase::Connect();
        $sql = " SELECT * FROM luogo WHERE (IDLuogo='$id') ";
        $riss = $conn->query($sql);
        if ($riss->rowCount() == 1) {
            $ris = $riss->fetchAll();
            $r = new ELuogo($ris[0][0], $ris[0][1], $ris[0][2], $ris[0][3]);
            return $r;
        }



    }

    public static function exist(int $id): bool
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

   /* public static function update (ELuogo $luogo) : bool
    {
        $Comune = $luogo->getComune();
        $Provincia = $luogo->getProvincia();
        $Via = $luogo->getVia();
        $N_Civico = $luogo->getN_Civico();

        $conn = FDataBase::Connect();
        $sql =" UPDATE luogo SET Via = '$Via' " ;

    } */





}
//test dei metodi
$test=new ELuogo("L'Aquila","AQ","Germania",'4\n',7);
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
else if($id===0)
    $a = FLuogo::store($test);

//test della load
$control = FLuogo::exist($id);
if ($control=== TRUE) {//sono presenti sul db
    $luogo = FLuogo::load($id);
print $luogo->toString(); }
else {
    print "NOT TROVATO"."\n";

}


























   /* try {
    $r = FLuogo::load("AQ", "L'Aqudila");
    } catch (TypeError $e)
     {
         print"Luogo non trovato";
     }
*/

