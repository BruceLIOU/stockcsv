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
 *	\file		lib/stockcsv.lib.php
 *	\ingroup	stockcsv
 *	\brief		This file is an example module library
 *				Put some comments here
 */

date_default_timezone_set('Europe/Paris');

function stockcsvAdminPrepareHead(){

    global $langs, $conf;

    $langs->load("stockcsv@stockcsv");

    $h = 0;
    $head = array();

    $head[$h][0] = dol_buildpath("/stockcsv/admin/stockcsv_setup.php", 1);

    $head[$h][1] = $langs->trans("Parameters");

    $head[$h][2] = 'settings';

    $h++;

    $head[$h][0] = dol_buildpath("/stockcsv/admin/stockcsv_states.php", 1);

    $head[$h][1] = $langs->trans("States");

    $head[$h][2] = 'states';

    $h++;

    $head[$h][0] = dol_buildpath("/stockcsv/admin/stockcsv_process.php", 1);

    $head[$h][1] = $langs->trans("Process");

    $head[$h][2] = 'process';

    $h++;    

    $head[$h][0] = dol_buildpath("/stockcsv/admin/stockcsv_about.php", 1);

    $head[$h][1] = $langs->trans("About");

    $head[$h][2] = 'about';

    $h++;


    complete_head_from_modules($conf, $langs, $object, $head, $h, 'stockcsv');

    return $head;

}

/**
 * Return array of tabs to used on pages for third parties cards.
 *
 * @param 	Tstockcsv	$object		Object company shown
 * @return 	array				Array of tabs
 */

function stockcsv_prepare_head(Tstockcsv $object)

{
    global $db, $langs, $conf, $user;

    $h = 0;

    $head = array();

    $head[$h][0] = dol_buildpath('/stockcsv/card.php', 1).'?id='.$object->getId();

    $head[$h][1] = $langs->trans("stockcsvCard");

    $head[$h][2] = 'card';

    $h++;
	

    complete_head_from_modules($conf,$langs,$object,$head,$h,'stockcsv');

	return $head;

}

function getFormConfirm(&$PDOdb, &$form, &$object, $action)

{
    global $langs, $conf, $user;

    $formconfirm = '';

    if ($action == 'validate' && !empty($user->rights->stockcsv->write))
    {
        $text = $langs->trans('ConfirmValidatestockcsv', $object->ref);

        $formconfirm = $form->formconfirm($_SERVER['PHP_SELF'] . '?id=' . $object->id, $langs->trans('Validatestockcsv'), $text, 'confirm_validate', '', 0, 1);
    }

    elseif ($action == 'delete' && !empty($user->rights->stockcsv->write))
    {
        $text = $langs->trans('ConfirmDeletestockcsv');

        $formconfirm = $form->formconfirm($_SERVER['PHP_SELF'] . '?id=' . $object->id, $langs->trans('Deletestockcsv'), $text, 'confirm_delete', '', 0, 1);
    }

    elseif ($action == 'clone' && !empty($user->rights->stockcsv->write))
    {
        $text = $langs->trans('ConfirmClonestockcsv', $object->ref);

        $formconfirm = $form->formconfirm($_SERVER['PHP_SELF'] . '?id=' . $object->id, $langs->trans('Clonestockcsv'), $text, 'confirm_clone', '', 0, 1);
    }

    return $formconfirm;
}

/**
 *	display an array with a select
 *
 *	@param	    array		$tablelist      array to display
 *	@param	    string		$selected		id
 *	@param	    string		$htmlname		Value 
 *	@param	    integer		$showempty		show a blank
 *  @return     string         			    return the display in a string
 * 
 *	@see		...
 */

function select_general($tablelist, $selected=0, $htmlname='search_table', $showempty=1){

	global $conf, $langs;

	$nodatarole = '';

	// Enhance with select2

	if ($conf->use_javascript_ajax)
	{
		include_once DOL_DOCUMENT_ROOT . '/core/lib/ajax.lib.php';

		$comboenhancement = ajax_combobox($htmlname);

		$moreforfilter.=$comboenhancement;

		$nodatarole=($comboenhancement?' data-role="none"':'');
	}

    // Print a select with each of them

	$moreforfilter.='<select style=" max-width: 200px;"  class="flat minwidth100" id="'.$htmlname.'" name="'.$htmlname.'"'.$nodatarole.'>';

	if ($showempty) 

		$moreforfilter.='<option name="name_'.$htmlname.' "value="0">&nbsp;</option>';		   // Should use -1 to say nothing

	if (is_array($tablelist))
	{
		foreach ($tablelist as $key => $value)
		{
			$moreforfilter.='<option value="'.$value.'"';

			if ($key == $selected) $moreforfilter.=' selected="selected"';

			$moreforfilter.='>'.dol_trunc($value, 50, 'middle').'</option>';
		}
	}

	$moreforfilter.='</select>';

	return $moreforfilter;
}

/**
 *	display an array with a select
 *
 *	@param	    array		$tablelist      array to display
 *	@param	    string		$selected		id
 *	@param	    string		$htmlname		Value 
 *	@param	    integer		$showempty		show a blank
 *  @return     string         			    return the display in a string
 * 
 *	@see		...
 */

function select_general2($tablelist, $selected=0, $htmlname='search_table', $showempty=1){

	global $conf, $langs;
	
	$nodatarole = '';

	// Enhance with select2

	if ($conf->use_javascript_ajax)
	{
		include_once DOL_DOCUMENT_ROOT . '/core/lib/ajax.lib.php';

		$comboenhancement = ajax_combobox($htmlname);

		$moreforfilter.=$comboenhancement;

		$nodatarole=($comboenhancement?' data-role="none"':'');
	}

	// Print a select with each of them

	$moreforfilter.='<select style=" max-width: 200px;" class="flat minwidth100" id="'.$htmlname.'" name="'.$htmlname.'"'.$nodatarole.'>';

	if ($showempty) 

		$moreforfilter.='<option name="name_'.$htmlname.' "value="0">&nbsp;</option>';		   // Should use -1 to say nothing

	if (is_array($tablelist))
	{
		foreach ($tablelist as $key => $value)
		{
			$moreforfilter.='<option value="'.$value.'"';

			if ($value == $selected) $moreforfilter.=' selected="selected"';

			$moreforfilter.='>'.dol_trunc($value, 50, 'middle').'</option>';
		}
	}

	$moreforfilter.='</select>';

	return $moreforfilter;
}


/**
 *	find all the dir and subdir and stock it in an array
 *
 *	@param	    string		$dir            directory to start the search
 *	@param	    string		$results		id
 *  @return     array                       all the dir and subDirectory
 * 
 *	@see		...
 */

function getDirContents($dir, &$results = array()){

    $files = scandir($dir);

    foreach($files as $key => $value)
    {
		$path = realpath($dir.DIRECTORY_SEPARATOR.$value);

        if(!is_dir($path))
        {
            //$results[] = $path; 		A décommenter SI on veut aussi les fichiers
        }
        
        else if($value != "." && $value != "..")
        {
            getDirContents($path, $results);

			$results[] = $path;		
        }
    }

    return $results;
}

function insertTableMapping_stockcsv($fk_supplier, $fk_warehouse, $folder_csv, $mask_csv, $fk_category, $prefix_supplier, $price_type, $tva, $discount_supplier, $entity=1){

    global $db, $langs;

    if(!$fk_supplier)$error = $error +1;

    if(!$fk_warehouse) $error = $error +1;

    if(!$folder_csv) $error = $error +1;

    if(!$mask_csv) $error = $error +1;

    if(!$fk_category) $error = $error +1;

    if(!$prefix_supplier) $error = $error +1;

    if(!($error >0))
    {
        $sql = 'INSERT INTO '.MAIN_DB_PREFIX.'mapping_stockcsv';
        $sql.= ' (fk_supplier,fk_warehouse,folder_csv,mask_csv,fk_category,prefix_supplier,tva,price_type,discount_supplier,entity)';
        $sql.= ' VALUES';
        $sql.= ' ('.$fk_supplier.','.$fk_warehouse.',"'.$folder_csv.'","'.$mask_csv.'",';
        $sql.= $fk_category.',"'.$prefix_supplier.'-","'.$tva.'","'.$price_type.'",'.$discount_supplier.','.$entity.')';

        $resql = $db->query($sql);

        if ($resql)
        {
            $message = $langs->trans("InsertMappingSuccess");

            setEventMessage($message);
        }

        else
        {
            print $sql;

            $message = $langs->trans("DuplicataInsertMapping");

            setEventMessage($message,'errors');
        }
    }

    else
    {
        print $sql;

        $message = $langs->trans("RequiredFieldInsertMapping");

        setEventMessage($message,'errors');
    }

}

function deleteRowMapping_stockcsv($rowid,$dataFilterFourn){

    global $db, $langs;

    $sql = ' DELETE FROM '.MAIN_DB_PREFIX.'mapping_stockcsv';
    $sql.= ' WHERE rowid='.$rowid;

    $resql = $db->query($sql);

    if ($resql)
    {
        $message = $langs->trans("DeletedMappingSuccess");

        setEventMessage($message, 'warnings');
    }

    else
    {           
        $message = $langs->trans("DeletedMappingFailed");

        setEventMessage($message,'errors');
    }
}

function updateTableMapping_stockcsv($rowid, $fk_supplier, $fk_warehouse, $folder_csv, $mask_csv, $fk_category, $prefix_supplier, $tva, $price_type, $discount_supplier, $entity=1){

    global $db, $langs;

    if(!$rowid) $error = $error +1;

    if(!$fk_supplier) $error = $error +1;

    if(!$fk_warehouse) $error = $error +1;

    if(!$folder_csv) $error = $error +1;

    if(!$mask_csv) $error = $error +1;

    if(!$fk_category) $error = $error +1;

    if(!$prefix_supplier) $error = $error +1;

    if(!$price_type) $error = $error +1;

    if(!$tva) $error = $error +1;



    if(!($error >0))
    {
        $sql = 'UPDATE '.MAIN_DB_PREFIX.'mapping_stockcsv';
        $sql.= ' SET fk_supplier='.$fk_supplier.' ,fk_warehouse='.$fk_warehouse.' ,folder_csv="'.$folder_csv.'",';
        $sql.= ' mask_csv="'.$mask_csv.'",';
        $sql.= ' fk_category='.$fk_category.', prefix_supplier="'.$prefix_supplier.'", price_type="'.$price_type.'",';
        $sql.= ' discount_supplier='.$discount_supplier.', tva ="'.$tva.'"';
        $sql.= ' WHERE rowid='.$rowid;

        $resql = $db->query($sql);

        if ($resql)
        {
            $message = $langs->trans("UpdateMappingSuccess");

            setEventMessage($message);
        }

        else
        {
            $message = $langs->trans("DuplicataUpdateMapping");

            setEventMessage($message,'errors');
        }
    }

    else
    {
        $message = $langs->trans("RequiredUpdateMappingField");

        setEventMessage( $message ,'errors');
    }
}

function updateTableFourn_unavailable($rowidUnavailable, $fk_supplier, $dateStartUpdated, $dateEndUpdated, $reason){

    global $db, $langs;

    if(!$rowidUnavailable) $error = $error +1; 

    if(!$fk_supplier) $error = $error +1;

    if(!$dateEndUpdated) $error = $error +1; 

    if(!$dateStartUpdated) $error = $error +1;

    if(!($error >0))
    {
        if(strtotime($dateStartUpdated)<=strtotime($dateEndUpdated))
        {
            $sql = 'UPDATE '.MAIN_DB_PREFIX.'fourn_unavailable';
            $sql.= ' SET fk_supplierMapping='.$fk_supplier.' ,date_unavailable_start="'.$dateStartUpdated.'" ,date_unavailable_end="'.$dateEndUpdated.'",';
            $sql.= ' reason="'.$reason.'", tms=now()';
            $sql.= ' WHERE rowid='.$rowidUnavailable;

            $resql = $db->query($sql);

            if ($resql)
            {
                $message = $langs->trans("UpdateUnavailableSuccess");

                setEventMessage($message);
            }

            else
            {
                $message = $langs->trans("DuplicataUpdateUnavailable");

                setEventMessage($message,'errors');
            }
        }

        else
        {
            $message = $langs->trans("WrongDateFieldUpdateUnavailable");

            setEventMessage($message,'errors');
        }
    }

    else
    {
        $message = $langs->trans("RequiredUpdateMappingField");

        setEventMessage( $message ,'errors');
    }
}

function insertTableFourn_unavailable($fk_supplier, $date_unavailable_start, $date_unavailable_end, $reason, $entity =1){

    global $db, $langs;
  
    if(!$fk_supplier)$error = $error +1;

    if(!$date_unavailable_start) $error = $error +1;

    if(!$date_unavailable_end) $error = $error +1;

    if(!($error >0))
    {
        if(strtotime($date_unavailable_start)<=strtotime($date_unavailable_end))
        {
            global $db, $langs;

            $sql = 'INSERT INTO '.MAIN_DB_PREFIX.'fourn_unavailable';
            $sql.= ' (fk_supplierMapping,date_unavailable_start,date_unavailable_end,reason,entity,tms)';
            $sql.= ' VALUES';
            $sql.= ' ('.$fk_supplier.',"'.$date_unavailable_start.'","'.$date_unavailable_end.'","'.$reason.'",'.$entity.',now())';

            $resql = $db->query($sql);

            if ($resql)
            {
                $message = $langs->trans("InsertUnavailableSuccess");

                setEventMessage($message);
            }

            else
            {
                addLogEvent($sql);

                $message = $langs->trans("DuplicataInsertUnavailable");

                setEventMessage($message,'errors');
            }
        }

        else
        {
            $message = $langs->trans("WrongDateFieldInsertUnavailable");

            setEventMessage($message,'errors');
        }   
    }

    else
    {
        $message = $langs->trans("RequiredInsertUnavailableField");

        setEventMessage($message,'errors');
    }
}

function getTablefourn_unavailable(){

    global $db,$langs;

    $url = $_SERVER['PHP_SELF'].'?';

    $sql = ' SELECT fu.rowid as id, fu.date_unavailable_start as dateStart,';
    $sql.= ' fu.date_unavailable_end as dateEnd,fu.reason as reason, s.nom as nameSupplier';
    $sql.= ' FROM '.MAIN_DB_PREFIX.'fourn_unavailable as fu'; 
    $sql.= ' LEFT JOIN '.MAIN_DB_PREFIX.'societe as s ON s.rowid = fu.fk_supplierMapping AND s.fournisseur=1';

    $resql = $db->query($sql);

    $rowid          = 0;
    $supplier       = 1;
    $dateStart      = 2;
    $dateEnd        = 3;
    $reason         = 4;
    $image          = 5;

    if($resql)
    {
        $compteurligne=0;
        $nbTotalLignes = $db->num_rows($resql);
      
        while ($compteurligne < $nbTotalLignes)
        {
            $obj = $db->fetch_object($resql);
            
            $result[$compteurligne][$rowid]             = $obj->id;
            $result[$compteurligne][$supplier]          = $obj->nameSupplier;
            $result[$compteurligne][$dateStart]         = $obj->dateStart;
            $result[$compteurligne][$dateEnd]           = $obj->dateEnd;
            $result[$compteurligne][$reason]            = $obj->reason;
            $result[$compteurligne][$image]='<a href='.$url.'action=editFieldsUnavailable'.$obj->id.' class="classfortooltip" title="'.$langs->trans("Modify").'">'.img_picto('','edit','class="imgactions"').'</a>';
            $result[$compteurligne][$image].='<a href='.$url.'action=deleteFieldsUnavailable'.$obj->id.' class="classfortooltip" title="'.$langs->trans("Delete").'">'.img_picto('','delete','class="imgactions"').'</a>';

            $compteurligne= $compteurligne + 1;
        }

        return $result;

    }

    else
    {
        addLogEvent($sql);

        $message = $langs->trans("TableUnavailableEmpty");

        setEventMessage($message,'errors');
    }
}

function deleteRowfourn_unavailable($rowid){

    global $db,$langs;

    $sql = ' DELETE FROM '.MAIN_DB_PREFIX.'fourn_unavailable';
    $sql.= ' WHERE rowid='.$rowid;

    $resql = $db->query($sql);

    if ($resql)
    {
        $message = $langs->trans("DeletedUnavailableSuccess");

        setEventMessage($message);
    }

    else
    {           
        $message = $langs->trans("DeletedUnavailableFailed");

        setEventMessage($message,'errors');
    }
}



function deleteRowEANExclude($rowid){

    global $db,$langs;

    $sql = ' DELETE FROM '.MAIN_DB_PREFIX.'EAN_exclude';
    $sql.= ' WHERE rowid='.$rowid;

    $resql = $db->query($sql);

    if ($resql)
    {
        $message = $langs->trans("DeletedEANSuccess");

        setEventMessage($message,'warnings');
    }

    else
    {           
        $message = $langs->trans("DeletedEANFailed");

        setEventMessage($message,'errors');
    }
}

function deleteRowTermExclude($rowid){
 
    global $db,$langs;
   
    $sql = ' DELETE FROM '.MAIN_DB_PREFIX.'Terms_exclude';
    $sql.= ' WHERE rowid='.$rowid;

    $resql = $db->query($sql);

    if ($resql)
    {
        $message = $langs->trans("DeletedTermSuccess");

        setEventMessage($message);
    }

    else
    {           
        $message = $langs->trans("DeletedTermFailed");

        setEventMessage($message,'errors');
    }
} 

function supplierFromTableMappingIsInTableUnavailable($supplierUnavailable){

    global $db;

    $sql = ' SELECT mp.rowid as id FROM '.MAIN_DB_PREFIX.'mapping_stockcsv as mp';
    $sql.= ' WHERE mp.fk_supplier='.$supplierUnavailable;

    $resql = $db->query($sql);

    if ($resql)
    {
        $obj = $db->fetch_object($resql);    

        return $obj->id;
    }

    else
    {
        $message = $langs->trans("ErrorRequestSql");

        setEventMessage($message,'errors');
    }   
}

function getRowIdSupplier($value){

    global $db,$langs;

    $sql = ' SELECT s.rowid FROM '.MAIN_DB_PREFIX.'societe as s';
    $sql.= ' WHERE s.nom ="'.$value.'" AND s.fournisseur=1';

    $resql = $db->query($sql);

    if($resql)
    {
        $obj= $db->fetch_object($resql);

        return $obj->rowid;
    }

    else
    {
        // error ...

    }
}

function getRowIdProduct($eanValue){

    global $db,$langs;

    $sql = ' SELECT p.rowid as rowid FROM '.MAIN_DB_PREFIX.'product as p';
    $sql.= ' WHERE p.barcode ='.$eanValue; 

    $resql = $db->query($sql);

    if($resql)
    {
        $obj= $db->fetch_object($resql);

        return $obj->rowid;
    }

    else
    {
        // error ...

    }
}

function getRowIdCategory($value){  

    global $db,$langs;

    $sql = ' SELECT rowid FROM '.MAIN_DB_PREFIX.'categorie';
    $sql.= ' WHERE label ="'.$value.'"';

    $resql = $db->query($sql);

    if($resql)
    {
        $obj= $db->fetch_object($resql);

        return $obj->rowid;
    }

    else
    {
        // error ...

    }
}

function getRowIdWarehouse($value){

    global $db,$langs;

    $sql = ' SELECT rowid FROM '.MAIN_DB_PREFIX.'entrepot';
    $sql.= ' WHERE lieu ="'.$value.'"';

    $resql = $db->query($sql);

    if($resql)
    {
        $obj= $db->fetch_object($resql);

        return $obj->rowid;
    }

    else
    {
        // error ...
    }
}    

function getRowIdEAN($value){

    global $db,$langs;

    $sql = ' SELECT e.rowid FROM '.MAIN_DB_PREFIX.'EAN_exclude as e';
    $sql.= ' WHERE e.fk_ean ='.$value;

    $resql = $db->query($sql);

    if($resql)
    {
        $obj= $db->fetch_object($resql);

        return $obj->rowid;
    }

    else
    {
        // error ...
    }
}

function getRowIdTerm($dataTerm){

    global $db,$langs;

    $sql = ' SELECT rowid FROM '.MAIN_DB_PREFIX.'Terms_exclude';
    $sql.= ' WHERE name ="'.$dataTerm.'"';

    $resql = $db->query($sql);

    if($resql)
    {
        $obj= $db->fetch_object($resql);

        return $obj->rowid;
    }

    else
    {
        // error ...
    }
}   

function getTableconst_stockcsv(){
  
    global $db,$langs;

    $ftp                    = 0;
    $coefMarge              = 1;
    $priceHT                = 2;
    $excludeProductError    = 3;
    $nbDayBeforeDelete      = 4;
    $EmptyStockPartner      = 5;
    $mailUser               = 6;
    $warehousePendingOrders = 7;
    $sellPriceMinTo10       = 8;


    $sql = ' SELECT CONST_PATH_FINDING_FTP, CONST_COEF_MARGE_PRICE, CONST_PRICE_HT_MIN, CONST_EXCLUDE_PRODUCT_ERROR,';
    $sql.= ' CONST_NB_DAY_BEFORE_DELETE_PRODUCT,CONST_EMPTY_STOCK_PARTNER, CONST_FK_USER,CONST_WAREHOUSE_PENDING_ORDERS,CONST_SELL_PRICE_MIN_TO_10 FROM '.MAIN_DB_PREFIX.'const_stockcsv';

    $resql = $db->query($sql);

    if($resql)
    {
        $obj = $db->fetch_object($resql);

        $result[$ftp]                   = $obj->CONST_PATH_FINDING_FTP;
        $result[$coefMarge]             = $obj->CONST_COEF_MARGE_PRICE;
        $result[$priceHT]               = $obj->CONST_PRICE_HT_MIN;
        $result[$excludeProductError]   = $obj->CONST_EXCLUDE_PRODUCT_ERROR;
        $result[$nbDayBeforeDelete]     = $obj->CONST_NB_DAY_BEFORE_DELETE_PRODUCT;
        $result[$EmptyStockPartner]     = $obj->CONST_EMPTY_STOCK_PARTNER;
        $result[$mailUser]              = $obj->CONST_FK_USER;
        $result[$warehousePendingOrders]= $obj->CONST_WAREHOUSE_PENDING_ORDERS;
        $result[$sellPriceMinTo10]      = $obj->CONST_SELL_PRICE_MIN_TO_10;

        return $result;
    }

    else
    {
        $message = $langs->trans("TableConstEmpty");

        setEventMessage($message,'errors');
    }
}

function getTableMapping_stockcsv($instanceFourn,$instanceWareHouse){    

    global $db,$langs;

    $url = $_SERVER['PHP_SELF'];

    // on recupere les products des commandes

    $sql = ' SELECT mp.rowid as id ,mp.fk_supplier as supplier ,mp.fk_warehouse as warehouse ,e.lieu as labelEntrepot ,';
    $sql.= ' c.label as labelCategorie,c.rowid as idCateg,mp.folder_csv as folder_csv , mp.mask_csv as mask_csv,';
    $sql.= ' mp.prefix_supplier as prefix_supplier ,mp.price_type as price_type , mp.tva as tva,';
    $sql.= ' mp.discount_supplier as discount_supplier';
    $sql.= ' FROM '.MAIN_DB_PREFIX.'mapping_stockcsv as mp';
    $sql.= ' LEFT JOIN '.MAIN_DB_PREFIX.'entrepot as e ON e.rowid = mp.fk_warehouse';
    $sql.= ' LEFT JOIN '.MAIN_DB_PREFIX.'categorie as c ON c.rowid = mp.fk_category';
  
    $resql = $db->query($sql);

    $rowid              = 0;
    $supplier           = 1;
    $warehouse          = 2;
    $folder_csv         = 3;
    $mask_csv           = 4;
    $idcategory         = 5;
    $labelcategory      = 6;
    $prefix_supplier    = 7;
    $price_type         = 8;
    $tva                = 9;
    $discount_supplier  = 10;
    $image              = 11;
    $idSupplier         = 12; //used for states

    if($resql)
    {
        $compteurligne=0;
        $nbTotalLignes = $db->num_rows($resql);

        while ($compteurligne < $nbTotalLignes)
        {
            $obj = $db->fetch_object($resql);
          
            $instanceFourn->fourn_id    = $obj->supplier;
            $instanceWareHouse->id          = $obj->warehouse;
            $instanceWareHouse->libelle     = $obj->labelEntrepot;


            $result[$compteurligne][$rowid]             = $obj->id;
            $result[$compteurligne][$supplier]          = $instanceFourn->getSocNomUrl('','supplier');
            $result[$compteurligne][$warehouse]         = $instanceWareHouse->getNomUrl();
            $result[$compteurligne][$folder_csv]        = $obj->folder_csv;
            $result[$compteurligne][$mask_csv]          = $obj->mask_csv;
            $result[$compteurligne][$labelcategory]     = $obj->labelCategorie;
            $result[$compteurligne][$idcategory]        = $obj->idCateg;
            $result[$compteurligne][$prefix_supplier]   = $obj->prefix_supplier;
            $result[$compteurligne][$price_type]        = $obj->price_type;
            $result[$compteurligne][$tva]               = $obj->tva;
            $result[$compteurligne][$discount_supplier] = $obj->discount_supplier;
            $result[$compteurligne][$idSupplier]        = $obj->supplier;
            $result[$compteurligne][$duration]          = $obj->supplier;

            $url.= '?id='.$obj->id.'&amp;';
            $url.= 'supplier='.$obj->supplier.'&amp;';
            $url.= 'warehouse='.$obj->warehouse.'&amp;';
            $url.= 'pathFTP='.$obj->folder_csv.'&amp;';
            $url.= 'maskCSV='.$obj->mask_csv.'&amp;';
            $url.= 'warehouse='.$obj->warehouse.'&amp;';
            $url.= 'idCateg='.$obj->idCateg.'&amp;';
            $url.= 'prefSupplier='.$obj->prefix_supplier.'&amp;';
            $url.= 'typePrice='.$obj->price_type.'&amp;';
            $url.= 'tva='.$obj->tva.'&amp;';
            $url.= 'discountSupplier='.$obj->discount_supplier.'&amp;';

            $result[$compteurligne][$image]='<a href='.$url.'action=editMapping'.$obj->id.' class="classfortooltip" title="'.$langs->trans("Modify").'">'.img_picto('','edit','class="imgactions"').'</a>';
            $result[$compteurligne][$image].='<a href='.$url.'action=deleteMapping'.$obj->id.' class="classfortooltip" title="'.$langs->trans("Delete").'">'.img_picto('','delete','class="imgactions"').'</a>';

            $compteurligne= $compteurligne + 1;
        }
        return $result;
    }

    else
    {
        $message = $langs->trans("TableMappingEmpty");

        setEventMessage($message,'errors');
    }
}

function getFournTableMapping(){

    global $db, $langs;

    $result = array();

    $sql = ' SELECT s.nom as nameSupplier FROM  '.MAIN_DB_PREFIX.'mapping_stockcsv as mp';
    $sql.= ' LEFT JOIN '.MAIN_DB_PREFIX.'societe as s ON s.rowid = mp.fk_supplier AND s.fournisseur =1';

    $resql = $db->query($sql);

    if($resql)
    {
        $compteurligne=0;
        $nbTotalLignes = $db->num_rows($resql);

        while ($compteurligne < $nbTotalLignes)
        {
            $obj = $db->fetch_object($resql);

            $result[$compteurligne] = $obj->nameSupplier;

            $compteurligne +=1;
        }
    }

    else
    {
        // error ...
    }

    return $result;
}

function getTableTermsExclude(){

    global $db, $langs;

    $result = array();

    $sql = ' SELECT UPPER(name) as nameTerm FROM '.MAIN_DB_PREFIX.'Terms_exclude';

    $resql = $db->query($sql);

    if($resql)
    {
        $compteurligne=0;
        $nbTotalLignes = $db->num_rows($resql);

        while ($compteurligne < $nbTotalLignes)
        {
            $obj = $db->fetch_object($resql);

            $result[$compteurligne] = $obj->nameTerm;

            $compteurligne +=1;
        }
    }

    else
    {
        // error ...
    }

    return $result;
}

function getTableSkuExclude(){

    global $db, $langs;

    $result = array();

    $sql = ' SELECT fk_sku FROM  '.MAIN_DB_PREFIX.'SKU_exclude';

    $resql = $db->query($sql);

    if($resql)
    {
        $compteurligne=0;
        $nbTotalLignes = $db->num_rows($resql);

        while ($compteurligne < $nbTotalLignes)
        {
            $obj = $db->fetch_object($resql);

            $result[$compteurligne] = $obj->fk_sku;

            $compteurligne +=1;
        }
    }
    else
    {
        // error ...
    }
    return $result;
}

function getTableEANExclude(){

    global $db, $langs;

    $result = array();

    $sql = ' SELECT fk_ean FROM  '.MAIN_DB_PREFIX.'EAN_exclude';

    $resql = $db->query($sql);

    if($resql)
    {
        $compteurligne=0;
        $nbTotalLignes = $db->num_rows($resql);

        while ($compteurligne < $nbTotalLignes)
        {
            $obj = $db->fetch_object($resql);

            $result[$compteurligne] = $obj->fk_ean;

            $compteurligne +=1;
        }
    }

    else
    {
        // error ...
    }

    return $result;
}

function getTableProduct(){

    global $db, $langs;

    $result = array();
  
    $sql = ' SELECT barcode,ref FROM  '.MAIN_DB_PREFIX.'product';

    $resql = $db->query($sql);

    $barcode    = 0;
    $ref        = 1;

    if($resql)
    {
        $compteurligne=0;
        $nbTotalLignes = $db->num_rows($resql);

        while ($compteurligne < $nbTotalLignes)
        {
            $obj = $db->fetch_object($resql);

            $result[$compteurligne][$barcode]   = $obj->barcode; 
            $result[$compteurligne][$ref]       = $obj->ref;

            $compteurligne +=1;
        }
    }

    else
    {
        // error ...
    }

    return $result;
}

function getTableProductRowId(){
  
    global $db, $langs;

    $result = array();
  
    $sql = ' SELECT rowid FROM  '.MAIN_DB_PREFIX.'product';

    $resql = $db->query($sql);

    if($resql)
    {
        $compteurligne=0;
        $nbTotalLignes = $db->num_rows($resql);

        while ($compteurligne < $nbTotalLignes)
        {
            $obj = $db->fetch_object($resql);

            if($result[$compteurligne] = $obj->rowid)

                $compteurligne +=1;

            else
            {
                $nbTotalLignes -=1;
            }
        }
    }

    else
    {
        // error ...
    }

    return $result;
}

function getTableProductEAN(){
   
    global $db, $langs;

    $result = array();
   
    $sql = ' SELECT barcode FROM  '.MAIN_DB_PREFIX.'product';

    $resql = $db->query($sql);

    if($resql)
    {
        $compteurligne=0;
        $nbTotalLignes = $db->num_rows($resql);

        while ($compteurligne < $nbTotalLignes)
        {
            $obj = $db->fetch_object($resql);

            if($result[$compteurligne] = $obj->barcode)

                $compteurligne +=1;

            else
            {
                $nbTotalLignes -=1;
            }
        }
    }

    else
    {
        // error ...
    }

    return $result;
}

function getTableProductSKU(){

    global $db, $langs;

    $result = array();

    $sql = ' SELECT ref FROM  '.MAIN_DB_PREFIX.'product';

    $resql = $db->query($sql);

    if($resql)
    {
        $compteurligne=0;
        $nbTotalLignes = $db->num_rows($resql);

        while ($compteurligne < $nbTotalLignes)
        {
            $obj = $db->fetch_object($resql);

            if($result[$compteurligne] = $obj->ref)

                $compteurligne +=1;

            else
            {
                $nbTotalLignes -=1;
            }
        }
    }

    else
    {
        // error ...
    }

    return $result;
}

function insertTermExclude($dataTermExclude){

    global $db, $langs;

    if(!$dataTermExclude) $error = $error +1;

        if(!($error >0))
        {
            $sql = 'INSERT INTO '.MAIN_DB_PREFIX.'Terms_exclude';
            $sql.= ' (name)';
            $sql.= ' VALUES';
            $sql.= ' ("'.strtoupper($dataTermExclude).'")';

            $resql = $db->query($sql);

            if ($resql)
            {
                $message = $langs->trans("InsertTermSuccess");
                setEventMessage($message);
            }
            else
            {
                $message = $langs->trans("DuplicataInsertTerm");
                setEventMessage($message,'errors');
            }
        }

        else
        {
            $message = $langs->trans("RequiredInsertTerm");
            setEventMessage($message,'errors');
        }
}


function insertEANExclude($dataEANExclude){

    global $db, $langs;

    if(!$dataEANExclude) $error = $error +1;

        if(!($error >0))
        {
            $sql = 'INSERT INTO '.MAIN_DB_PREFIX.'EAN_exclude';
            $sql.= ' (fk_ean)';
            $sql.= ' VALUES';
            $sql.= ' ("'.$dataEANExclude.'")';

            $resql = $db->query($sql);
            if ($resql)
            {
                $message = $langs->trans("InsertEANSuccess");
                setEventMessage($message);
            }

            else
            {
                $message = $langs->trans("DuplicataInsertEAN");
                setEventMessage($message,'errors');
            }
        }
        else
        {
            $message = $langs->trans("RequiredInsertEAN");
            setEventMessage($message,'errors');
        }
}

function updatecoefMargInCon($dataCoef){

    global $db, $langs;

    if (!($dataCoef ==0))
    {
        if(!$dataCoef )  $error = $error +1;
    }

    if(!($error >0))
    {
        $sql = 'UPDATE '.MAIN_DB_PREFIX.'const_stockcsv';
        $sql.= ' SET';
        $sql.= ' CONST_COEF_MARGE_PRICE='.$dataCoef.',';
        $sql.= ' tms = now()';
        $sql.= ' WHERE rowid=1';

        $resql = $db->query($sql);

        if ($resql)
        {
            $message = $langs->trans("UpdateConstantSuccess");

            setEventMessage($message);
        }
        else
        {
            $message = $langs->trans("DuplicataUpdateConstant");

            setEventMessage($message,'errors');
        }
    }

    else
    {
        $message = $langs->trans("RequiredUpdateConstantField");

        setEventMessage( $message ,'errors');
    }
}

function changeEverything($user){

    global $db, $langs;

    $sql = "select fk_product, tva_tx from ".MAIN_DB_PREFIX."product_fournisseur_price";

    $fk_prod =0;
    $tva = 1;
    $resql = $db->query($sql);

    if ($resql)
    {
        $compteurligne=0;
        $nbTotalLignes = $db->num_rows($resql);

        while ($compteurligne < $nbTotalLignes)
        {
            $obj = $db->fetch_object($resql);

            $result[$compteurligne][$fk_prod]   = $obj->fk_product;
            $result[$compteurligne][$tva]       = $obj->tva_tx;

            $compteurligne +=1;
        }
    }
    else
    {
        addLogEvent($sql);
    }

    updateSoldPrice($result,$user);
}

function updateTableConst($dataLowPrice, $dataNbDayDelete, $excludeProductError, $emptyStockPartner, $dataIdRobot, $warehousePendingOrders, $sellPriceMinTo10){
   
    global $db, $langs;

    if (!($dataLowPrice ==0))
    {
        if(!$dataLowPrice )  $error = $error +1;
    }

    if (!($dataNbDayDelete ==0))
    {
        if(!$dataNbDayDelete ) $error = $error +1;
    }
  
    if(!($error >0))
    {
        $sql = 'UPDATE '.MAIN_DB_PREFIX.'const_stockcsv';
        $sql.= ' SET';
        $sql.= ' CONST_PRICE_HT_MIN='.$dataLowPrice.',';
        $sql.= ' CONST_NB_DAY_BEFORE_DELETE_PRODUCT='.$dataNbDayDelete.',';
        $sql.= ' CONST_EXCLUDE_PRODUCT_ERROR ='.$excludeProductError.',';
        $sql.= ' CONST_EMPTY_STOCK_PARTNER='.$emptyStockPartner.',';
        $sql.= ' CONST_FK_USER ='.$dataIdRobot.',';
        $sql.= ' CONST_WAREHOUSE_PENDING_ORDERS='.$warehousePendingOrders.',';
        $sql.= ' CONST_SELL_PRICE_MIN_TO_10 ='.$sellPriceMinTo10.',';
        $sql.= ' tms = now()';
        $sql.= ' WHERE rowid=1';
       
        $resql = $db->query($sql);

        if ($resql)
        {
            $message = $langs->trans("UpdateConstantSuccess");

            setEventMessage($message);
        }

        else
        {
            $message = $langs->trans("DuplicataUpdateConstant");

            setEventMessage($message,'errors');
        }
    }

    else
    {
        $message = $langs->trans("RequiredUpdateConstantField");

        setEventMessage( $message ,'errors');
    }
}

function initProduct($instanceProduct,$dataIdEANExclude){

    global $db, $langs;

    $sql = "SELECT p.rowid as id, p.label, p.price, p.ref, p.fk_product_type, p.tosell, p.tobuy, p.fk_price_expression,";
    $sql.= " p.entity";
    $sql.= " FROM ".MAIN_DB_PREFIX."product as p";
    $sql.= " WHERE p.barcode =".$dataIdEANExclude." AND p.fk_product_type = 0" ;

    $resql = $db->query($sql);

    if ($resql)
    {
        $objp = $db->fetch_object($result);

        $instanceProduct->id            = $objp->id;
        $instanceProduct->ref           = $objp->ref;
        $instanceProduct->label         = $objp->label;
        $instanceProduct->type          = $objp->fk_product_type;
        $instanceProduct->entity        = $objp->entity;

        return $instanceProduct;
    }

    else
    {
        $message = $langs->trans("DuplicataInsertEAN");

        setEventMessage($message,'errors');
    }
}

function TermExistTableTermsExclude($dataEANExclude){
  
    global $db, $langs;

    $sql = ' SELECT te.name as name FROM  '.MAIN_DB_PREFIX.'Terms_exclude as te';
    $sql.= ' WHERE te.name="'.$dataEANExclude.'"';

    $resql = $db->query($sql);

    if ($resql)
    {
        $obj = $db->fetch_object($resql);    

        return $obj->name;
    }

    else
    {
        //PasEncoreCrée
    }
}

function EANExistTableEANExclude($dataEANExclude){

    global $db, $langs;

    $sql = ' SELECT te.fk_ean as fk_ean FROM  '.MAIN_DB_PREFIX.'EAN_exclude as te';
    $sql.= ' WHERE te.fk_ean='.$dataEANExclude;

    $resql = $db->query($sql);

    if ($resql)
    {
        $obj = $db->fetch_object($resql);    

        return $obj->fk_ean;
    }

    else
    {
        //PasEncoreCrée
    }
}

function EANExistTableProduct($dataEANExclude){

    global $db, $langs;

    $sql = ' SELECT p.ref as ref FROM  '.MAIN_DB_PREFIX.'product as p';
    $sql.= ' WHERE p.barcode='.$dataEANExclude.' AND p.fk_product_type = 0';

    $resql = $db->query($sql);

    if ($resql)
    {
        $obj = $db->fetch_object($resql);    

        return $obj->ref;
    }

    else
    {
        // error msg
        print $sql;
    }
}

function affichageLigneUnavailable($supplier,$dateStart,$dateEnd,$imgs_picto,$reason){
    
    global $db;

    print '<td width="35%">';

    print $supplier;

    print '</td>';

    print '<td width="20%">';

    //print dol_print_date($dateStart,'daytext');
    print dol_print_date($db->jdate($dateStart), 'daytext');

    print '</td>';

    print '<td width="20%">';

    //print dol_print_date($dateEnd,'daytext');
    print dol_print_date($db->jdate($dateEnd), 'daytext');

    print '</td>';

    print '<td width="20%">';

    print $reason;

    print '</td>';

    print '<td width="5%">';

    print $imgs_picto;

    print '</td>';
}

function affichageLigneMapping($supplier, $warehouse, $repFTP, $maskCSV, $labelcategory, $prefSupplier, $tva, $typePrice,$discountSupplier, $imgs_picto){

    print '<td style="width:20%">';

    print $supplier;

    print '</td>';

    print '<td style="width:10%">';

    print $warehouse;

    print '</td>';

    print '<td style="width:10%">';

    print $repFTP;

    print '</td>';

    print '<td style="width:10%">';

    print $maskCSV;

    print '</td>';

    print '<td style="width:10%">';

    print $labelcategory;

    print '</td>';

    print '<td style="width:10%">';

    print $prefSupplier;

    print '</td>';

    print '<td style="width:10%">';

    print $tva.'%';

    print '</td>';

    print '<td style="width:10%">';

    print $typePrice;

    print '</td>';

    print '<td style="width:10%">';

    print $discountSupplier.'%';

    print '</td>';

    print '<td style="width:10%">';

    print $imgs_picto;

    print '</td>';
}

function showTble($tbl,$getpostSmthng,$const,$show=1){

    $filterTbl= select_general($tbl, $getpostSmthng, $const,$show=1);

    print $filterTbl;
}

function showTble2($tbl,$getpostSmthng,$const,$show=1){

    $filterTbl = select_general2($tbl, $getpostSmthng, $const,$show=1);

    print $filterTbl;
}