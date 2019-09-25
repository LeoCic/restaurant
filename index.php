<?php

require_once 'Indice.php';

$fcontroller=new FrontController();
//$fcontroller->prova();

$fcontroller->dispatch($_SERVER['REQUEST_URI']);