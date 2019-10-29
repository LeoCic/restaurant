<?php

require_once 'Indice.php';

class FrontController
{
    public function dispatch($url)
    {
        $request = preg_split("#[][&?/]#", $url);
        $controller = "C" . $request[2];
        if (class_exists($controller))
        {
            $function = $request[3];
            if (method_exists($controller, $function))
            {
                $param = array();
                for ($i = 4; $i < count($request); $i++) { $param[] = $request[$i]; }
                if (count($param) == 1) $controller::$function($param[0]);
                else if (count($param) == 2) $controller::$function($param[0], $param[1]);
                else if (count($param) == 3) $controller::$function($param[0], $param[1], $param[2]);
                else  $controller::$function();
            }
            else
            {
                $controllore = new COrdine();
                $smarty = $controllore->InfoRistorante();
                if(!CUtente::isLogged()) {$smarty->assign('logged', false); $smarty->display('Homepage.html'); }
                else
                {
                    $smarty->assign('logged', true);
                    $smarty->display('Homepage.html');
                }
            }
        }
        else
        {
            $controllore = new COrdine();
            $smarty = $controllore->InfoRistorante();
            if(!CUtente::isLogged()) { $smarty->assign('logged', false); $smarty->display('Homepage.html'); }
            else
            {
                $smarty->assign('logged', true);
                $smarty->display('Homepage.html');
            }
        }
    }
}