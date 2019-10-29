<?php

require_once 'Indice.php';

abstract class FLuogo
{

    public static function load(float $id) : ELuogo
    {
        $conn = FDataBase::Connect();
        $sql = " SELECT * FROM luogo WHERE (IDLuogo='$id') ";
        $riss = $conn->query($sql);
        if ($riss->rowCount() == 1)
        {
            $ris = $riss->fetchAll();
            $r = new ELuogo($ris[0][0], $ris[0][1], $ris[0][2], $ris[0][3], $ris[0][4]);
            return $r;
        }
        else return null;
    }

    public static function exist(float $id): bool
    {
        $conn = FDataBase::Connect();
        $sql = " SELECT * FROM luogo WHERE (IDLuogo='$id') ";
        $riss = $conn->query($sql);
        $ris = $riss->fetchAll();
        if (count($ris) > 0)  return 1;
        else return 0;
    }

    public static function exist2(string $Comune, string $Via, string $N_Civico): bool
    {
        $conn = FDataBase::Connect();
        $sql = " SELECT * FROM luogo WHERE (`Comune` ='" . addslashes($Comune) . "') AND (`Via` = '" . addslashes($Via) . "') AND (`N_Civico` = '" . addslashes($N_Civico) . "') ";
        $riss = $conn->query($sql);
        $ris = $riss->fetchAll();
        if (count($ris) > 0)  return 1;
        else return 0;
    }

    public static function store(ELuogo $luogo) : bool
    {
        $Comune = $luogo->getComune();
        $Provincia = $luogo->getProvincia();
        $Via = $luogo->getVia();
        $N_Civico = $luogo->getN_Civico();

        $conn = FDataBase::Connect();
        $sql = "INSERT INTO Luogo (`Comune`, `Provincia`, `Via`, `N_Civico`) VALUES('" . addslashes($Comune) . "' , '$Provincia' , '" . addslashes($Via) . "' , '" . addslashes($N_Civico) . "')";
        $riss = $conn->query($sql);
        if (is_bool($riss) )  return 0;
        else return 1;
    }

    public static function update (ELuogo $luogo) : bool
    {
        $IDLuogo = $luogo->getIDLuogo();
        $Via = $luogo->getVia();
        $N_Civico = $luogo->getN_Civico();
        $conn = FDataBase::Connect();
        $sql =" UPDATE luogo SET Via = '" . addslashes($Via) . "' , N_Civico = '" . addslashes($N_Civico) . "' WHERE IDLuogo = '$IDLuogo' " ;
        $riss = $conn->query($sql);
        if (is_bool($riss) )  return 0;
        else return 1;
    }

    public static function delete (float $id) : bool
    {
        $conn = FDataBase::Connect();
        $sql ="DELETE FROM luogo WHERE IDLuogo = '$id'";
        $riss = $conn->query($sql);
        if (is_bool($riss) ) return 0;
        else return 1;
    }

    public static function id (String $Comune, String $Via , String $N_Civico): int
    {
        $conn = FDataBase::Connect();
        $sql = " SELECT DISTINCT * FROM Luogo WHERE   ( Comune = '" . addslashes($Comune) . "' ) AND ( Via = '" . addslashes($Via) . "')  AND ( N_Civico = '" . addslashes($N_Civico) . "') ";
        $riss = $conn->query($sql);
        $ris = $riss->fetchAll();
        return $ris[0][0];
    }
}