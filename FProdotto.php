<?php

//require_once 'EProdotto.php';
require_once 'ECibo.php';
require_once 'EBevanda.php';
require_once 'FDatabase.php';

abstract class FProdotto
{
    public static function load(int $id) : EProdotto
    {
        $conn = FDataBase::Connect();
        $sql = " SELECT * FROM Prodotto WHERE (IDProdotto='$id') ";
        $riss = $conn->query($sql);
        if ($riss->rowCount() === 1) {
            $ris = $riss->fetchAll();
            if ($ris[0][6] === 'Bevande')
            {
                if($ris[0][3] === NULL)
                {
                    if($ris[0][5] === NULL){$prodotto = new EBevanda($ris[0][0], $ris[0][1], $ris[0][2], 'NULL', $ris[0][4], 0, $ris[0][6], $ris[0][11], $ris[0][12], $ris[0][13]);}
                    else {$prodotto = new EBevanda($ris[0][0], $ris[0][1], $ris[0][2], 'NULL', $ris[0][4], $ris[0][5], $ris[0][6], $ris[0][11], $ris[0][12], $ris[0][13]);}
                }
                else
                {
                    if($ris[0][5] === NULL){$prodotto = new EBevanda($ris[0][0], $ris[0][1], $ris[0][2], $ris[0][3], $ris[0][4], 0, $ris[0][6], $ris[0][11], $ris[0][12], $ris[0][13]);}
                    else {$prodotto = new EBevanda($ris[0][0], $ris[0][1], $ris[0][2], $ris[0][3], $ris[0][4], $ris[0][5], $ris[0][6], $ris[0][11], $ris[0][12], $ris[0][13]);}
                }
                return $prodotto;
            }

            else if ($ris[0][6] != 'Bevande')
            {
                if($ris[0][3] === NULL)
                {
                    if($ris[0][5] === NULL){$prodotto = new ECibo($ris[0][0], $ris[0][1], $ris[0][2], 'NULL', $ris[0][4], 0, $ris[0][6], $ris[0][7], $ris[0][8], $ris[0][9], $ris[0][10]);}
                    else {$prodotto = new ECibo($ris[0][0], $ris[0][1], $ris[0][2], 'NULL', $ris[0][4], $ris[0][5], $ris[0][6], $ris[0][7], $ris[0][8], $ris[0][9], $ris[0][10]);}
                }
                else
                {
                    if($ris[0][5] === NULL){$prodotto = new ECibo($ris[0][0], $ris[0][1], $ris[0][2], $ris[0][3], $ris[0][4], 0, $ris[0][6], $ris[0][7], $ris[0][8], $ris[0][9], $ris[0][10]);}
                    else {$prodotto = new ECibo($ris[0][0], $ris[0][1], $ris[0][2], $ris[0][3], $ris[0][4], $ris[0][5], $ris[0][6], $ris[0][7], $ris[0][8], $ris[0][9], $ris[0][10]);}
                }
                return $prodotto;
            }
        }
    }

    public static function exists(int $id) : bool
    {
        $conn = FDataBase::Connect();
        $sql = " SELECT * FROM Prodotto WHERE (IDProdotto='$id') ";
        $riss = $conn->query($sql);
        $ris = $riss->fetchAll();
        if (count($ris) === 1) return 1;
        else return 0;
    }

    public static function storeBevanda(EBevanda $prodotto) : bool
    {
        $Nome = $prodotto->getNome();
        $Prezzo = $prodotto->getPrezzo();
        $Descrizione = $prodotto->getDescrizione();
        $Ingredienti = $prodotto->getIngredienti();
        $Biologico = $prodotto->getBiologico();
        $Categoria = $prodotto->getCategoria();
        $GradoAlcolico = $prodotto->getGradoAlcolico();
        $Gassato = $prodotto->getGassato();
        $Disponibilita = $prodotto->getDisponibilita();

        $conn = FDataBase::Connect();
        $sql = "INSERT INTO Prodotto (`Nome`, `Prezzo`, `Descrizione`, `Ingredienti`, `Biologico`, `Categoria`, `GradoAlcolico`, `Gassato`, `Disponibilita`) VALUES('" . addslashes("$Nome") . "' , '$Prezzo' , '" . addslashes("$Descrizione") . "' , '" . addslashes("$Ingredienti") . "' , '$Biologico' , '" . addslashes("$Categoria") . "' , '$GradoAlcolico'  , '$Gassato' , '$Disponibilita')";
        $riss = $conn->query($sql);
        if (is_bool($riss))
            return 0;
        else if (is_object($riss))
            return 1;

    }

    public static function storeCibo(ECibo $prodotto) : bool
    {
        $Nome = $prodotto->getNome();
        $Prezzo = $prodotto->getPrezzo();
        $Descrizione = $prodotto->getDescrizione();
        $Ingredienti = $prodotto->getIngredienti();
        $Biologico = $prodotto->getBiologico();
        $Categoria = $prodotto->getCategoria();
        $Congelato = $prodotto->getCongelato();
        $Vegano = $prodotto->getVegano();
        $Glutine = $prodotto->getGlutine();
        $Integrale = $prodotto->getIntegrale();

        $conn = FDataBase::Connect();
        $sql = "INSERT INTO Prodotto (`Nome`, `Prezzo`, `Descrizione`, `Ingredienti`, `Biologico`, `Categoria`, `Congelato`, `Vegano`, `Glutine`, `Integrale`) VALUES('" . addslashes("$Nome") . "' , '$Prezzo' , '" . addslashes("$Descrizione") . "' , '" . addslashes("$Ingredienti") . "' , '$Biologico' , '" . addslashes("$Categoria") . "' , '$Congelato' , '$Vegano' , '$Glutine' , '$Integrale')";
        $riss = $conn->query($sql);
        if (is_bool($riss))
            return 0;
        else if (is_object($riss))
            return 1;

    }

    public static function updateBevanda(EBevanda $prodotto) : bool
    {

        $Nome = $prodotto->getNome();
        $IDProdotto = $prodotto->getIDProdotto();
        $Prezzo = $prodotto->getPrezzo();
        $Descrizione = $prodotto->getDescrizione();
        $Ingredienti = $prodotto->getIngredienti();
        $Biologico = $prodotto->getBiologico();
        $Categoria = $prodotto->getCategoria();
        $GradoAlcolico = $prodotto->getGradoAlcolico();
        $Gassato = $prodotto->getGassato();
        $Disponibilita = $prodotto->getDisponibilita();

        $conn = FDataBase::Connect();
        $sql =" UPDATE Prodotto SET Nome = '" . addslashes($Nome) . "' , Prezzo = '$Prezzo' , Descrizione = '" . addslashes($Descrizione) . "' , Ingredienti = '" . addslashes($Ingredienti) . "' , Biologico = '$Biologico' , Categoria = '" . addslashes($Categoria) . "' , GradoAlcolico = '$GradoAlcolico' , Gassato = '$Gassato' , Disponibilita = '$Disponibilita' WHERE IDProdotto = '$IDProdotto' " ;
        $riss = $conn->query($sql);
        if (is_bool($riss) )
            return 0;
        else if(is_object($riss))
            return 1;

    }

    public static function updateCibo(ECibo $prodotto) : bool
    {

        $Nome = $prodotto->getNome();
        $IDProdotto = $prodotto->getIDProdotto();
        $Prezzo = $prodotto->getPrezzo();
        $Descrizione = $prodotto->getDescrizione();
        $Ingredienti = $prodotto->getIngredienti();
        $Biologico = $prodotto->getBiologico();
        $Categoria = $prodotto->getCategoria();
        $Congelato = $prodotto->getCongelato();
        $Vegano = $prodotto->getVegano();
        $Glutine = $prodotto->getGlutine();
        $Integrale = $prodotto->getIntegrale();

        $conn = FDataBase::Connect();
        $sql =" UPDATE Prodotto SET Nome = '" . addslashes($Nome) . "' , Prezzo = '$Prezzo)' , Descrizione = '" . addslashes($Descrizione) . "' , Ingredienti = '" . addslashes($Ingredienti) . "' , Biologico = '$Biologico' , Categoria = '" . addslashes($Categoria) . "' , Congelato = '$Congelato' , Vegano = '$Vegano' , Glutine = '$Glutine' , Integrale = '$Integrale' WHERE IDProdotto = '$IDProdotto' " ;
        $riss = $conn->query($sql);
        if (is_bool($riss) )
            return 0;
        else if(is_object($riss))
            return 1;

    }

    public static function delete(int $id) : bool
    {
        $conn = FDataBase::Connect();
        $sql ="DELETE FROM Prodotto WHERE IDProdotto = '$id'";
        $riss = $conn->query($sql);
        if (is_bool($riss) )
            return 0;
        else if(is_object($riss))
            return 1;
    }
}

//$p = FProdotto::load(32);
//print $p->toString();
//$p->setPrezzo(1.5);
//FProdotto::updateBevanda($p);


//if(FProdotto::exists(67)){print "si";}
//else{print "no";}

//$test = new EBevanda("gasolio",45,1,"xxxxxx","yyyyy",1,'Bevande',1,1,1);
//FProdotto::storeBevanda($test);
//FProdotto::delete(75);