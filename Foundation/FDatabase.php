<?php

 require_once 'config.inc.php';

  abstract class  FDatabase
  {
       public static function Connect()
  	   {
  	  	   global $host,$database,$username,$password;
  	  	   try
           {
               $db = new PDO("mysql:host=$host; dbname=$database", $username,$password);
           }
           catch(PDOException $e)
           {
               echo "Attenzione errore: ".$e->getMessage();
               die;
           }
           return $db;
  	   }
  }
