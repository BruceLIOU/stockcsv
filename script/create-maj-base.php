<?php
/*
 * Script créant et vérifiant que les champs requis s'ajoutent bien
 */

if(!defined('INC_FROM_DOLIBARR')) {
	define('INC_FROM_CRON_SCRIPT', true);

	require('../config.php');

}


/* uncomment


dol_include_once('/stockcsv/class/stockcsv.class.php');

$PDOdb=new TPDOdb;

$o=new Tstockcsv;
$o->init_db_by_vars($PDOdb);

$o=new TstockcsvChild;
$o->init_db_by_vars($PDOdb);
*/
