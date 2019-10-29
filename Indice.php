<?php

/**
 * La funzione require_once non consente di includere più volte lo stesso file; in particolare,
 * in caso di doppia inclusione, non consente di includere più volte lo stesso file.
 * Mentre, in caso di file non trovato, genera un parse error che interrompe l'esecuzione dello script.
 */

/**
 * Inclusione del file che permette  la configurazione di Smarty
 */
require_once 'ConfSmarty.php';

/**
 * Inclusione dei file contenuti nella cartella Foundation
 */
require_once 'Foundation/FOrdine.php';
require_once 'Foundation/FLuogo.php';
require_once 'Foundation/FProdotto.php';
require_once 'Foundation/FRistorante.php';
require_once 'Foundation/FUtente.php';
require_once 'Foundation/FDatabase.php';

/**
 * Inclusione dei file contenuti nella cartella Model
 */
require_once 'Model/EOrdine.php';
require_once 'Model/ELuogo.php';
require_once 'Model/EProdotto.php';
require_once 'Model/ERistorante.php';
require_once 'Model/EUtente.php';
require_once 'Model/EBevanda.php';
require_once 'Model/ECibo.php';

/**
 * Inclusione dei file contenuti nella cartella Controller
 */
require_once 'Controller/FrontController.php';
require_once 'Controller/COrdine.php';
require_once 'Controller/CUtente.php';

/**
 * Inclusione dei file contenuti nella cartella View
 */
require_once 'View/VOrdine.php';
require_once 'View/VUtente.php';