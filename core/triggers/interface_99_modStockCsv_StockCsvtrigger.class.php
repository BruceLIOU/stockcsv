<?php
/* <one line to give the program's name and a brief idea of what it does.>
 * Copyright (C) 2015 BRUMAN <support@bruman.fr>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * 	\file		core/triggers/interface_99_modMyodule_stockcsvtrigger.class.php
 * 	\ingroup	stockcsv
 * 	\brief		Sample trigger
 * 	\remarks	You can create other triggers by copying this one
 * 				- File name should be either:
 * 					interface_99_modstockcsv_Mytrigger.class.php
 * 					interface_99_all_Mytrigger.class.php
 * 				- The file must stay in core/triggers
 * 				- The class name must be InterfaceMytrigger
 * 				- The constructor method must be named InterfaceMytrigger
 * 				- The name property name must be Mytrigger
 */

/**
 * Trigger class
 */

class InterfaceStockCsvTrigger
{
    private $db;

    /**
     * Constructor
     *
     * 	@param		DoliDB		$db		Database handler
     */

    public function __construct($db)
    {
        $this->db = $db;

        $this->name = preg_replace('/^Interface/i', '', get_class($this));
        $this->family = "stockcsv";
        $this->description = "Triggers of stockcsv ";
        $this->version = 'development';
        $this->picto = 'stockcsv@stockcsv';
    }

    /**
     * Trigger name
     *
     * 	@return		string	Name of trigger file
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Trigger description
     *
    * 	@return		string	Description of trigger file
     */
    public function getDesc()
    {
        return $this->description;
    }

    /**
     * Trigger version
     *
     * 	@return		string	Version of trigger file
     */
    public function getVersion()
    {
        global $langs;
        $langs->load("admin");

        if ($this->version == 'development') {
            return $langs->trans("Development");
        } elseif ($this->version == 'experimental')

                return $langs->trans("Experimental");
        elseif ($this->version == 'dolibarr') return DOL_VERSION;
        elseif ($this->version) return $this->version;
        else {
            return $langs->trans("Unknown");
        }
    }

    /**
     * Function called when a Dolibarrr business event is done.
     * All functions "run_trigger" are triggered if file
     * is inside directory core/triggers
     *
     * 	@param		string		$action		Event action code
     * 	@param		Object		$object		Object
     * 	@param		User		$user		Object user
     * 	@param		Translate	$langs		Object langs
     * 	@param		conf		$conf		Object conf
     * 	@return		int						<0 if KO, 0 if no triggered ran, >0 if OK
     */
    //public function runTrigger($action, $object, $user, $langs, $conf)
	//public function run_trigger($action,$object,$user,$langs,$conf)
	public function runTrigger($action,$object,$user,$langs,$conf)
    {
        global $conf,$db;
        // Put here code you want to execute when a Dolibarr business events occurs.
        // Data and type of action are stored into $object and $action
        // Users
		dol_syslog("StockCSV executed by ".$action.'::'.$_SERVER['HTTP_USER_AGENT']);
	   	$pos_soap = stripos($_SERVER['HTTP_USER_AGENT'], 'NuSOAP');
 	  	$pos_curl = stripos($_SERVER['HTTP_USER_AGENT'], 'CURL');
   		if($pos_soap !== false || $pos_curl !== false) {

			$action = "xxx";
			dol_syslog("StockCSV NOT executed by ".$action.'::'.$_SERVER['HTTP_USER_AGENT']);
		}
		



        // Products

		if ($action == 'PRODUCT_CREATE_STOCK_CSV'){

			//print '<pre>';print_r($object);print '</pre>';exit;
        	$cats = array();
			$cats[] = array('id'				=>	$object->id,
							'ref'				=>	$object->ref,
							'label'				=>	(DOL_VERSION < '3.8.0'?$object->libelle:$object->label),
							'description'		=>	$object->description,
							//'longdescript'		=>	$object->array_options['options_longdescript'],
							'longdescript'		=>	$object->description,
							'reel'				=>  'cybernull',
							'cyberprice'		=>	$object->array_options['options_cyberprice'],
							'price'				=>	($price && $price > 0?$price:'cybernull'),
							'tva_tx'			=>	$conf->global->{"MYCYBEROFFICE_tax".(float)$object->tva_tx},
							'status'			=>	$object->status,
							'import_key'		=>  $object->import_key,
							'ean13'				=>	($object->barcode_type==2?$object->barcode:'cybernull'),
							'upc'				=>	($object->barcode_type==3?$object->barcode:'cybernull'),
							'isbn'				=>	($object->barcode_type==4?$object->barcode:'cybernull'),
							'weight'			=>  $object->weight,
							'height'            =>  $object->height,//hauteur
                            'width'             =>  $object->width,//largeur
                            'length'            =>  $object->length,//longueur profondeur
							'cost_price'		=>	(DOL_VERSION < '3.9.0'?$object->pmp:$object->cost_price),
							'imageDel'			=>	'cybernull',
							'action'			=> 'add',
							'reel0'				=>  'cybernull',
							);
		
		//	if (substr($cats['0']['import_key'], -1, 1) != '-' && $cats['0']['import_key'] != '') 
				$this->MyProduct($cats,$object);
            dol_syslog("Trigger '".$this->name."' for action '$action' launched by ".__FILE__.". id=".$object->id.', importkey='.$cats['0']['import_key'].','.substr($cats['0']['import_key'], -1, 1));
        	//dol_syslog("Cyberoffice_Trigger_MyProduct:: ".__LINE__);

		}elseif ($action == 'PRODUCT_SUPPLIER_BUYPRICE_UPDATE_STOCK_CSV'){        

			/*if (empty($conf->global->PRODUIT_MULTIPRICES) || $conf->global->PRODUIT_MULTIPRICES == 0)
	        {
	        	$price = $object->price;
	        	$tva_tx = $conf->global->{"MYCYBEROFFICE_tax".(float)$object->tva_tx};
	        } else {
	        	$price = $object->multiprices[1];
	        	$tva_tx = $conf->global->{"MYCYBEROFFICE_tax".(float)$object->multiprices_tva_tx[1]};
			}*/

			$price  = $object->price;
			$tva_tx = $object->tva_tx;
			 //print_r($_SERVER);



        	$cats = array();
			$cats[] = array('id'				=>	$object->id,
							'ref'				=>	$object->ref,
							'label'				=>	(DOL_VERSION < '3.8.0'?$object->libelle:$object->label),
							'description'		=>	$object->description,
							//'longdescript'		=>	$object->array_options['options_longdescript'],
							'longdescript'		=>	$object->description,
							'reel'				=>  'cybernull',
							'cyberprice'		=>	'cybernull',
							'price'				=>	$price,
							'tva_tx'			=>	$tva_tx,
							'status'			=>	'cybernull',
							'import_key'		=>  $object->import_key,
							'ean13'				=>	($object->barcode_type==2?$object->barcode:'cybernull'),
							'upc'				=>	($object->barcode_type==3?$object->barcode:'cybernull'),
							'isbn'				=>	($object->barcode_type==4?$object->barcode:'cybernull'),
							'weight'			=>  $object->weight,
							'height'            =>  $object->height,//hauteur
                            'width'             =>  $object->width,//largeur
                            'length'            =>  $object->length,//longueur profondeur
							'cost_price'		=>	(DOL_VERSION < '3.9.0'?$object->pmp:$object->cost_price),
							'imageDel'			=>  'cybernull',
							'reel0'				=>  'cybernull',
							);

			//if (substr($cats['0']['import_key'], -1, 1) != '-' && $cats['0']['import_key'] != '' ) 
			$this->MyProduct($cats,$object);
			dol_syslog("Trigger '".$this->name."' for action '$action' launched by ".__FILE__.". id=".$object->product_id.' price='.$price);
			//print("Trigger '".$this->name."' for action '$action' launched by ".__FILE__.". id=".$object->id.', importkey='.$cats['0']['import_key'].','.substr($cats['0']['import_key'], -1, 1));
			//print '<br/>';

            //dol_syslog("Trigger '" . $this->name . "' for action '$action' launched by " . __FILE__ . ". id=" . $object->id);
        }elseif ($action == 'PRODUCT_STOCK_MOVEMENT_STOCK_CSV'){	

			$cats = array();

			$sql = 'SELECT p.*, ps.reel, ps.fk_entrepot
					FROM '.MAIN_DB_PREFIX.'product p
					LEFT JOIN '.MAIN_DB_PREFIX.'product_stock as ps ON (ps.fk_product = p.rowid and ps.fk_entrepot = '.$object->entrepot_id.')
					WHERE p.entity IN (0, '.$conf->entity.') AND p.rowid='.$object->product_id.' ORDER BY p.rowid ';//1322
			$res = $this->db->query($sql);

			$produits = $this->db->fetch_array($res);
			/*if ($produits['reel'] <= $tampon=$conf->global->MYCYBEROFFICE_tampon)
				{
					$tampon=0;
				}
				else
				{
					$tampon=$conf->global->MYCYBEROFFICE_tampon;
				}
			*/
			$tampon=$conf->global->MYCYBEROFFICE_tampon01;
			
			$sql = 'SELECT p.*, SUM(ps.reel)-'.$tampon.' as reel
					FROM '.MAIN_DB_PREFIX.'product p
					LEFT JOIN '.MAIN_DB_PREFIX.'product_stock as ps ON (ps.fk_product = p.rowid)
					WHERE p.entity IN (0, '.$conf->entity.') AND ps.fk_entrepot < 1000 AND p.rowid='.$object->product_id.' GROUP BY p.rowid ';//1322
					
            $res = $this->db->query($sql);
			$produits0 = $this->db->fetch_array($res);

			if($produits0['reel'] < 0)
			{
				$produits0['reel']='0';
			}

			$cats = array();
			$cats[] = array('id'				=>	$object->product_id,
							'ref'				=>	$produits['ref'],
							'label'				=>	'cybernull',
							'description'		=>	$object->description,
							//'longdescript'		=>	$object->array_options['options_longdescript'],
							'longdescript'		=>	$object->description,
							'reel'				=>  $produits['reel'],
							'cyberprice'		=>	'cybernull',
							'price'				=>	'cybernull',
							'tva_tx'			=>	$conf->global->{"MYCYBEROFFICE_tax".(float)$object->tva_tx},
							'status'			=>	'cybernull',
							'import_key'		=>  $produits['import_key'],
							'ean13'				=>	($object->barcode_type==2?$object->barcode:'cybernull'),
							'upc'				=>	($object->barcode_type==3?$object->barcode:'cybernull'),
							'isbn'				=>	($object->barcode_type==4?$object->barcode:'cybernull'),
							'cost_price'		=>	(DOL_VERSION < '3.9.0'?$object->pmp:$object->cost_price),
							'imageDel'			=>	'cybernull',
							'reel0'				=>  $produits0['reel'],
							);

			//print_r($cats);print substr($cats['0']['import_key'], -1, 1);exit;				
			//if (substr($cats['0']['import_key'], -1, 1) != '-' && $cats['0']['import_key'] != '') 
			$this->MyProduct($cats,$object, $object->entrepot_id);
		    dol_syslog("Trigger '".$this->name."' for action '$action' launched by ".__FILE__.". id=".$object->product_id.' qty='.$produits['reel']);
			//print("Trigger '".$this->name."' for action '$action' launched by ".__FILE__.". id=".$object->product_id.' qty='.$produits['reel']);
			//print '<br/>';
			//print $produits['reel'];
			//print '<br>'.$produits0['reel'];
		}elseif ($action == 'CATEGORY_LINK_STOCK_CSV'){	

			//print '<pre>';print_r($object);print '</pre>';die();
			$sql = "SELECT rowid, import_key";
			$sql.= " FROM ".MAIN_DB_PREFIX."categorie";
			$sql.= " WHERE rowid = '".$object->id."'";
			$resql = $this->db->query($sql);
			if ($resql) {
				$res = $this->db->fetch_array($resql);
				$import_key = $res['import_key'];
			}
			if (!$object->linkto->import_key) {
				$newobject = new Product($this->db);
				$newobject->fetch($object->linkto->id);
				$newimport_key = $newobject->import_key;
				if (empty($conf->global->PRODUIT_MULTIPRICES) || $conf->global->PRODUIT_MULTIPRICES == 0)
		        {
		        	$price = $newobject->price;
		        	$tva_tx = $conf->global->{"MYCYBEROFFICE_tax".(float)$newobject->tva_tx};
		        } else {
		        	$price = $newobject->multiprices[1];
		        	$tva_tx = $conf->global->{"MYCYBEROFFICE_tax".(float)$newobject->multiprices_tva_tx[1]};
				}
				$cats = array();
				$cats[] = array('id'				=>	$newobject->id,
								'import_key'		=>  $newobject->import_key,
								'ref'				=>	$newobject->ref,
								'label'				=>	(DOL_VERSION < '3.8.0'?$newobject->libelle:$newobject->label),
								'description'		=>	$newobject->description,
								//'longdescript'		=>	$newobject->array_options['options_longdescript'],
								'longdescript'		=>	$newobject->description,
								'reel'				=>  'cybernull',
								'cyberprice'		=>	$newobject->array_options['options_cyberprice'],
								'price'				=>	($price && $price > 0?$price:'cybernull'),
								'tva_tx'			=>	$tva_tx,
								'status'			=>	$newobject->status,
								'ean13'				=>	($newobject->barcode_type==2?$newobject->barcode:'cybernull'),
								'upc'				=>	($newobject->barcode_type==3?$newobject->barcode:'cybernull'),
								'isbn'				=>	($newobject->barcode_type==4?$newobject->barcode:'cybernull'),
								'weight'			=>  $newobject->weight,
								'height'            =>  $newobject->height,//hauteur
                                'width'             =>  $newobject->width,//largeur
                                'length'            =>  $newobject->length,//longueur profondeur
								'cost_price'		=>	(DOL_VERSION < '3.9.0'?$newobject->pmp:$newobject->cost_price),
								'imageDel'			=>	'cybernull',
								'cat'				=>	$import_key,
								'action'			=> 'add',
								'reel0'				=>  'cybernull',
								);
			} else {
				$newobject = new Product($this->db);
				$newobject->fetch($object->linkto->id);
				$newimport_key = $object->linkto->import_key;
				if (empty($conf->global->PRODUIT_MULTIPRICES) || $conf->global->PRODUIT_MULTIPRICES == 0)
		        {
		        	$price = $newobject->price;
		        	$tva_tx = $conf->global->{"MYCYBEROFFICE_tax".(float)$newobject->tva_tx};
		        } else {
		        	$price = $newobject->multiprices[1];
		        	$tva_tx = $conf->global->{"MYCYBEROFFICE_tax".(float)$newobject->multiprices_tva_tx[1]};
				}

				$cats = array();
				$cats[] = array('id'				=>	$object->linkto->id,
								'import_key'		=>  $newimport_key,
								'ref'				=>	$object->linkto->ref,
								'label'				=>	(DOL_VERSION < '3.8.0'?$newobject->libelle:$newobject->label),
								'description'		=>	$newobject->description,
								//'longdescript'		=>	$newobject->array_options['options_longdescript'],
								'longdescript'		=>	$newobject->description,
								'reel'				=>  'cybernull',
								'cyberprice'		=>	$newobject->array_options['options_cyberprice'],
								'price'				=>	($price && $price > 0?$price:'cybernull'),
								'tva_tx'			=>	$tva_tx,
								'status'			=>	$newobject->status,
								'ean13'				=>	($newobject->barcode_type==2?$newobject->barcode:'cybernull'),
								'upc'				=>	($newobject->barcode_type==3?$newobject->barcode:'cybernull'),
								'isbn'				=>	($newobject->barcode_type==4?$newobject->barcode:'cybernull'),
								'weight'			=>  $newobject->weight,
								'height'            =>  $newobject->height,//hauteur
                                'width'             =>  $newobject->width,//largeur
                                'length'            =>  $newobject->length,//longueur profondeur
								'cost_price'		=>	(DOL_VERSION < '3.9.0'?$newobject->pmp:$newobject->cost_price),
								'imageDel'			=>	'cybernull',
								'cat'				=>	$import_key,
								'action'			=> 'add',
								'reel0'				=>  'cybernull',
								);
			}
			//print '<pre>';print_r($cats);print '</pre>';die();
			//if (substr($cats['0']['import_key'], -1, 1) != '-' && $cats['0']['import_key'] != '')			
				$this->MyProduct($cats,$object->linkto);
			dol_syslog("Trigger '".$this->name."' for action '$action' launched by ".__FILE__.". id=".$object->linkto->id);
			//print("Trigger '".$this->name."' for action '$action' launched by ".__FILE__.". id=".$object->linkto->id);
			//print '<br/>';

		}elseif ($action == 'CATEGORY_UNLINK_STOCK_CSV')
		{	
			//echo '<pre>';print_r($object);echo '</pre>';die();
			$sql = "SELECT rowid, import_key";
			$sql.= " FROM ".MAIN_DB_PREFIX."categorie";
			//$sql.= " WHERE rowid = '20'";
			$sql.= " WHERE rowid = '".$object->id."'";
			$resql = $this->db->query($sql);
			if ($resql) {
				$res = $this->db->fetch_array($resql);
				$import_key = $res['import_key'];
			}
			$cats = array();
			$cats[] = array('id'				=>	$object->unlinkoff->id,
							'import_key'		=>  $object->unlinkoff->import_key,
							'ref'				=>	$object->unlinkoff->ref,
							'reel'				=>	'cybernull',
							'cyberprice'		=>	'cybernull',
							'price'				=>	'cybernull',
							'ean13'				=>	($object->barcode_type==2?$object->barcode:'cybernull'),
							'upc'				=>	($object->barcode_type==3?$object->barcode:'cybernull'),
							'isbn'				=>	($object->barcode_type==4?$object->barcode:'cybernull'),
							'cat'				=>	$import_key,
							'action'			=> 'remove',
							'imageDel'			=>	'cybernull',
							'reel0'				=>  'cybernull',
							);
							
			if (substr($cats['0']['import_key'], -1, 1) != '-' && $cats['0']['import_key'] != '') 
				$this->MyProduct($cats,$object->unlinkoff);
		    dol_syslog("Trigger '".$this->name."' for action '$action' launched by ".__FILE__.". id=".$object->unlinkoff->id);
		}

		return 0;
	}

    

	function MyProduct($cats, $object, $warehouse=0) {
    	global $conf, $db;
    	//print '<pre>';print_r($object);print '</pre>';die();
    	dol_syslog("StockCSV_Trigger_MyProduct::id=".$object->id);
    	if($object->entrepot_id && $object->entrepot_id > 0) 
    		$product_id = (int)$object->product_id;
    	else
    		$product_id = (int) $object->id;
		$sql = 'SELECT distinct SUBSTRING(c.import_key,2,2) as numshop
				FROM ' . MAIN_DB_PREFIX . 'categorie_product as ct, ' . MAIN_DB_PREFIX . 'categorie as c
				WHERE ct.fk_categorie = c.rowid AND ct.fk_product = ' . $product_id . ' AND c.type = "product"
				AND c.entity IN (' . getEntity( 'category', 1 ) . ') AND c.import_key is not null';
		dol_syslog("StockCSV_Trigger_MyProduct::sql numshop=".$sql);
		
		if ($cats[0]['action'] == 'add')
			$numshops = substr($cats[0]['cat'],1,2);
		else
			$numshops = '00';


		$res = $db->query($sql);
		if ($res)
		{
			while ($obj = $db->fetch_object($res))
			{
				//if ($obj->numshop) $numshops.= ','.$obj->numshop;
				//ajout du else avec 00 - 06/07/2018
				if ($obj->numshop) 
				{
					$numshops.= ','.$obj->numshop;
				}
				else
				{
					$numshops.= '00,'.$obj->numshop;
				}
				dol_syslog("StockCSV_Trigger_MyProduct::sql numshop=".$numshops);
			}
		}

    	if($conf->global->CYBEROFFICE_SHIPPING != $product_id &&  $conf->global->CYBEROFFICE_DISCOUNT != $product_id) {	
    		
			$posD = strrpos($cats[0]['import_key'], "-");
        	$posP = strpos($cats[0]['import_key'], "-");
        	$indiceid = substr($cats[0]['import_key'],$posD + 1);
			/*
			print $posD.' **' .$posP.' **' .$indiceid;
			exit;*/
			if($object->entrepot_id && $object->entrepot_id > 0)
				$sql = 'SELECT c.name as name, c.note as note, c1.value as warehouse FROM '.MAIN_DB_PREFIX.'const c left join '.MAIN_DB_PREFIX.'const c1 on (SUBSTRING(c.name,-2) = SUBSTRING(c1.name,-2) AND c1.name LIKE "MYCYBEROFFICE_warehouse%") WHERE c.name LIKE "CYBEROFFICE_SHOP%" AND (c1.value = ' . $object->entrepot_id . ' OR c1.value = 0) AND c.value in ('.$numshops.')';
			else
				$sql = 'SELECT *, 999 as warehouse FROM '.MAIN_DB_PREFIX.'const WHERE name LIKE "CYBEROFFICE_SHOP%" AND value in ('.$numshops.') ORDER BY name';
					
			dol_syslog("StockCSV_Trigger_MyProduct::sql=".$sql);
			$resql = $db->query($sql);

			if ($resql) {
				while ($obj = $db->fetch_object($resql))
				{
					if ($obj->value == substr($cats[0]['cat'],1,2) || $cats[0]['action']!='add' || $cats[0]['action']!='remove')
					{
						//dol_syslog("Cyberoffice_Trigger_MyProduct:: ".__LINE__);
						//print '<pre>';print_r( $cats);print '</pre>';print 'warehouse='.(int)$obj->warehouse;
						
						if ((int)$obj->warehouse == 0 || (int)$obj->warehouse == 999)
							{$cats['0']['reel']=$cats['0']['reel0'];}
							
						if ($conf->global->MYCYBEROFFICE_stock_theorique == 1 && $cats['0']['reel'] != 'cybernull')
						{
							require_once DOL_DOCUMENT_ROOT.'/product/class/product.class.php';
							$Myobject = new Product($db);
							$Myresult = $Myobject->fetch($product_id);
							$Myobject->load_stock();
							$cats['0']['reel']=$Myobject->stock_theorique;
						}
						
						$cats['0']['tva_tx'] = $conf->global->{"MYCYBEROFFICE_tax".substr($obj->name,-2).(float)$object->tva_tx};
						
						//print "MYCYBEROFFICE_tax".substr($obj->name,-2).(float)$object->tva_tx;
						//print $conf->global->{"MYCYBEROFFICE_tax".substr($obj->name,-2).(float)$object->tva_tx};
						
						//print '<pre>';print_r( $cats);print '</pre>';exit;
						/*print $cats['0']['reel0'].'<pre>';
						print_r($cats);
						print '</pre>';exit;*/	
						$myglobalkey = "MYCYBEROFFICE_key" . substr($obj->name,-2);
						$myglobalshop = "MYCYBEROFFICE_shop" . substr($obj->name,-2);
						$mygloballang = "MYCYBEROFFICE_lang" . substr($obj->name,-2);
						
						dol_syslog("MyCyberoffice_Trigger_MyProduct::shop=".$myglobalshop.'::'.$obj->note);
						
						$ws_dol_url = $obj->note.'modules/mycyberoffice/server_product_soap.php';
						$ws_method  = 'Create';
						$ns = 'http://www.lvsinformatique.com/ns/';
				
						// Set the WebService URL
						$options = array('location' => $obj->note.'modules/mycyberoffice/server_product_soap.php',
				                  'uri' => $obj->note);
						$soapclient = new SoapClient(NULL,$options);
						
						// Call the WebService method and store its result in $result.
						$authentication = array(
							'dolibarrkey'=>htmlentities($conf->global->$myglobalkey, ENT_COMPAT, 'UTF-8'),
							'sourceapplication'	=> 'LVSInformatique',
							'login'				=> '',
							'password'			=> '',
							'shop'				=> $conf->global->$myglobalshop,
							'lang' 				=> $conf->global->$mygloballang,
							'myurl'				=> $_SERVER["PHP_SELF"]
						);
						//print_r($authentication );
						
						//print_r($cats);exit;
						$myparam = $cats;
						//print_r($myparam );
						//$parameters = array('authentication'=>$authentication, $myparam);
						if (htmlentities($conf->global->$myglobalkey, ENT_COMPAT, 'UTF-8'))
						{
							try {
								$result0 = $soapclient->create($authentication, $myparam, $ns, '');
							}
					      	catch(SoapFault $fault)
					      	{
					        	if($fault->faultstring != 'Could not connect to host')
					        	{
					        	//print_r($fault);
					          	//throw $fault;
					        	}
					      	}
				      
							if (! $result0)
							{
    							$result = array(
    								'result'=>array('result_code' => 'KO', 'result_label' => 'KO'),
    								'repertoire' => $obj->note,
    								'repertoireTF' => 'KO',
    								'webservice' => 'KO',
    								'dolicyber' => 'KO',
    								'lang' => $conf->global->$mygloballang,
    								'Result' => $result0
    							);
    						}
						/*print_r($result0);exit;*/
    						if ($result0['result']['result_label'] != 'NOK' && $result0['result']['result_label'] != 'OK')
    						{
    							/*
    							$sql = "SELECT *";
    							$sql.= " FROM ".MAIN_DB_PREFIX."const";
    							$sql.= " WHERE note = '".$conf->global->MYCYBEROFFICE_path."/'";
    							$resql = $db->query($sql);
    							$num = 0;
    							if ($resql) {
    								if ($db->num_rows($resql) > 0) {
    									$res = $db->fetch_array($resql);
    									$num=$res['value'];
    								}
    							}
    							*/
    							/*print_r($result0);exit;*/
    							$num = $obj->value;
    							$myid = explode(":", $result0['result']['result_label']);
    							//$myid[0] = $result0['result']['result_label'];
    							$import_key = 'P'.$num.'-'.$myid[0];
    							$sql = "UPDATE ".MAIN_DB_PREFIX."product SET";
    							$sql .= " import_key='".$import_key."'";
    							$sql.= " WHERE rowid=".$object->id;
    							dol_syslog("StockCSV_Trigger_MyProduct::avant maj import_key=".$import_key.'/'.$num.'/'.$myid[0]);
    							if (substr($import_key, -1, 1) != '-' && $num != 0 && $myid[0] && $myid[0]>0) {
    								dol_syslog("StockCSV_Trigger_MyProduct::maj import_key ok".$sql);
    								$db->begin();
    								$reqsql = $db->query($sql);
    								//dol_syslog("Cyberoffice_Trigger_MyProduct:: ".__LINE__);
    								$db->commit();
									//dol_syslog("Cyberoffice_Trigger_MyProduct:: ".__LINE__);
									print $sql;
    							}
    						}
    						if($conf->global->MYCYBEROFFICE_debug==1) {
    							print '<pre>';
    							print_r($result0);
    				    		print_r($result );
    				    		print_r($fault);
    				    		print_r($myparam);
    				    		print_r($object);
    				    		print '</pre>';
    				    		exit;
    			    		}
			    		//dol_syslog("Cyberoffice_Trigger_MyProduct:: ".__LINE__);
			    		//print '<pre>';print_r($obj);print '</pre>';
			    		}
			    	}
		    	}
		    	//exit;
		    	/*print'***';
		    	print '<pre>';print_r($resql);print '</pre>';
				die();*/
		    	//dol_syslog("Cyberoffice_Trigger_MyProduct:: ".__LINE__);
		    }
		    $erreur=", LOG_ERR";
		    dol_syslog("StockCSV_Trigger_MyProduct:: ".__LINE__.$erreur);
	    }	//fin test service
	    //$db->close();
	    //dol_syslog("StockCSV_Trigger_MyProduct:: ".__LINE__);
	}
}
