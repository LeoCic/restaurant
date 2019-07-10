<?php
require_once 'FDatabase.php';
require_once 'ERistorante.php';
require_once 'EBevanda.php';




abstract class FRistorante
{

    public static function loadCatalogoProdotti()
       {
           $conn = FDataBase::Connect();
           $sql = " SELECT * FROM Prodotto";
           $riss = $conn->query($sql);
           $ris = $riss->fetchAll();
              foreach($ris as $key => $val) {
                  if ($val[6] === 'Bevande')
                  {
                      if($val[3] === NULL)
                      {
                          if($val[5] === NULL){$prodotto = new EBevanda($val[0], $val[1], $val[2], 'NULL', $val[4], 0, $val[6], $val[11], $val[12], $val[13]);}
                          else {$prodotto = new EBevanda(val[0], $val[1], $val[2], 'NULL', $val[4], $val[5], $val[6], $val[11], $val[12], $val[13]);}
                      }
                      else
                      {
                          if($val[5] === NULL){$prodotto = new EBevanda($val[0], $val[1], $val[2], $val[3], $val[4], 0, $val[6], $val[11], $val[12], $val[13]);}
                          else {$prodotto = new EBevanda($val[0], $val[1], $val[2], $val[3], $val[4], $val[5], $val[6], $val[11], $val[12], $val[13]);}
                      }
                      ERistorante::setSingoloProdotto($prodotto);
                   }

              }

            print_r(ERistorante::getCatalogoProdotti());
       }

}
FRistorante::loadCatalogoProdotti();