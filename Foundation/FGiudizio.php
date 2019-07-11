<?php

require_once '../Indice.php';

abstract class FGiudizio
{
    public static function loadGiudizioSingolo(float $IDOrdine) : EGiudizio
    {
        $conn = FDataBase::Connect();
        $sql = " SELECT * FROM Giudizio WHERE (IDOrdine='$IDOrdine') ";
        $riss = $conn->query($sql);
        if ($riss->rowCount() === 1)
        {
            $ris = $riss->fetchAll();
            $giudizio = new EGiudizio($ris[0][0], $ris[0][1], $ris[0][2],$ris[0][4],$ris[0][3]);
            /*echo $ris[0][0];
            echo "\n";
            echo $ris[0][1];
            echo "\n";
            echo $ris[0][2];
            echo "\n";
            echo $ris[0][3];
            echo "\n";
            echo $ris[0][4];*/
            return $giudizio;
        }
        else return null;
    }

    public static function MediaGiudiziComplessivi() : float
    {
        $conn = FDataBase::Connect();
        $sql = " SELECT AVG(Punteggio) FROM Giudizio ";
        $riss = $conn->query($sql);
        $ris = $riss->fetchAll();
        if (count($ris) === 1) return $ris[0][0];
        else return null;
    }

    public static function exists(float $id) : bool
    {
        $conn = FDataBase::Connect();
        $sql = " SELECT * FROM Giudizio WHERE (IDGiudizio='$id') ";
        $riss = $conn->query($sql);
        $ris = $riss->fetchAll();
        if (count($ris) === 1) return 1;
        else return 0;
    }

    public static function store(EGiudizio $giudizio) : bool
    {
        $Commento = $giudizio->getCommento();
        $Punteggio = $giudizio->getPunteggio();
        $IDOrdine = $giudizio->getIDOrdine();
        $Data = $giudizio->getData()->format('Y-m-d H:i:s');
        $conn = FDataBase::Connect();
        $sql = "INSERT INTO Giudizio (Commento, Punteggio, IDOrdine, Data) VALUES ('" . addslashes("$Commento") . "', '$Punteggio', '$Data', '$IDOrdine') ";
        $riss = $conn->query($sql);
        if (is_bool($riss) ) return 0;
        else if(is_object($riss)) return 1;
        else return null;
    }

    public static function delete (float $id) : bool
    {
        $conn = FDataBase::Connect();
        $sql ="DELETE FROM Giudizio WHERE IDGiudizio = '$id'";
        $riss = $conn->query($sql);
        if (is_bool($riss) ) return 0;
        else if(is_object($riss)) return 1;
        else return null;
    }
}
//$prova = new EGiudizio('ciao',2,21);
//FGiudizio::store($prova);
//$giudizio = FGiudizio::loadGiudizioSingolo(21);
//echo $giudizio->toString();
//echo FGiudizio::MediaGiudiziComplessivi();