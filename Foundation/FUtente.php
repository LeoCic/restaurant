<?php

require_once 'Indice.php';

abstract class FUtente
{
    public static function load(String $id) : EUtente
    {
        $conn = FDataBase::Connect();
        $sql = " SELECT * FROM Utente WHERE (NomeUtente='$id') ";
        $riss = $conn->query($sql);
        if ($riss->rowCount() === 1)
        {
            $ris = $riss->fetchAll();
            $utente = new EUtente($ris[0][0], $ris[0][1], $ris[0][2], $ris[0][3], $ris[0][4], $ris[0][5], $ris[0][6], $ris[0][7], $ris[0][8]);
            return $utente;
        }
        else return null;
    }

    public static function exists(String $id) : bool
    {
        $conn = FDataBase::Connect();
        $sql = " SELECT * FROM Utente WHERE (NomeUtente='$id') ";
        $riss = $conn->query($sql);
        $ris = $riss->fetchAll();
        if (count($ris) === 1) return 1;
        else return 0;
    }

    public static function verificaEmail(String $email) : bool
    {
        $conn = FDataBase::Connect();
        $sql = " SELECT * FROM Utente WHERE (Email='$email') ";
        $riss = $conn->query($sql);
        $ris = $riss->fetchAll();
        if (count($ris) === 1) return 1;
        else return 0;
    }

    public static function accountvalidation(String $id, String $password): bool
    {
        $conn = FDataBase::Connect();
        $sql = " SELECT * FROM Utente WHERE (NomeUtente='$id') ";
        $riss = $conn->query($sql);
        $ris = $riss->fetchAll();
        if (count($ris) === 1)
        {
            $controllo = $ris[0][5];
            if((password_verify("$password", "$controllo") === TRUE)) {return 1;}
            else {return 0;}
        }
        else return 0;
    }

    public static function store(EUtente $utente) : bool
    {
        $Nome = $utente->getNome();
        $Cognome = $utente->getCognome();
        $NomeUtente = $utente->getNomeUtente();
        $Email = $utente->getEmail();
        $Telefono = $utente->getTelefono();
        $Password = $utente->getPasswordHash();
        $Punti = intval($utente->getPunti());
        $OrdiniCumulati = intval($utente->getOrdiniCumulati());
        try { $DataUltimoOrdine = $utente->getDataUltimoOrdine()->format('Y-m-d'); }
        catch (Error $e) { $DataUltimoOrdine = NULL; }

        $conn = FDataBase::Connect();

        $sql = "INSERT INTO Utente (`Nome`, `Cognome`, `NomeUtente`, `Email`, `Telefono`, `Password`, `Punti`, `OrdiniCumulati`, `DataUltimoOrdine`) VALUES ('" . addslashes("$Nome") . "' , '" . addslashes("$Cognome") . "' , '" . addslashes("$NomeUtente") . "' , '" . addslashes("$Email") . "' , '" . addslashes("$Telefono") . "' , '" . addslashes("$Password") . "' , '$Punti' , '$OrdiniCumulati' , '$DataUltimoOrdine')";
        $riss = $conn->query($sql);;
        if (is_bool($riss) ) return 0;
        else return 1;
    }

    public static function update (EUtente $utente) : bool
    {
        $Nome = $utente->getNome();
        $Cognome = $utente->getCognome();
        $NomeUtente = $utente->getNomeUtente();
        $Email = $utente->getEmail();
        $Telefono = $utente->getTelefono();
        $Password = $utente->getPasswordHash();
        $Punti = $utente->getPunti();
        $OrdiniCumulati = intval($utente->getOrdiniCumulati());
        try { $DataUltimoOrdine = $utente->getDataUltimoOrdine()->format('Y-m-d'); }
        catch (Error $e) { $DataUltimoOrdine = NULL; }
        $conn = FDataBase::Connect();
        $sql = "UPDATE utente SET Nome = '" . addslashes($Nome) . "' , Cognome = '" . addslashes($Cognome) . "' , Email = '$Email' , Telefono = '$Telefono' , Password = '$Password' , Punti = '$Punti' , OrdiniCumulati = '$OrdiniCumulati' , DataUltimoOrdine = '$DataUltimoOrdine' WHERE NomeUtente = '$NomeUtente' ";
        $riss = $conn->query($sql);
        if (is_bool($riss) ) return 0;
        else return 1;
    }

    public static function delete (String $id) : bool
    {
        $conn = FDataBase::Connect();
        $sql ="DELETE FROM utente WHERE NomeUtente = '$id'";
        $riss = $conn->query($sql);
        if (is_bool($riss) ) return 0;
        else return 1;
    }
}