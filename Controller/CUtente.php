<?php
require_once 'Indice.php';

class CUtente
{

    /**Metodo che verifica se l'utente è loggato */
    //funziona
    static function isLogged()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(isset($_SESSION['username'])) return true;
        else {
            //if($_SERVER['REQUEST_URI']!="/restaurant/Utente/login") $_SESSION['redirect']=$_SERVER['REQUEST_URI'];
            return false;
        }
    }

    public function Login()
    {
        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            //if(static::isLogged()) header('Location: /restaurant/Ordine/MostraListaProdotti');
          // else

            $validato = FUtente::accountvalidation($_POST['username'],$_POST['password']);
//momentaneamente senza cripto password
            //$validato = FUtente::accountvalidation($_POST['username'],password_hash($_POST['password'],PASSWORD_DEFAULT));
                if($validato == true)
                {
                    $controller = new COrdine();
                     $controller->MostraListaProdotti();
                }

                else {
                    $msg="user o pass errati";
                    print ("$msg");
                    header("Refresh:2; URL=/restaurant/Homepage");
                  //  header('Location: /restaurant/Homepage');
                }

        }
        else
        {
            header('HTTP/1.1 405 Method Not Allowed');
            header('Allow: POST');
        }

    }

    /** Metodo che provvede alla rimozione delle variabili di sessione, alla sua distruzione e a rinviare alla homepage  */
    static function logout(){
        session_start();
        session_unset();
        session_destroy();
        header('Location: /restaurant/Homepage');
    }

    /**Metodo per la cancellazione di un account. Si basa su una URL del tipo: /AppCrowdFunding/Utente/removeUser/username
     * dove lo username è quello dell'utente da rimuovere. Possono verificarsi diverse situazioni:
     * 1) se l'utente è loggato:
     *   1a) se il suo username corrisponde a quello dell'utente da cancellare si provvede alla cancellazione, viene effettuato il logout e
     *       viene mostrata la homepage;
     *   1b) se il suo username non corrisponde viene rispedito alla homepage;
     * 2) se l'utente non è loggato viene rinviato alla pagina di login.
     */
    static function removeUser($username=null){
        if(isset($username)){
            if(CUtente::isLogged()){
                if($_SESSION['username']==$username){
                    if(FUtente::delete($_SESSION['id'])){
                        session_unset();
                        session_destroy();
                        header('Location: /restaurant/Homepage');
                    }
                    else header('Location: /restaurant/Utente/profile');
                }
                else header('Location: /restaurant/Homepage');
            }
            else header('Location: /restaurant/Utente/login');
        }
        else header('Location: /restaurant/Homepage');
    }

    /*static function EnterIn($user)
    {
        if(!isset($user))
        {
            $view = new VUtente();
            if (FUtente::accountvalidation($_POST['username'],password_hash($_POST['password'],PASSWORD_DEFAULT)) === 1) $user = FUtente::load($_POST['username']);
            if($user!=null)
            {
                if (session_status() == PHP_SESSION_NONE) { session_start(); }
                $_SESSION['username']=$user->getUserName();
            }
            else { $view->MostraFormLogin(); }
        }
    }*/

    static function Registrazione()
    {
        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            if(CUtente::isLogged()) header('Location: /restaurant/Homepage');
        }
    }
}