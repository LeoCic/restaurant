<?php
require_once 'Indice.php';

class CUtente
{
    /**Metodo che verifica se l'utente è loggato */
    static function isLogged()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(isset($_SESSION['username'])) return true;
        else {return false;}
    }

    static function Login()
    {
        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            $validato = FUtente::accountvalidation($_POST['username'],$_POST['password']);
                if($validato === true)
                {
                    session_start();
                    $_SESSION['username'] = $_POST['username'];
                    $_SESSION['password'] = $_POST['password'];
                    $_SESSION['sconto'] =false;
                    header("Location: /restaurant/Ordine/MostraListaProdotti");
                }
                else
                {
                    $msg="user o pass errati";
                    print ("$msg");
                    header("Refresh:2; URL=/restaurant/Homepage");
                }
        }
        else
        {
            header('HTTP/1.1 405 Method Not Allowed');
            header('Allow: POST');
        }
    }

    /** Metodo che provvede alla rimozione delle variabili di sessione, alla sua distruzione e a rinviare alla homepage  */
    static function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /restaurant/Homepage');
    }

    static function EliminaProfilo()
    {
        if(!CUtente::isLogged())
        {
            print("Non puoi accedere alla pagina se non sei loggato, effettua il login");
            header("Refresh:3; URL=/restaurant/Homepage");
        }
        else {
            $view = new VUtente();
            $view->EliminaProfilo();
        }
    }

    static function RimuoviProfilo()
    {
        if(!CUtente::isLogged())
        {
            print("Non puoi accedere alla pagina se non sei loggato, effettua il login");
            header("Refresh:3; URL=/restaurant/Homepage");
        }
        else {
          //  session_start();
            if ($_POST['password'] === $_POST['conferma_password']) {
                $utente = FUtente::load($_SESSION['username']);
                $password = $_POST['password'];
                $password_cifrata = $utente->getPasswordHash();
                if (password_verify("$password", "$password_cifrata") === true) {
                    FUtente::delete($_SESSION['username']);
                    session_unset();
                    session_destroy();
                    $msg = "Profilo eliminato con successo";
                    print($msg);
                    header("Refresh:2; URL=/restaurant/Homepage");
                } else {
                    $error = "Password errata";
                    $view = new VUtente();
                    $view->RimuoviProfiloErrore($error);
                }
            } else {
                $error = "Le password non coincidono";
                $view = new VUtente();
                $view->RimuoviProfiloErrore($error);
            }
        }
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
                    $nome = $_POST['fname'];
                    $cognome = $_POST['lname'];
                    $username = $_POST['username'];
                    $telefono = $_POST['telefono'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $conferma_password = $_POST['conferma_password'];
                    if($password != $conferma_password)
                    {
                        $error = "Le password non coincidono";
                        $view = new VUtente();
                        $view->MostraFormConErrore($error);
                    }
                    else if($password === $conferma_password)
                    {
                        if(FUtente::exists($username) === true)
                        {
                            $error = "Username già in uso";
                            $view = new VUtente();
                            $view->MostraFormConErrore($error);
                        }

                        else if(FUtente::exists($username) === false)
                        {
                            if(FUtente::verificaEmail($_POST['email']) === false)
                            {
                                session_unset();
                                session_destroy();
                                $utente = new EUtente($nome, $cognome, $username, $email, $telefono, $password,0);

                                if (FUtente::store($utente) === true)
                                {
                                    session_start();
                                    $_SESSION['username'] = $username;
                                    $_SESSION['sconto'] =false;
                                    header('Location: /restaurant/Ordine/MostraListaProdotti');
                                }
                                else
                                {
                                    if (FUtente::store($utente) === false)
                                    {
                                        $error = "C'è stato un errore. Per favore reinserire i dati";
                                        $view = new VUtente();
                                        $view->MostraFormConErrore($error);
                                    }
                                }
                            }
                            else
                            {
                                $error = "Email già in uso";
                                $view = new VUtente();
                                $view->MostraFormConErrore($error);
                            }
                        }
                    }
                }
        }
    }

    static function GestioneAccount()
    {
        if(!CUtente::isLogged())
        {
            print("Non puoi accedere alla pagina se non sei loggato, effettua il login");
            header("Refresh:3; URL=/restaurant/Homepage");
        }
        else {
            $view = new VUtente();
            $view->GestioneAccount();
        }
    }

    static function ModificaAccount()
    {
        if(!CUtente::isLogged())
        {
            print("Non puoi accedere alla pagina se non sei loggato, effettua il login");
            header("Refresh:3; URL=/restaurant/Homepage");
        }
        else {
            //session_start();
            $utente = FUtente::load($_SESSION['username']);
            $password_precedente = $_POST['password_precedente'];
            $password_cifrata = $utente->getPasswordHash();
            if (password_verify("$password_precedente", "$password_cifrata") === true) {
                if ($_POST['nuova_password'] === $_POST['conferma_nuova_password']) {
                    $utente->setPassword(($_POST['nuova_password']));
                    if (FUtente::verificaEmail($_POST['email']) === false) {
                        if (!empty($_POST['nome'])) {
                            $utente->setNome($_POST['nome']); }
                        if (!empty($_POST['cognome'])) {
                            $utente->setCognome($_POST['cognome']); }
                        if (!empty($_POST['telefono'])) {
                            $utente->setTelefono($_POST['telefono']);
                        }
                        if (!empty($_POST['email'])) {
                            $utente->setEmail($_POST['email']);
                        }
                        $nome = $utente->getNome();
                        $cognome = $utente->getCognome();
                        $email = $utente->getEmail();
                        $telefono = $utente->getTelefono();
                        $password = $utente->getPasswordHash();
                        $punti = $utente->getPunti();
                        $ordini_cumulati = $utente->getOrdiniCumulati();
                        $data_ultimo_ordine = $utente->getDataUltimoOrdine();
                        $risultato = $data_ultimo_ordine->format('Y-m-d');

                        $utente_aggiornato = new EUtente($nome, $cognome, $_SESSION['username'], $email, $telefono, $password, $punti, $ordini_cumulati, $risultato);
                        FUtente::update($utente_aggiornato);

                        $msg = "Dati modificati con successo!";
                        print("$msg");
                        header("Refresh:2; URL=/restaurant/Homepage");
                    } else {
                        $error = "Email già in uso";
                        $view = new VUtente();
                        $view->GestioneAccountErrore($error);
                    }
                } else {
                    $error = "Le password non coincidono";
                    $view = new VUtente();
                    $view->GestioneAccountErrore($error);
                }
            } else {
                $error = "La password precedente è errata";
                $view = new VUtente();
                $view->GestioneAccountErrore($error);
            }
        }
    }
}