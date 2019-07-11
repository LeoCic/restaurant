<?php
//aggiungere idLuogo per il db e inizializzarlo a ull nel costruttore, poi fare 2 casi nel to string

class
ELuogo {
    private $Comune;
    private $Provincia;
    private $Via;
    private $N_Civico;
    private $IDLuogo;


    public function __construct() {
        $num_args = func_num_args();
        $args = func_get_args();
        call_user_func_array(array(&$this, '__construct_'. $num_args), $args);
    }

    public function __construct_4( String $Comune , String $Provincia , String $Via , String $N_Civico) {

      $this->Comune = $Comune;
      $this->Provincia = $Provincia;
      $this->Via = $Via;
      $this->N_Civico = $N_Civico;
      $this->IDLuogo = 0;
    }
    public function __construct_5( float $IDLuogo, String $Comune , String $Provincia , String $Via , String $N_Civico ) {

        $this->Comune = $Comune;
        $this->Provincia = $Provincia;
        $this->Via = $Via;
        $this->N_Civico = $N_Civico;
        $this->IDLuogo = $IDLuogo;

    }

    public function getComune(): String{

        return $this->Comune;
    }

    public function setComune( String $Comune) :void
    {

        $this->Comune = $Comune;
    }

    public function getProvincia(): String
    {
        return $this->Provincia;
    }

    public function setProvincia(String $Provincia):void
    {
        $this->Provincia = $Provincia;
    }

    public function getVia(): String
    {
        return $this->Via;
    }

    public function setVia(String $Via):void
    {
        $this->Via = $Via;
    }

    public function getN_Civico(): String
    {
        return $this->N_Civico;
    }

    public function setN_Civico(String $N_Civico):void
    {
        $this->N_Civico = $N_Civico;
    }


    public function getIDLuogo() : float
    {
        return $this->IDLuogo;
    }

    public function toString() : String
    {
        if (isset($this->IDLuogo))
        return $this->getComune()."\n".$this->getProvincia()."\n".$this->getVia()."\n".$this->N_Civico."\n".$this->IDLuogo;
        else
            return $this->getComune()."\n".$this->getProvincia()."\n".$this->getVia()."\n".$this->N_Civico."\n";

    }


}
/*prova get e set */

//$test=new ELuogo("Roma","RM","Germania","4");
//$test1= new ELuogo("2","Roma","RM","Germania","4");
//print $test->getIDLuogo();
//test se getIDLuogo ritorna null, NON FUNZIONANTE
/*$test=new ELuogo("Roma","RM","Germania","4");
try{
print ($test->getIDLuogo());}
catch (Exception $e)
{
    //echo $e->getMessage();
    print"Luogo nullo";
}
//print $test->toString();

//print $test->getIDLuogo()."\n";
*/



