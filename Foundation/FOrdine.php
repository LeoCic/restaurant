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
                if ($ris[0][7] === NULL)  { $ordine = new EOrdine($ris[0][0], $ris[0][1], $ris[0][2], 'NULL', $ris[0][4], $ris[0][5], $ris[0][6], 'NULL', $ris[0][8], $ris[0][9]); }
                else {$ordine = new EOrdine($ris[0][0], $ris[0][1], $ris[0][2], 'NULL', $ris[0][4], $ris[0][5], $ris[0][6], $ris[0][7], $ris[0][8], $ris[0][9]); }
                return $ordine;
            }
            else
            {
                if ($ris[0][7] === NULL) { $ordine = new EOrdine($ris[0][0], $ris[0][1], $ris[0][2], $ris[0][3], $ris[0][4], $ris[0][5], $ris[0][6], 'NULL', $ris[0][8], $ris[0][9]); }
                else {$ordine = new EOrdine($ris[0][0], $ris[0][1], $ris[0][2], $ris[0][3], $ris[0][4], $ris[0][5], $ris[0][6], $ris[0][7], $ris[0][8], $ris[0][9]); }
                return $ordine;
            }
        }
        else return null;
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
        $DataOrdinazione = $ordine->getDataOrdinazione()->format('Y-m-d H:i:s');
        $DataConsegna = $ordine->getDataConsegna()->format('Y-m-d H:i:s');
        $Nota = $ordine->getNota();
        $PrezzoTotale = $ordine->getPrezzoTotale();
        $TipoPagamento = $ordine->getTipoPagamento();
        $PuntiUsati = $ordine->getPuntiUsati();
        $TelefonoConsegna = $ordine->getTelefonoConsegna();
        $NomeUtente = $ordine->getNomeUtente();
        $IDLuogo = $ordine->getIDLuogo();

        $conn = FDataBase::Connect();
        $sql = "INSERT INTO Ordine (`DataOrdinazione`, `DataConsegna`, `Nota`, `PrezzoTotale`, `TipoPagamento`, `PuntiUsati`, `TelefonoConsegna`, `NomeUtente`, `IDLuogo`) VALUES ('" . addslashes("$DataOrdinazione") . "' , '" . addslashes("$DataConsegna") . "' , '" . addslashes("$Nota") . "' , '$PrezzoTotale' , '" . addslashes("$TipoPagamento") . "' ,'$PuntiUsati' , '" . addslashes("$TelefonoConsegna") . "' , '" . addslashes("$NomeUtente") . "' , '$IDLuogo')";
        $riss = $conn->query($sql);
        $_SESSION['lastIDOrdine'] = $conn->lastInsertId();

        if (is_bool($riss)) return 0;
        else return 1;
    }

    public static function storeECompostoDa(array $ProdottiOrdinati, int $IDOrdine) : bool
    {
        $conn = FDataBase::Connect();
        foreach($ProdottiOrdinati as $val)
        {
            $ID = $val[0]->getIDProdotto();
            $quantita = $val[1];
            $sql = "INSERT INTO E_Composto_Da (`IDOrdine`, `IDProdotto`, `Quantita`) VALUES('$IDOrdine' , '$ID' , '$quantita')";

            $riss = $conn->query($sql);
        }
        if (is_bool($riss)) return 0;
        else return 1;
    }

    public static function update(EOrdine $ordine) : bool
    {
        $IDOrdine = $ordine->getID();
        $DataOrdinazione = $ordine->getDataOrdinazione()->format('Y-m-d H:i:s');
        $DataConsegna = $ordine->getDataConsegna()->format('Y-m-d H:i:s');
        $Nota = $ordine->getNota();
        $PrezzoTotale = $ordine->getPrezzoTotale();
        $TipoPagamento = $ordine->getTipoPagamento();
        $PuntiUsati = $ordine->getPuntiUsati();
        $TelefonoConsegna = $ordine->getTelefonoConsegna();
        $NomeUtente = $ordine->getNomeUtente();
        $IDLuogo = $ordine->getIDLuogo();

        $conn = FDataBase::Connect();
        $sql = " UPDATE Ordine SET DataOrdinazione = '" . addslashes($DataOrdinazione) . "' , DataConsegna = '" . addslashes($DataConsegna) . "' , Nota = '" . addslashes($Nota) . "' , PrezzoTotale = '$PrezzoTotale' , TipoPagamento = '" . addslashes($TipoPagamento) . "' , PuntiUsati = '$PuntiUsati' , TelefonoConsegna = '" . addslashes($TelefonoConsegna) . "' , NomeUtente = '" . addslashes($NomeUtente) . "' , IDLuogo = '$IDLuogo' WHERE IDOrdine = '$IDOrdine' ";
        $riss = $conn->query($sql);
        if (is_bool($riss) )  return 0;
        else return 1;
    }

    public static function delete (float $id) : bool
    {
        $conn = FDataBase::Connect();
        $sql ="DELETE FROM Ordine WHERE IDOrdine = '$id'";
        $riss = $conn->query($sql);
        if (is_bool($riss) ) return 0;
        else return 1;
    }
}