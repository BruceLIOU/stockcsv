<?php
if (! defined('NOTOKENRENEWAL')) define('NOTOKENRENEWAL','1'); // Disables token renewal
if (! defined('NOREQUIREMENU'))  define('NOREQUIREMENU','1');
if (! defined('NOREQUIREHTML'))  define('NOREQUIREHTML','1');
if (! defined('NOREQUIREAJAX'))  define('NOREQUIREAJAX','1');
if (! defined('NOREQUIRESOC'))   define('NOREQUIRESOC','1');
if (! defined('NOLOGIN'))   define('NOLOGIN','1');

// Dolibarr environment
$res = @include("../../main.inc.php"); // From htdocs directory

if (! $res) {
    $res = @include("../../../main.inc.php"); // From "custom" directory
}

require_once DOL_DOCUMENT_ROOT.'/comm/action/class/actioncomm.class.php';
require_once DOL_DOCUMENT_ROOT.'/core/class/interfaces.class.php';
require_once(DOL_DOCUMENT_ROOT."/core/class/commonobject.class.php");

/**
 * Class to use CRON with module supplierorderautosend
 */
class stockcsvCron
{
	
	public $db;
	
	function __construct(&$db) {
		$this->db = $db;
	}
	
	/**
	 * Method to call with CRON module 
	 */
	public function run()
	{

    	require_once DOL_DOCUMENT_ROOT.'/user/class/user.class.php';
		require_once DOL_DOCUMENT_ROOT.'/custom/stockcsv/lib/stockcsvProcess.lib.php';
		require_once DOL_DOCUMENT_ROOT.'/custom/stockcsv/lib/stockcsv.lib.php';

		global $conf, $langs, $user;
		
		$langs->load('stockcsv@stockcsv');
		
		$arrayTableConst                    = getTableconst_stockcsv();
		$user 								= new User($this->db);

		//Parcourir le tableau creer via la table constante
		$ftp                    = 0;
		$coefMarge              = 1;
		$priceHT                = 2;
		$excludeProductError    = 3;
		$nbDayBeforeDelete      = 4;
		$EmptyStockPartner      = 5;
		$userRobot              = 6;

		$idUserRobot             = $arrayTableConst[$userRobot];
		$user->fetch($idUserRobot);

		//TEST MANUEL
		/*
		cahors=38
		foix=3
		manosque=4254
		latour=76
		lavelanet=25
		savenay=1250
		montauban=2
		pamiers=4
		farandole=1159
		brive=4165
		 */
		//getCSVMappingManuel('4254',$user);
		getCSVMappingAutomatique($user);
	}
	
}