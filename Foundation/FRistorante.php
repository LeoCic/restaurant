<?php
require_once 'Indice.php';


abstract class FRistorante
{
    public static function loadCatalogoProdotti() //torna un array multidimensionale chiave valore
    {
        $conn = FDataBase::Connect();
        $sql = " SELECT * FROM Prodotto";
        $riss = $conn->query($sql);
        $ris = $riss->fetchAll();
        foreach($ris as $key => $val)
        {
            if ($val[6] === 'Bevande')
            {
                if($val[3] === NULL)
                {
                    if($val[5] === NULL) { $prodotto = new EBevanda($val[0], $val[1], $val[2], 'NULL', $val[4], 0, $val[6], $val[11], $val[12], $val[13]); }
                    else { $prodotto = new EBevanda($val[0], $val[1], $val[2], 'NULL', $val[4], $val[5], $val[6], $val[11], $val[12], $val[13]); }
                }
                else
                {
                    if($val[5] === NULL) { $prodotto = new EBevanda($val[0], $val[1], $val[2], $val[3], $val[4], 0, $val[6], $val[11], $val[12], $val[13]); }
                    else { $prodotto = new EBevanda($val[0], $val[1], $val[2], $val[3], $val[4], $val[5], $val[6], $val[11], $val[12], $val[13]); }
                }
                ERistorante::setSingoloProdotto($prodotto);
            }
            else if ($ris[0][6] !== 'Bevande')
            {
                if($val[3] === NULL)
                {
                    if($val[5] === NULL) { $prodotto = new ECibo($val[0], $val[1], $val[2], 'NULL', $val[4], 0, $val[6], $val[7], $val[8], $val[9], $val[10]); }
                    else { $prodotto = new ECibo($val[0], $val[1], $val[2], 'NULL', $val[4], $val[5], $val[6], $val[7], $val[8], $val[9], $val[10]); }
                }
                else
                {
                    if($ris[0][5] === NULL) { $prodotto = new ECibo($val[0], $val[1], $val[2], $val[3], $val[4], 0, $val[6], $val[7], $val[8], $val[9], $val[10]); }
                    else { $prodotto = new ECibo($val[0], $val[1], $val[2], $val[3], $val[4], $val[5], $val[6], $val[7], $val[8], $val[9], $val[10]); }
                }
                ERistorante::setSingoloProdotto($prodotto);
            }
        }
    }

    public static function loadRistorante(): void
    {
        $conn = FDataBase::Connect();
        $sql = " SELECT * FROM Ristorante";
        $riss = $conn->query($sql);
        $ris = $riss->fetchAll();
        if (count($ris) === 1)
        {
            FRistorante::loadCatalogoProdotti();
            $sede =FLuogo::load( $ris[0]['IDLuogo']);
            ERistorante::setSede($sede);
            ERistorante::setCellulare($ris[0]['Cellulare']);
            ERistorante::setNome($ris[0]['Nome']);
            ERistorante::setTelefonoFisso($ris[0]['TelefonoFisso']);
            ERistorante::setProprietario($ris[0]['Proprietario']);
            ERistorante::setEntitaScontoAPunti($ris[0]['EntitaScontoAPunti']);
            ERistorante::setEntitaScontoBase($ris[0]['EntitaScontoBase']);
            $giorni = explode("=", $ris[0]['GiorniDiApertura']);
            for($i=0;$i<14;$i=$i+2)
            {
                $giorniDiApertura[$giorni[$i]] = $giorni[$i+1]; //crea l'array in un formato predefinito sul db
            }
            ERistorante::setGiorniDiApertura($giorniDiApertura);
        }
    }

    public static function loadProdottiByCategoria(String $cat) : array
    {
        $conn = FDataBase::Connect();
        $sql = " SELECT * FROM Prodotto WHERE Categoria = '$cat' ";
        $riss = $conn->query($sql);
        $ris = $riss->fetchAll();
        return $ris;
    }
}