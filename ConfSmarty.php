<?php

require('Smarty/Smarty.class.php');

class ConfSmarty
{
    static function configuration()
    {
        $smarty = new Smarty();
        $smarty->setConfigDir($_SERVER['DOCUMENT_ROOT'].'Smarty/configs/');
        $smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'].'Smarty/templates/');
        $smarty->setCompileDir($_SERVER['DOCUMENT_ROOT'].'Smarty/templates_c/');
        $smarty->setCacheDir($_SERVER['DOCUMENT_ROOT'].'Smarty/cache/');
        return $smarty;
    }
}