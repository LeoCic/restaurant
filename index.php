<?php
require_once 'indice.php';

$fcontroller=new FrontController();
$fcontroller->dispatch($_SERVER['REQUEST_URI']);