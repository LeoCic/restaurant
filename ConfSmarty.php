<?php

require('ProgrammazioneWeb/Smarty.class.php');

class ConfSmarty
{
    static function configuration()
    {
        $smarty = new Smarty();
        $smarty->setConfigDir($_SERVER['DOCUMENT_ROOT'].'/ProgrammazioneWeb/includes/smarty/configs/');
        $smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'].'/ProgrammazioneWeb/templates/');
        $smarty->setCompileDir($_SERVER['DOCUMENT_ROOT'].'/ProgrammazioneWeb/templates_c/');
        $smarty->setCacheDir($_SERVER['DOCUMENT_ROOT'].'/ProgrammazioneWeb/cache/');
        return $smarty;
    }
}

// il dominio sul sito web deve essere ProgrammazioneWeb