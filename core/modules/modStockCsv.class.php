<?php

include_once DOL_DOCUMENT_ROOT .'/core/modules/DolibarrModules.class.php';

/**
 *  Description and activation class for module stockcsv
 */

class modstockcsv extends DolibarrModules
{

	/**
	 *   Constructor. Define names, constants, directories, boxes, permissions
	 *
	 *   @param      DoliDB		$db      Database handler
	 */

	function __construct($db)
	{
        global $langs,$conf;

        $this->db = $db;

		$this->editor_name = 'BRUMAN';

		$this->editor_url = 'https://www.bruman.fr';

		$this->numero = 181101; // 181101 to 181999 for BRUMAN

		$this->rights_class = 'stockcsv';

		$this->family = "BRUMAN";

		$this->name = preg_replace('/^mod/i','',get_class($this));

		$this->description = "Ventilation automatis&eacute;e et manuelle des stocks des fournisseurs";

		$this->version = '1.0';

		$this->const_name = 'MAIN_MODULE_'.strtoupper($this->name);

		$this->special = 0;

		$this->picto='stockcsv@stockcsv';

		$this->module_parts = array(
		                        	'triggers' => 1,
									'css'	=> array('/stockcsv/css/stockcsv.css'),
								);


		$this->dirs = array();

		$this->config_page_url = array("stockcsv_setup.php@stockcsv");

		// Dependencies

		$this->hidden = false;			// A condition to hide module

		$this->depends = array();		// List of modules id that must be enabled if this module is enabled

		$this->requiredby = array();	// List of modules id to disable if this one is disabled

		$this->conflictwith = array();	// List of modules id this module is in conflict with

		$this->phpmin = array(5,0);					// Minimum version of PHP required by module

		$this->need_dolibarr_version = array(3,0);	// Minimum version of Dolibarr required by module

		$this->langfiles = array("stockcsv@stockcsv");

		$this->const = array(
		    0=>array('STOCKCSV_MAP_SUPPLIER','chaine','','',1),
			1=>array('STOCKCSV_MAP_WAREHOUSE','chaine','','',1),
			2=>array('STOCKCSV_MAP_FOLDER_FTP','chaine','','',1),
			3=>array('STOCKCSV_MAP_CATEGORY','chaine','','',1),
			4=>array('STOCKCSV_PREFIX_SUPPLIER','chaine','','',1),
			5=>array('STOCKCSV_SOLD_SUPPLIER','chaine','','',1),
			6=>array('STOCKCSV_MAPOTHER_CATEGORY','chaine','','',1),
			7=>array('STOCKCSV_MAPOTHER_MASK','chaine','','',1),
			8=>array('STOCKCSV_MAPOTHER_CATEGORY_PRESTA','chaine','','',1),
			9=>array('STOCKCSV_TERMS','chaine','','',1),
			10=>array('STOCKCSV_SKU','chaine','','',1),
			11=>array('STOCKCSV_COEF','chaine','','',1),
			12=>array('STOCKCSV_STOCK_TAMPON','chaine','','',1),
			13=>array('STOCKCSV_DECREM','chaine','','',1),
			14=>array('STOCKCSV_LOW_PRICE','chaine','','',1),
			15=>array('STOCKCSV_PS_SERVER','chaine','','',1),
			16=>array('STOCKCSV_PS_PORT','chaine','','',1),
			17=>array('STOCKCSV_PS_LOGIN','chaine','','',1),
			18=>array('STOCKCSV_PS_PASSWORD','chaine','','',1),
			19=>array('STOCKCSV_PS_PREFIX','chaine','','',1),
			20=>array('STOCKCSV_PS_ID_TRANSPORTEUR','chaine','','',1),
			21=>array('STOCKCSV_ERRORSKU','chaine','','',1),
			22=>array('STOCKCSV_CSVNOTPRESENT','chaine','','',1),
			23=>array('STOCKCSV_NBDAYS','chaine','','',1),
			24=>array('STOCKCSV_MAPOTHER_CATEGORY_DOLI','chaine','','',1),
			25=>array('STOCKCSV_TYPEPRICE','chaine','','',1)
		    );

        $this->tabs = array();

        // Dictionaries

	    if (! isset($conf->stockcsv->enabled))
        {
        	$conf->stockcsv=new stdClass();
        	$conf->stockcsv->enabled=0;
		}

        $this->dictionaries=array();

        // Boxes

		// Add here list of php file(s) stored in core/boxes that contains class to show a box.

        $this->boxes = array();			// List of boxes

		// Example:

		//$this->boxes=array(array(0=>array('file'=>'myboxa.php','note'=>'','enabledbydefaulton'=>'Home'),1=>array('file'=>'myboxb.php','note'=>''),2=>array('file'=>'myboxc.php','note'=>'')););

		// Permissions
		$this->rights = array();

		$r=0;

		$r++;
		$this->rights[$r][0] = 170321; // id de la permission
		$this->rights[$r][1] = 'Acc&egrave;s au module stockcsv complet'; // libelle de la permission
		$this->rights[$r][2] = 'w'; // type de la permission (deprecie a ce jour)
		$this->rights[$r][3] = 1; // La permission est-elle une permission par defaut
		$this->rights[$r][4] = 'use';

		// Main menu entries

		$this->menu = array();			// List of menus to add

		$r=0;

		$this->menu[$r]=array(	'fk_menu'=>'fk_mainmenu=products,fk_leftmenu=product',
					'type'=>'left',
					'titre'=>$langs->trans("MenuStockCSV"),
					'mainmenu'=>'',
					'leftmenu'=>'',
					'url'=>'/stockcsv/admin/stockcsv_states.php',
					'langs'=>'stockcsv@stockcsv',
					'position'=>100,
					'enabled'=>'1',
					'perms'=>'1',
					'target'=>'',
					'user'=>2);
		$r++;

		// Exports

		$r=0;


	}



	/**
	 *		Function called when module is enabled.
	 *		The init function add constants, boxes, permissions and menus (defined in constructor) into Dolibarr database.
	 *		It also creates data directories
	 *
     *      @param      string	$options    Options when enabling module ('', 'noboxes')
	 *      @return     int             	1 if OK, 0 if KO
	 */

	function init($options='')

	{

		global $conf, $db, $user;

		// Permissions

		//$this->remove($options);

		//include_once DOL_DOCUMENT_ROOT . '/cron/class/cronjob.class.php';

		$sql = array();

		define('INC_FROM_DOLIBARR',true);

		$result=$this->load_tables();

		
		/* Insert CRON config */
		/*$cronValues = array(
				'label' => 'Stocks CSV',
				'jobtype' => 'method',
				'frequency' => 86400,
				'unitfrequency' => 86400,
				'status' => 1,
				'module_name' => 'stockcsv',
				'classesname' => 'cron_stockcsv.class.php',
				'objectname' => 'Cron_stockcsv',
				'methodename' => 'run',
				'params' => '',
				'datestart' => time()
		);
		
		$req = "
			SELECT rowid
			FROM " . MAIN_DB_PREFIX . "cronjob
			WHERE classesname = '" . $cronValues['classesname'] . "'
			AND module_name = '" . $cronValues['module_name'] . "'
			AND objectname = '" . $cronValues['objectname'] . "'
			AND methodename = '" . $cronValues['methodename'] . "'
		";
		
		$res = $this->db->query($req);
		$job = $this->db->fetch_object($res);
		
		if (empty($job->rowid)) {
			$cronTask = new Cronjob($this->db);
			foreach ($cronValues as $key => $value) {
				$cronTask->{$key} = $value;
			}
				
			$cronTask->create($user);
		}*/

		return $this->_init($sql, $options);

	}



	/**
	 *		Create tables, keys and data required by module
	 * 		Files llx_table1.sql, llx_table1.key.sql llx_data.sql with create table, create keys
	 * 		and create data commands must be stored in directory /mymodule/sql/
	 *		This function is called by this->init.
	 *
	 * 		@return		int		<=0 if KO, >0 if OK
	 */

	function load_tables()

	{

		return $this->_load_tables('/stockcsv/sql/');

	}



	/**
	 *		Function called when module is disabled.
	 *      Remove from database constants, boxes and permissions from Dolibarr database.
	 *		Data directories are not deleted
	 *
     *      @param      string	$options    Options when enabling module ('', 'noboxes')
	 *      @return     int             	1 if OK, 0 if KO
	 */

	function remove($options='')

	{

		$sql = array();

		return $this->_remove($sql, $options);

	}



}