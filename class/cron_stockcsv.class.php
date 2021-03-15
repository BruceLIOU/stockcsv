<?php


// Dolibarr environment

$res = @include("../../main.inc.php"); // From htdocs directory

if (! $res) {

    $res = @include("../../../main.inc.php"); // From "custom" directory

}

require_once DOL_DOCUMENT_ROOT.'/custom/stockcsv/lib/stockcsvProcess.lib.php';
require_once DOL_DOCUMENT_ROOT.'/custom/stockcsv/lib/stockcsv.lib.php';
require_once DOL_DOCUMENT_ROOT.'/user/class/user.class.php';


/**
 * Class to use CRON with module stockscsvCron
 */
class Cron_stockcsv
{
	
	public $db;
	
	function __construct(&$db) {
		$this->db = $db;
	}


	public function run()
	{

		$arrayTableConst                    = getTableconst_stockcsv();
		$user 								= new User($this->db);



		// Parcourir le tableau creer via la table constante
		$ftp                    = 0;
		$coefMarge              = 1;
		$priceHT                = 2;
		$excludeProductError    = 3;
		$nbDayBeforeDelete      = 4;
		$EmptyStockPartner      = 5;
		$userRobot              = 6;

		$idUserRobot             = $arrayTableConst[$userRobot];
		$user->fetch($idUserRobot);

		getCSVMappingAutomatique($user);

		return 0;
	}

}