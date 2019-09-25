<?php

require('Smarty/Smarty.class.php');

class ConfSmarty
{
    static function configuration()
    {
        $smarty = new Smarty();
        $smarty->setConfigDir('Smarty/configs/');
        $smarty->setTemplateDir('Smarty/templates/');
        $smarty->setCompileDir('Smarty/templates_c/');
        $smarty->setCacheDir('Smarty/cache/');
        return $smarty;
    }
}