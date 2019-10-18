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
        else {return false;}
    }

    public function Login()
    {
        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            //if(static::isLogged()) header('Location: /restaurant/Ordine/MostraListaProdotti');
            // else

            $validato = FUtente::accountvalidation($_POST['username'],$_POST['password']);
                if($validato === true)
                {
                    session_start();
                    $_SESSION['username'] = $_POST['username'];
                    $_SESSION['password'] = $_POST['password']; //forse non necessaria
                    $_SESSION['sconto'] =false;
                    header("Location: /restaurant/Ordine/MostraListaProdotti");
                }
                else {
                    $msg="user o pass errati";
                    print ("$msg");
                    //print (password_hash($_POST['password'],PASSWORD_DEFAULT));
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

    static function MostraFormRegistrazione()
    {
        $view = new VUtente();
        $view->MostraFormRegistrazione();

    }

    static function Registrazione()
    {
        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            if(CUtente::isLogged()) header('Location: /restaurant/Ordine/MostraListaProdotti');
            else
                {
                    $nome = $_POST['nome'];
                    $cognome = $_POST['cognome'];
                    $username = $_POST['username'];
                    $telefono = $_POST['telefono'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $conferma_password = $_POST['conferma_password'];
                    if ($password != $conferma_password){

                        $error = "Le password non coincidono";
                        $view = new VUtente();
                        $view->MostraFormConErrore($error);
                    }
                    else if ($password === $conferma_password){

                        if(FUtente::exists($username) === true){

                            $error = "Username già presente";
                            $view = new VUtente();
                            $view->MostraFormConErrore($error);
                        }

                        else if (FUtente::exists($username) === false){

                            session_start();
                            session_unset();
                            session_destroy();

                            $utente = new EUtente($nome, $cognome, $username, $email, $telefono, $password,0);
                            FUtente::store($utente);
                            session_start();
                            $_SESSION['username'] = $username;
                            $_SESSION['sconto'] =false;
                            header('Location: /restaurant/Ordine/MostraListaProdotti');
                        }
                    }



                }
        }
    }
}