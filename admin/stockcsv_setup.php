<?php

//ini_set('max_execution_time', 3600);

$startDuration    = microtime(true);

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
 * 	\file		admin/stockcsv.php
 * 	\ingroup	stockcsv
 * 	\brief		This file is an example module setup page
 * 				Put some comments here
 */

// Dolibarr environment
$res = @include("../../main.inc.php"); // From htdocs directory
if (! $res) {
    $res = @include("../../../main.inc.php"); // From "custom" directory
}

//date_default_timezone_set('Europe/Paris');

// DOL_DOCUMENT_ROOT = htdocs

// Libraries
//core/lib
require_once DOL_DOCUMENT_ROOT.'/core/lib/admin.lib.php';
require_once DOL_DOCUMENT_ROOT.'/core/lib/product.lib.php';
require_once DOL_DOCUMENT_ROOT.'/core/lib/date.lib.php';

//core/class
require_once DOL_DOCUMENT_ROOT.'/core/class/html.form.class.php';
require_once DOL_DOCUMENT_ROOT.'/core/class/html.formother.class.php';

//custom
require_once DOL_DOCUMENT_ROOT.'/custom/stockcsv/class/stockcsv.class.php';
require_once DOL_DOCUMENT_ROOT.'/custom/stockcsv/lib/stockcsv.lib.php';
require_once DOL_DOCUMENT_ROOT.'/custom/stockcsv/lib/stockcsvCommandeEnCours.lib.php';

//product
require_once DOL_DOCUMENT_ROOT.'/product/class/html.formproduct.class.php';
require_once DOL_DOCUMENT_ROOT.'/product/stock/class/entrepot.class.php';

//fourn
require_once DOL_DOCUMENT_ROOT.'/fourn/class/fournisseur.class.php';

if (! empty($conf->categorie->enabled))
	require_once DOL_DOCUMENT_ROOT.'/categories/class/categorie.class.php';

// Translations
$langs->load("stockcsv@stockcsv");
$langs->load("admin");
$langs->load('other');
$langs->load("suppliers");
$langs->load("bills");

// Access control
if (! $user->admin) {
    accessforbidden();
}

/*
 * View
 */
$page_name = $langs->trans("page_name");

llxHeader('', $page_name);

// Subheader
$linkback = '<a href="' . DOL_URL_ROOT . '/admin/modules.php">'
    . $langs->trans("BackToModuleList") . '</a>';
print_fiche_titre($langs->trans($page_name), $linkback);
//print_fiche_titre($langs->trans($page_name), $linkback, '', '', 'stockscsvsetup','','');

// Configuration header
$head = stockcsvAdminPrepareHead();

dol_fiche_head(
    $head,
    'settings',
    $langs->trans("Module100000Name"),
    0,
    "stockcsv@stockcsv"
);

$getpostAction 					= GETPOST('action', 'alpha');
$confirm 						= GETPOST('confirm', 'alpha');

// Parameters from llx_mapping_csv
$dataRowId_mapping_csv 			= GETPOST('rowidMapping', 'int');
$dataFilterFourn 				= GETPOST('supplier', 'alpha');
$dataFilterWarehouse 			= GETPOST('warehouse', 'alpha');
$dataIdFilterCateg 				= GETPOST('category', 'alpha');
$dataSelectPath 				= GETPOST('selectPath','alpha');
$dataMask 						= GETPOST('mask','alpha');
$dataPrefSupplier 				= GETPOST('prefSupplier','alpha');
$dataTypePrice 					= GETPOST('selectTypePrice','alpha');
$dataSoldPriceSuppliers 		= GETPOST('soldPriceSuppliers','alpha');
$dataTva						= GETPOST('tva','alpha');

// Parameters from llx_fourn_unavailable
$dataRowId_fourn_unavailable	= GETPOST('rowidUnavailable', 'int');
$dataSupplierMapping 			= GETPOST('SupplierMapping','alpha');
$dataReason						= GETPOST('reason','alpha');

// Parameters from llx_const_stockcsv
$dataCoef 					= GETPOST('STOCKCSV_COEF','alpha');
$dataLowPrice 				= GETPOST('STOCKCSV_LOW_PRICE','int');
$dataNbDayDelete 			= GETPOST('STOCKCSV_NBDAYS','int');
$dataErrorEAN 				= GETPOST('STOCKCSV_ERROREAN','int');
$dataEmptyStock 			= GETPOST('STOCKCSV_CSVNOTPRESENT','int');
$dataMailUser 				= GETPOST('STOCKCSV_MAILUSER','int');
$dataWarehousePendingOrders	= GETPOST('WAREHOURS_PENDING_ORDERS','alpha');
$dataSellPriceMinTo10		= GETPOST('SELL_PRICE_MIN_TO_10','alpintha');

// Parameters from calendar input (Dolibarr)

// Shows
$dataGetDateAvailableStartDay	= GETPOST('dateAvailableStartday','alpha');
$dataGetDateAvailableStartMonth	= GETPOST('dateAvailableStartmonth','alpha');
$dataGetDateAvailableStartYear 	= GETPOST('dateAvailableStartyear','alpha');
$dataGetDateAvailableEndDay		= GETPOST('dateAvailableEndday','alpha');
$dataGetDateAvailableEndMonth	= GETPOST('dateAvailableEndmonth','alpha');
$dataGetDateAvailableEndYear	= GETPOST('dateAvailableEndyear','alpha');

// Parameters from calendar input (Dolibarr)

// Update
$dataUpdatedateAvailableStartDay	= GETPOST('UpdatedateAvailableStartday','alpha');
$dataUpdatedateAvailableStartMonth	= GETPOST('UpdatedateAvailableStartmonth','alpha');
$dataUpdatedateAvailableStartYear 	= GETPOST('UpdatedateAvailableStartyear','alpha');
$dataUpdatedateAvailableEndDay		= GETPOST('UpdatedateAvailableEndday','alpha');
$dataUpdatedateAvailableEndMonth	= GETPOST('UpdatedateAvailableEndmonth','alpha');
$dataUpdatedateAvailableEndYear		= GETPOST('UpdatedateAvailableEndyear','alpha');

// Parameters from select input (Dolibarr)
$dataIdFilterSupplierMapping 	= getRowIdSupplier($dataSupplierMapping);
$dataIdFilterFourn 				= getRowIdSupplier($dataFilterFourn);
$dataIdFilterWarehouse 			= getRowIdWarehouse($dataFilterWarehouse);

//EAN
$dataEANExclude					= GETPOST('EANExclude', 'alpha');
$dataTextAreaEANExclude			= GETPOST('TextAreaEANExclude', 'alpha');
$dataRowIdEANExclude 			= getRowIdEAN($dataEANExclude);
$dataRowIdEAN					= GETPOST('deleteEAN', 'alpha'); // recupere le rowid de l'ean
$dataUpdateEAN					= GETPOST('saveEAN', 'alpha'); // recupere l'ean
$dataUpdateTAEAN				= GETPOST('saveTextAreaEAN', 'alpha'); // recupere l'ean

//Terms
$dataTermsExclude				= GETPOST('addTermExclude', 'alpha');
$dataTerm						= GETPOST('deleteTerm', 'alpha');
$dataRowIdTerm					= getRowIdTerm($dataTermsExclude);

/*Creation class' instances
****/
$fournisseur			= new Fournisseur($db);
$form					= new Form($db);
$instanceStockCsv 		= new Tstockcsv();
$instanceFourn 			= new ProductFournisseur($db);
$instanceWareHouse 		= new Entrepot($db);
$instanceProduct 		= new Product($db);
$htmlother				= new FormOther($db);

/* Creation tables
****/
$tblwarehouse 			= $instanceStockCsv->ListArrayWareHouse();
$tblcateg 				= $instanceStockCsv->ListArrayCategorie();
$tblfourn				= $fournisseur->ListArray();
$tblConstCSV 			= getTableconst_stockcsv();

//Constantes from table const
$ftp                    = $tblConstCSV[0];
$coefMarge              = $tblConstCSV[1];
$priceLowHT             = $tblConstCSV[2];
$excludeProductError    = $tblConstCSV[3];
$nbDayBeforeDelete      = $tblConstCSV[4];
$emptyStockPartner      = $tblConstCSV[5];
$robotMailUser			= $tblConstCSV[6];
$warehousePendingOrders = $tblConstCSV[7];
$sellPriceMinTo10		= $tblConstCSV[8];
$pathFTP 				= DOL_DATA_ROOT.$ftp;
$arrayDir 				= getDirContents($pathFTP);

if ($getpostAction == 'insertIntoMapping'){	
	insertTableMapping_stockcsv($dataIdFilterFourn,
	                    $dataIdFilterWarehouse,
                        $dataSelectPath,
                        $dataMask,
                        $dataIdFilterCateg,
                        substr($dataPrefSupplier,0,6),
						$dataTypePrice,
						$dataTva,
						$dataSoldPriceSuppliers
						);
}

if ($getpostAction == 'updateMapping'){
	updateTableMapping_stockcsv($dataRowId_mapping_csv,
						$dataIdFilterFourn,
	                    $dataIdFilterWarehouse,
                        $dataSelectPath,
                        $dataMask,
                        $dataIdFilterCateg,
						substr($dataPrefSupplier,0,6), // pour recuperer seulement les 6 premiers caractères
						$dataTva,
                        $dataTypePrice,
						$dataSoldPriceSuppliers,
						$dataTva);
}

if ($getpostAction == 'insertIntoUnavailable'){
	$dateUnavailableStart = $dataGetDateAvailableStartYear . '-'. $dataGetDateAvailableStartMonth. '-'.$dataGetDateAvailableStartDay;
	$dateUnavailableEnd =$dataGetDateAvailableEndYear . '-'. $dataGetDateAvailableEndMonth. '-'.$dataGetDateAvailableEndDay;
	insertTableFourn_unavailable($dataIdFilterSupplierMapping,$dateUnavailableStart,$dateUnavailableEnd,$dataReason);
}

if ($getpostAction == 'UpdateUnavailable'){
	$dateStartUpdated = $dataUpdatedateAvailableStartYear . '-'. $dataUpdatedateAvailableStartMonth. '-'.$dataUpdatedateAvailableStartDay;
	$dateEndUpdated =$dataUpdatedateAvailableEndYear . '-'. $dataUpdatedateAvailableEndMonth. '-'.$dataUpdatedateAvailableEndDay;
	updateTableFourn_unavailable($dataRowId_fourn_unavailable,$dataIdFilterSupplierMapping,$dateStartUpdated,$dateEndUpdated,$dataReason);
}

if ($getpostAction == 'deleteEAN'){
	deleteRowEANExclude($dataRowIdEAN);
}

if ($getpostAction == 'saveEAN'){
	insertEANExclude($dataUpdateEAN);
}

if($getpostAction == 'saveTextAreaEAN'){
	$ListEans = explode(";", $dataUpdateTAEAN);

	foreach($ListEans as $ean){
		if($ean){
			if(strlen($ean)==13){
				insertEANExclude($ean);
			}
		}
	}
}

if ($getpostAction == 'deleteTerm'.$dataTerm){
	deleteRowTermExclude($dataTerm);
}

if($getpostAction == 'updateCoefMarge'){

	$coefMarge 				= $dataCoef;

	updatecoefMargInCon($coefMarge);
	changeEverything($user);

}

if($getpostAction == 'updateConstante'){

	$priceLowHT				= $dataLowPrice;
	$nbDayBeforeDelete 		= $dataNbDayDelete;
	$excludeProductError 	= $dataErrorEAN;
	$emptyStockPartner 		= $dataEmptyStock;
	$robotMailUser			= $dataMailUser;
	$warehousePendingOrders = getRowIdWarehouse($dataWarehousePendingOrders);
	$sellPriceMinTo10		= $dataSellPriceMinTo10;

	updateTableConst($priceLowHT,$nbDayBeforeDelete,$excludeProductError,$emptyStockPartner,$robotMailUser,$warehousePendingOrders,$sellPriceMinTo10);

}

// MAPPING DOLIBARR
print '<div class="section">';
print '<label>'.$langs->trans("LabelMappingDoli").'</label>';
print '<table class="noborder" width="100%">';
print '<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';
print '			<tr class="liste_titre">';
print '				<td width="15%">'.$form->textwithpicto($langs->trans("Suppliers"),$langs->trans("TextHelpMappingSuppliers"),1,'help','').'</td>';
print '				<td width="10%">'.$form->textwithpicto($langs->trans("Warehouse"),$langs->trans("TextHelpMappingWarehouse"),1,'help','').'</td>';
print '				<td width="10%">'.$form->textwithpicto($langs->trans("FolderFTP"),$langs->trans("TextHelpMappingFolderFTP"),1,'help','').'</td>';
print '				<td width="10%">'.$form->textwithpicto($langs->trans("MaskCSV"),$langs->trans("TextHelpMappingMaskCSV"),1,'help','').'</td>';
print '				<td width="10%">'.$form->textwithpicto($langs->trans("Category"),$langs->trans("TextHelpMappingCategory"),1,'help','').'</td>';
print '				<td width="10%">'.$form->textwithpicto($langs->trans("PrefRefSuppliers"),$langs->trans("TextHelpMappingPrefRefSuppliers"),1,'help','').'</td>';
print '				<td width="10%">'.$form->textwithpicto($langs->trans("Tva"),$langs->trans("TextHelpMappingTva"),1,'help','').'</td>';
print '				<td width="10%">'.$form->textwithpicto($langs->trans("TypePrice"),$langs->trans("TextHelpMappingTypePrice"),1,'help','').'</td>';
print '				<td width="10%">'.$form->textwithpicto($langs->trans("SoldSuppliers"),$langs->trans("TextHelpMappingSoldSuppliers"),1,'help','').'</td>';
print '				<td width="5%"></td>';
print '			</tr>';

// SUPPLIERS
$var=!$var;

print '			<tr '.$bc[$var].'>';
print '				 <td width="15%">';
showTble($tblfourn,'','supplier');
print '				</td>';

// WAREHOUSES
print '				 <td  width="10%">';
showTble($tblwarehouse,'','warehouse');
print '				</td>';

// FOLDER FTP CSV
print '				 <td  width="10%">';
print '					<select id="selectPath" name ="selectPath">';
print '						<option value="" selected></option>';
				foreach ($arrayDir as $dir)
				{
					// On garde seulement la fin du path pour une meilleure lisibilitée  +1 pour supprimer le slash
					$dir = substr($dir,strlen($pathFTP)+1);

					// On remplace les "\" par des "/"
					$dir = str_replace("\\","/",$dir); 

					// On affiche chaque repertoire / sous repertoire
					print '	<option value="'.$dir.'" >'.$dir.'</option>';
				}

print '					</select>';
print '				</td>';

// MASK CSV
print '				<td  width="10%">';
print '					<input size="10" type="text" name="mask" value="" />';
print '				</td>';

// CATEGORY
print '				 <td  width="10%">';
print $htmlother->select_categories(0,'','category',1);
print '				</td>';

// PREFIX REF SUPPLIERS
print '				 <td width="10%">';
print '					<input size="8" type="text" name="prefSupplier" value="" maxlength="6" />';
print '				</td>';

// TVA
print '				 <td width="10%">';
print '					<input size="4" name ="tva" class="text" type="text" value="20.00" placeholder="'.$langs->trans("Tva").'"/>';
print '				</td>';

// BASE PRICE BUY TTC OR HT
print '				 <td width="10%">';
print '					<select id="selectTypePrice" name="selectTypePrice">';
print '						<option value="'.$langs->trans("TTC").'" selected>'.$langs->trans("TTC").'</option>';
print '						<option value="'.$langs->trans("HT").'">'.$langs->trans("HT").'</option> ';
print '					</select>';
print '				</td>';

// SOLD PRICE SUPPLIERS
print '				 <td width="10%">';
print '					<input name ="soldPriceSuppliers" class="inputNumber" type="number" placeholder="0" min="0" max="100" value="0" placeholder="'.$langs->trans("PlaceHolderSoldSupplier").'"/>';
print '				</td>';

// BUTTON SEND
print '				 <td width="5%">';
print '						<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'">';
print '						<input type="hidden" name="action" value="insertIntoMapping" />';
print '						<input type="submit" class="button" value="'.$langs->trans("add").'" />';
print '				</td>';
print '			</tr>';
print '	</form>';

// DISPLAY MAPPING
// get the all Mapping Table's data

$arrayTable = getTableMapping_stockcsv($instanceFourn,$instanceWareHouse);

if($arrayTable){

	foreach ($arrayTable as $ligne)
	{
		$rowidMapping 		= $ligne[0]; 
		$supplier 			= $ligne[1];
		$warehouse 			= $ligne[2];
		$repFTP				= $ligne[3];
		$maskCSV 			= $ligne[4];
		$idcategory 		= $ligne[5];
		$labelcategory 		= $ligne[6];
		$prefSupplier 		= $ligne[7];
		$typePrice 			= $ligne[8];
		$tva 				= $ligne[9];
		$discountSupplier 	= $ligne[10];
		$imgs_picto 		= $ligne[11]; 

		if($getpostAction == 'editMapping'.$rowidMapping)
		{
			$var=!$var;

			print '	<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';
			print '			<tr '.$bc[$var].' id="rowEdit" width="100%">';

			// SUPPLIER
			print '				 <td width="15%">';
			showTble($tblfourn,$dataFilterFourn,'supplier');
			print '				</td>';

			//WAREHOUSE
			print '				 <td width="10%">';
			showTble($tblwarehouse,$dataFilterWarehouse,'warehouse');
			print '				</td>';

			// PATH CSVs
			print '				<td align="center" width="10%">';
			print '					<select id="selectPath" name="selectPath">';
			print '						<option value="" selected></option>';

			foreach ($arrayDir as $dir)
			{
				// On garde seulement la fin du path pour une meilleure lisibilitée  +1 pour supprimer le slash
				$dir = substr($dir,strlen($pathFTP)+1);

				// On remplace les "\" par des "/"
				$dir = str_replace("\\","/",$dir); 

				// On affiche chaque repertoire / sous repertoire
				print '						<option value="'.$dir.'"';

				if ($dir == $repFTP){
					print " selected";
				}

				print '>'.$dir.'</option>';
			}

			print '					</select>';
			print '				</td>';

			// MASK
			print '				<td width="10%">';
			print '					<input size="10" type="text" placeholder="'.$langs->trans("PlaceHolderMask").'" name="mask" value="'.$maskCSV.'" />';
			print '				</td>';

			// CATEGORY
			print '				 <td align="center" width="10%">';
			print $htmlother->select_categories(0,$idcategory,'category',1);
			print '				 </td>';

			// PREFIX SUPPLIER
			print '				<td width="10%">';
			print '					<input size="8" type="text" placeholder="'.$langs->trans("PlaceHolderPrefix").'" name="prefSupplier" value="'.$prefSupplier.'"  maxlength="6" />';
			print '				</td>';

			//TVA
			print '				<td width="10%">';
			print '					<input size="4" name ="tva" class="text" type="text" value="'.$tva.'" placeholder="'.$langs->trans("Tva").'"/>';
			print '				</td>';

			//TYPE PRICEstyle=" width: 20%;"
			print '				<td width="10%">';
			print '					<select id="selectTypePrice" name="selectTypePrice">';
			print '						<option value="'.$langs->trans("TTC").'"';

			if ( $typePrice == $langs->trans("TTC")){
				print ' selected';
			}

			print '>'.$langs->trans("TTC").'</option>';
			print '			<option value="'.$langs->trans("HT").'"';

			if ( $typePrice == $langs->trans("HT")){
				print ' selected';
			}

			print '>'.$langs->trans("HT").'</option> ';
			print '					</select>';
			print '				</td>';

			// DISCOUNT
			print '				<td width="10%">';
			print '					<input name="soldPriceSuppliers" class="inputNumber" type="number" min="0" max="100" value="'.$discountSupplier.'"/>';
			print '				</td>';

			//BUTTON UPDATE
			print '				<td width="5%">';
			print '					<input type="hidden" name="rowidMapping" value="'.$rowidMapping.'" />';
			print '					<input type="hidden" name="action" value="updateMapping" />';
			print '					<input type="submit" class="button" value="'.$langs->trans("update").'" />';
			print '				</td>';
			print '			</tr>';
			print '	</form>';
		}

		else if($getpostAction == 'deleteMapping'.$rowidMapping)
		{
			deleteRowMapping_stockcsv($rowidMapping,$dataFilterFourn);
		}

		else
		{
			$var=!$var;

			print '<tr '.$bc[$var].'>';
			affichageLigneMapping($supplier,$warehouse,$repFTP,$maskCSV,$labelcategory,$prefSupplier,$tva,$typePrice,$discountSupplier,$imgs_picto);
			print '</tr>';	
		}
	}
}

print '</table>';
print '</div>';

// SECTION VACANCES
print '	<div class="section">';
print '		<label>'.$langs->trans("VacancesPartenaires").'</label>';
print '			<table class="noborder" width="100%">';
print '				<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';
print '						<tr class="liste_titre">';
print '							<td width="35%">'.$langs->trans("Suppliers").'</td>';
print '							<td width="20%">'.$langs->trans("DateStart").'</td>';
print '							<td width="20%">'.$langs->trans("DateEnd").'</td>';
print '							<td width="20%">'.$langs->trans("Reason").'</td>';
print '							<td width="5%"></td>';
print '						</tr>';

$var=!$var;

print '						<tr '.$bc[$var].'>';

// SUPPLIER
$tblSupplierMapping 	= getFournTableMapping();
print '				 <td>';
showTble($tblSupplierMapping,-1,'SupplierMapping');
print '				 </td>';

// DATE START
print '							<td>';
									$form->select_date($object->date_vacancesdebut?$object->date_vacancesdebut:-1,
									'dateAvailableStart',
									0,
									0,
									0,
									'',
									1,
									1);
print '							</td>';

// DATE END
print '							<td>';
									$form->select_date($object->date_vacancesfin?$object->date_vacancesfin:-1,
									'dateAvailableEnd',
									0,
									0,
									0,
									'',
									1,
									1);
print '							</td>';

// REASON
print '							<td>';
print '							<input type="text" name="reason" value="" />';
print 							$form->textwithpicto("",$langs->trans("TextHelpReason"),1,'help','');
print '							</td>';

// BUTTON SEND
print '							<td>';
print '								<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'">';
print '								<input type="hidden" name="action" value="insertIntoUnavailable" />';
print '								<input type="submit" class="button" value="'.$langs->trans('Save').'">';
print '							</td>';
print '						</tr>';
print '				</form>';
print '			</table>';

// DISPLAY HOLIDAYS
print '			<table class="noborder" width="100%">';

// get the all unavailable Table's data
$tableFournUnavailable = getTablefourn_unavailable();

if($tableFournUnavailable ){
	// for each occurences (lignes) in the table

	foreach ($tableFournUnavailable  as $ligneUnavailable )
	{
		// for each lignes
		$rowidUnavailable 			= $ligneUnavailable [0]; 
		$supplierUnavailable 		= $ligneUnavailable [1];
		$UpdatedateAvailableStart 	= $ligneUnavailable [2]; 
		$UpdatedateAvailableEnd 	= $ligneUnavailable [3];
		$dataReason					= $ligneUnavailable [4];
		$imgs_pictoUnavailable 		= $ligneUnavailable [5]; 
		$idSupplierUnavailable = getRowIdSupplier($supplierUnavailable);

		if($getpostAction == 'editFieldsUnavailable'.$rowidUnavailable)
		{
			$var=!$var;

			print '	<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';
			print '			<tr '.$bc[$var].' id="rowEdit">';

			// SUPPLIER
			print '				 <td width="35%">';
			showTble2($tblSupplierMapping,$supplierUnavailable,'SupplierMapping');
			print '				 </td>';

			// DATE START
			print '				<td width="20%">';
			$form->select_date($UpdatedateAvailableStart,'UpdatedateAvailableStart',0,0,0,'',1,1);
			print '				</td>';

			// DATE END
			print '				<td width="20%">';
			$form->select_date($UpdatedateAvailableEnd,'UpdatedateAvailableEnd',0,0,0,'',1,1);
			print '				</td>';	

			// REASON
			print '				<td width="20%">';
			print '					<input type="text" placeholder="'.$langs->trans("Reason").'" name="reason" value="'.$dataReason.'" />';
			print '				</td>';

			// BUTTON UPDATE
			print '				<td width="5%">';
			print '					<input type="hidden" name="rowidUnavailable" value="'.$rowidUnavailable.'" />';
			print '					<input type="hidden" name="action" value="UpdateUnavailable" />';
			print '					<input type="submit" class="button" value="'.$langs->trans("update").'" />';
			print '				</td>';
			print '			</tr>';
			print '	</form>';

		}

		else if($getpostAction == 'deleteFieldsUnavailable'.$rowidUnavailable)
		{
			deleteRowfourn_unavailable($rowidUnavailable);
		}

		else
		{
			$var=!$var;

			print '<tr '.$bc[$var].'>';

			if(supplierFromTableMappingIsInTableUnavailable($idSupplierUnavailable)){
				affichageLigneUnavailable($supplierUnavailable,$UpdatedateAvailableStart,$UpdatedateAvailableEnd,$imgs_pictoUnavailable,$dataReason);
			}

			else
			{
				deleteRowfourn_unavailable($rowidUnavailable);
			}

			print '</tr>';
		}
	}
}

print '			</table>';
print '		</div>';

// TERMS TO EXCLUDE
print '	<div class="section">';
print '		<label>'.$langs->trans("LabelTerms").'</label>';

$var=false;

print '			<table class="noborder" width="100%">';
print '				<form method="POST" action="'.$_SERVER['PHP_SELF'].'" enctype="multipart/form-data">';
print '					<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'">';
print '					<input type="hidden" name="action" value="addTerms">';

// ASST ASSORT ASSORTIS asst assort assortis ASSNO ASSNO. DISPLAY ASSOT
$var=!$var;

print '					<tr '.$bc[$var].'>';
print '						<td width=25%>'.$form->textwithpicto($langs->trans("Terms"),$langs->trans("TextHelpTerms"),1,'help','').'</td>';

// DIV TOOLTIP WITH LIST TERMS
$listTerms=array();
$listTerms=getTableTermsExclude();
//print $listTerms[0];
$detail="";
foreach($listTerms as $a)
{
 	$detail.=$a."<br/>";
}
//$listTerms="Test Termes";
print $sql;
print '<td><img title="'.$detail.'" class="classfortooltip listTerms" src="../img/eye.png" /></td>';

// SEARCH PART

print '						<td>';
print '							<input type="search" name="addTermExclude" value="'.$dataTermsExclude.'" />';
print '						</td>';

// BUTTON SEND

print '						<td>';
print '							<input type="submit" class="button" value="'.$langs->trans("Save").'">';
print '						</td>';
print '					</tr>';

if($getpostAction == 'addTerms'){

	if(TermExistTableTermsExclude($dataTermsExclude)){ // il existe dans la table Terms exclude

		//DISPLAY RESULT
		print '			<tr>';
		print '				<td>';
		print 					$dataTermsExclude;
		print '				</td>';

		// BUTTON DELETE
		print '				<td>';
		print '					<a href="'.$_SERVER['PHP_SELF'].'?action=deleteTerm'.$dataRowIdTerm.'&amp;deleteTerm='.$dataRowIdTerm.'" class="classfortooltip" title="'.$langs->trans("Delete").'">'.img_picto('','delete','class="imgactions"').'</a>';
		print '				</td>';
		print '			</tr>';
	}

	else
	{
		insertTermExclude($dataTermsExclude);
	}
}

print '			</form>';
print '		</table>';
print '	</div>';

// LIST EAN TO EXCLUDE
print '	<div class="section">';
print '		<label>'.$langs->trans("LabelEAN").'</label>';

$var=false;

print '		<table class="noborder" width="100%">';
print '			<form method="POST" action="'.$_SERVER['PHP_SELF'].'#saveEAN" enctype="multipart/form-data">';
print '				<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'">';
print '				<input type="hidden" name="action" value="addEAN">';

$var=!$var;

print '					<tr '.$bc[$var].'>';
print '						<td width=25%>'.$form->textwithpicto($langs->trans("EAN"),$langs->trans("TextHelpEANS"),1,'help','').'</td>';

// SEARCH RESULT
$listEans=array();
$listEans=getTableEANExclude();

$detail="";
foreach($listEans as $b)
{
 	$detail.=$b.'<br/>';
}

print '						<td>';
print '							<img title="'.$detail.'" class="classfortooltip EanExclude" src="../img/eye.png" />';
print '						</td>';
print '						<td>';
print '							<input type="search" id="EANExclude" name="EANExclude" value="" />';
print '						</td>';
print '						<td>';
print '							<textarea id="TextAreaEANExclude" name="TextAreaEANExclude" rows="19" cols="14" value="'.$dataTextAreaEANExclude.'">';
print '							</textarea>';
print '						</td>';

// BUTTON SEND
print '						<td>';
print '							<input type="submit" class="button" value="'.$langs->trans("Save").'">';
print '						</td>';
print '					</tr>';

if($getpostAction == 'addEAN'){

	if($dataEANExclude){
		if(EANExistTableProduct($dataEANExclude)){ // il existe dans la table product

			// DISPLAY RESULT
			$product = initProduct($instanceProduct,$dataEANExclude);
			print '			<tr '.$bc[$var].' >';
			print '				<td>';
			print 					$product->getNomUrl();
			print '				</td>';

			// DISPLAY EAN
			print '			<td>';
			print 				$dataEANExclude;
			print '			</td>';

			if(EANExistTableEANExclude($dataEANExclude)){ // il existe dans la table EAN exclude

				//DISPLAY BUTTON DELETE
				print '			<td>';
				print '				<a href="'.$_SERVER['PHP_SELF'].'?action=deleteEAN&amp;deleteEAN='.$dataRowIdEANExclude.'" class="classfortooltip" title="'.$langs->trans("Delete").'">'.img_picto('','delete','class="imgactions"').'</a>';			
				print '			</td>';
			}

			else
			{	// il n'existe pas dans la table EAN exclude
				// DISPLAY BUTTON SAVE
				print '			<td>';
				print '				<a id="saveEAN" href="'.$_SERVER['PHP_SELF'].'?action=saveEAN&amp;saveEAN='.$dataEANExclude.'" class="classfortooltip button" title="'.$langs->trans("Save").'"><img src="../img/save.png" /></a>';	
				print '			</td>';
			}
		}

		else
		{
			// DISPLAY EAN
			print '			<td>';
			print 				$dataEANExclude;
			print '			</td>';

			if(EANExistTableEANExclude($dataEANExclude)){ // il existe dans la table EAN exclude
				//DISPLAY BUTTON DELETE
				print '			<td>';
				print '				<a href="'.$_SERVER['PHP_SELF'].'?action=deleteEAN&amp;deleteEAN='.$dataRowIdEANExclude.'" class="classfortooltip" title="'.$langs->trans("Delete").'">'.img_picto('','delete','class="imgactions"').'</a>';			
				print '			</td>';
			}

			else
			{	// il n'existe pas dans la table EAN exclude
				// DISPLAY BUTTON SAVE
				print '			<td>';
				print '				<a id="saveEAN" href="'.$_SERVER['PHP_SELF'].'?action=saveEAN&amp;saveEAN='.$dataEANExclude.'" class="classfortooltip button" title="'.$langs->trans("Save").'"><img src="../img/save.png" /></a>';	
				print '			</td>';
			}

		}

		print '				<td>';
		print '				</td>';
		print '				<td>';
		print '				</td>';
		print '			</tr>';
	}

	if($dataTextAreaEANExclude)

	{

		$dataTextAreaEANExclude = str_replace(array("\"", "\"\"","\n","\r\n","\r"), "",$dataTextAreaEANExclude);
		$ListEans = explode(";", $dataTextAreaEANExclude);

		print '				<tr '.$bc[$var].' >';
		print '				<td >';
		print 					$langs->trans("ListEanEnter");
		print '				</td>';
		print '				<td>';

		foreach($ListEans as $ean)
		{
			if($ean)
			{
					print $ean;
					print '<br/>';
			}
		}

		print '				</td>';
		print '				<td >';
		print '				</td>';
		print '			<td>';
		print '				<a href="'.$_SERVER['PHP_SELF'].'?action=saveTextAreaEAN&amp;saveTextAreaEAN='.$dataTextAreaEANExclude.'" class="classfortooltip button" title="'.$langs->trans("Save").'"><img src="../img/save.png" /></a>';	
		print '			</td>';
		print ' 		</tr>';
	}
}

print '			</form>';
print '		</table>';
print '	</div>';

// OTHERS PARAMS
print '	<div class="section">';
print '		<label>'.$langs->trans("LabelParamOthers").'</label>';

$var=false;

print '		<table class="noborder" width="100%">';
print '			<form method="POST" action="'.$_SERVER['PHP_SELF'].'" enctype="multipart/form-data">';
print '				<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'">';
print '				<input type="hidden" name="action" value="updateCoefMarge">';

// COEF MARGIN
$var=!$var;

print '					<tr '.$bc[$var].'>';
print '						<td width="56%">'.$langs->trans("Coef").'</td>';
print '						<td width="20%">';
print '							<input step="0.1" name="STOCKCSV_COEF" type="number" min="0" value="'.$coefMarge.'" />';
print '						</td>';
print '						<td  style="text-align:center" >';
print '							<input type="submit" class="button" value="'.$langs->trans("Save").'">';
print 						$form->textwithpicto("",$langs->trans("TextHelpCoef"),1,'warning','');
print '						</td>';
print '					</tr>';
print '			</form>';
print '		</table>';

// LOW COAST TO BUY PRICE
print '		<table class="noborder" width="100%">';
print '			<form method="POST" action="'.$_SERVER['PHP_SELF'].'" enctype="multipart/form-data">';
print '				<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'">';
print '				<input type="hidden" name="action" value="updateConstante">';

$var=!$var;

print '					<tr '.$bc[$var].'>';
print '						<td width="56%">'.$langs->trans("PriceAchatLow").'</td>';
print '						<td width="20%">';
print '							<input name="STOCKCSV_LOW_PRICE" type="number" min="0" value="'.$priceLowHT.'"/> '.$conf->currency;
print '						</td>';

// BUTTON SAVE
print '						<td style="text-align:center" rowspan="7">';
print '							<input type="submit" class="button" value="'.$langs->trans("Save").'">';
print '						</td>';
print '					</tr>';

// ERROR EAN
$var=!$var;

print '					<tr '.$bc[$var].'>';
print '						<td>'.$langs->trans("ErrorEAN").'</td>';
print '						<td >';
print 							$form->selectyesno('STOCKCSV_ERROREAN', $excludeProductError, 1,false, 0);
print '						</td>';
print '					</tr>';

// Value Update Product Sell Min
$var=!$var;

print '					<tr '.$bc[$var].'>';
print '						<td>'.$langs->trans("UpdateProductSellPriceMinTo10").'</td>';
print '						<td>';
print '							<input name="SELL_PRICE_MIN_TO_10" type="number" min="0" value="'.$sellPriceMinTo10.'"/> '.$conf->currency;
print '						</td>';
print '					</tr>';

// NB DAYS TO EXCLUDE
$var=!$var;

print '					<tr '.$bc[$var].'>';
print '						<td>'.$langs->trans("NBDAYS").'</td>';
print '						<td>';
print '							<input name="STOCKCSV_NBDAYS"  type="number" min="0" value="'.$nbDayBeforeDelete.'"/>';
print '							</td>';
print '					</tr>';

// CSV NOT PRESENT
$var=!$var;

print '					<tr '.$bc[$var].'>';
print '						<td>'.$langs->trans("CSVnotPresent").'</td>';
print '						<td >';
print 							$form->selectyesno('STOCKCSV_CSVNOTPRESENT', $emptyStockPartner, 1, false, 0);
print '						</td>';

// Email Robot
$var=!$var;

print '					<tr '.$bc[$var].'>';
print '						<td>'.$langs->trans("UserRobot").'</td>';
print '						<td>';
print 							$form->select_users($robotMailUser,"STOCKCSV_MAILUSER");
print '						</td>';
print '					</tr>';

// Entrepot des commandes en cours
$var=!$var;

print '					<tr '.$bc[$var].'>';
print '					<td>'.$form->textwithpicto($langs->trans("WarehousePendingOrders"),$langs->trans("TextHelpWarehousePendingOrders"),1,'help','').'</td>';
print '						<td>';
 							showTble($tblwarehouse,$warehousePendingOrders,'WAREHOURS_PENDING_ORDERS',0);
print '						</td>';
print '					</tr>';
print '				</form>';
print '			</table>';
print '		</div>';

$endDuration = microtime(true);

$duration = $endDuration - $startDuration;

//echo 'Exécution du script : ' . $duration . ' <br/>';

llxFooter();

$db->close();