<?php
require_once 'include.php';

$fcontroller=new FrontController();
$fcontroller->dispatch($_SERVER['REQUEST_URI']);