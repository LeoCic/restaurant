<?php
require_once 'Indice.php';

$fcontroller=new FrontController();
$fcontroller->dispatch($_SERVER['REQUEST_URI']);