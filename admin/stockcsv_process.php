<?php

//ini_set('max_execution_time', 120);

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
 * 	\file		admin/about.php
 * 	\ingroup	stockcsv
 * 	\brief		This file is an example about page
 * 				Put some comments here
 */

// Dolibarr environment
$res = @include("../../main.inc.php"); // From htdocs directory

if (! $res) {
    $res = @include("../../../main.inc.php"); // From "custom" directory
}

// Libraries
require_once '../lib/stockcsvStates.lib.php';
require_once DOL_DOCUMENT_ROOT . "/core/lib/admin.lib.php";
require_once '../lib/stockcsvProcess.lib.php';
require_once DOL_DOCUMENT_ROOT . "/core/class/CMailFile.class.php";
require_once DOL_DOCUMENT_ROOT.'/core/class/html.form.class.php';
require_once DOL_DOCUMENT_ROOT.'/fourn/class/fournisseur.class.php';
require_once DOL_DOCUMENT_ROOT.'/product/stock/class/entrepot.class.php';
require_once DOL_DOCUMENT_ROOT.'/user/class/user.class.php';

global $langs;

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

$page_name = "Process";


llxHeader('', $langs->trans($page_name));

// Subheader
$linkback = '<a href="' . DOL_URL_ROOT . '/admin/modules.php">'

    . $langs->trans("BackToModuleList") . '</a>';

print_fiche_titre($langs->trans($page_name), $linkback);

// Configuration header
$head = stockcsvAdminPrepareHead();

dol_fiche_head(

    $head,

    'process',

    $langs->trans("Module100000Name"),

    0,

    'stockcsv@stockcsv'

);



$form 					= new Form($db);
$instanceFourn 			= new ProductFournisseur($db);
$instanceWareHouse 		= new Entrepot($db);
$instanceUser           = new User($db);

$arrayTableMapping = getTableMapping_stockcsv($instanceFourn,$instanceWareHouse);

// Parcourir le tableau creer via la table mapping
$supplier           = 1;
$idSupplier         = 12;

// Parcourir le tableau creer via la table state
$idFromState                 = 0;
$supplierFromState           = 1;
$stateFromState              = 2;
$processFromState            = 3;
$detailsFromState            = 4;
$dateFromState               = 5;
$productCreateFromState      = 6;
$productUpdateFromState      = 7;
$productErrorFromState       = 8;
$idUserFromState             = 9;
$hoursUpdateFromState        = 10;
$duration                    = 11;

//$pathficToSend ='../log/BacASable.log';
/* DEBUT MAJ 21/01/2020 => condition horaire */
$heurefinstock = "1330";

if (date("Hi") < $heurefinstock)
{
	$jourState2    = new DateTime("now");
}
else
{
	$jourState2    = new DateTime("now + 1 day");
}
/* FIN MAJ 21/01/2020 */

$jourState  = new DateTime("now");

$dataidSupplier = GETPOST('idSupplier','int');

$getpostAction  = GETPOST('action', 'alpha');
/*$confirm			= GETPOST('action', 'alpha');
if ($action == 'validate')
	{
		$text = $langs->trans('ConfirmLaunchAll');
		print $form->formconfirm($_SERVER["PHP_SELF"], $langs->trans('ValidateLaunchAll'), $text, 'confirm_validate', "", 0, 1, 220);
	}
*/
/*
print '<table width="100%">';
print '		<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';
print '			    <tr align="center">';
print '                 <td align="center">';
print '					    <input type="hidden" name="action" value="ProcessAutomatique" />';
print '                     <input type="submit" class="button button-process" value="'.$langs->trans('LaunchAll').'">';
//print '						<a class="button button-process" href="' . $_SERVER["PHP_SELF"] . '?action=validate">' . $langs->trans('LaunchAll') . '</a>';
print '                 </td>';
print '			    </tr>';
print '	    </form >';
print '</table>';
*/
// MAPPING DOLIBARR
print '<div class="section">';
//print '<label>'.$langs->trans("LabelMappingDoli").'</label>';
print '<table class="noborder" width="100%">';
print '<tbody>';
print '<tr class="liste_titre">';
print '<td width="20%">'.$langs->trans("suppliers").'</td>';
print '<td width="1%" align="center">'.$langs->trans("FileExist").'</td>';
print '<td width="1%" align="center">'.$langs->trans("FileStockExist").'</td>';
print '<td width="1%" align="center" colspan="2">'.$langs->trans("FileActions").'</td>';
//print '<td width="1%"></td>';
print '<td width="1%" align="center">'.$langs->trans("state").'</td>';
print '<td width="8%" align="center">'.$langs->trans("pdtcreate").'</td>';
print '<td width="8%" align="center">'.$langs->trans("pdtupdate").'</td>';
print '<td width="8%" align="center">'.$langs->trans("pdterror").'</td>';
print '<td width="8%" align="center">'.$langs->trans("timeProcess").'</td>';
print '<td width="8%" align="center">'.$langs->trans("durationProcess").'</td>';
print '<td width="14%" align="right">'.$langs->trans("Doneby").'</td>';
print '</tr>';

//if ($action == 'confirm_validate' && $confirm == 'yes' && $getpostAction == 'ProcessAutomatique'){
if ($getpostAction == 'ProcessAutomatique'){
    getCSVMappingAutomatique($user);
}

if ($getpostAction == 'ProcessManuel'.$dataidSupplier){
    getCSVMappingManuel($dataidSupplier,$user);
}

if ($getpostAction == 'prepareFileManuel'.$dataidSupplier){
    prepareFileManuel($dataidSupplier,$user);
}

print '	<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';

foreach ($arrayTableMapping as $rowMapping)
{
    if($rowMapping){
        $dataSupplierState = getStateSuppliers($rowMapping[$idSupplier],$jourState);

        $var=!$var;
/*
        print '<script>
		$(document).ready( function() {
		  $("img#state-ok").each(function(){
			$(this).closest("tr").find("#prepare").hide();  
		  });
		});
        </script>';
*/		
        print '<tr class="oddeven">';
		print '<td>';
		print $rowMapping[$supplier];
		print '</td >';
        print '<td class="stock_action">';
        print getFileStockCSVHere($rowMapping,$jourState2);
        print '</td>';
        print '<td class="">';
        print getFileStockHere($rowMapping[$idSupplier]);
        print '</td>';
		print '<td class="img_process stock_action">';
		$idFourn = array("38","1250", "2", "4", "75", "9786", "9830");
		if (in_array($rowMapping[$idSupplier], $idFourn))
		{
			print '<a id="prepare" href="'.$_SERVER['PHP_SELF'].'?action=prepareFileManuel'.$rowMapping[$idSupplier].'&amp;idSupplier='.$rowMapping[$idSupplier].'" class="classfortooltip" title="'.$langs->trans("PrepareFile").'">'.img_picto('','prepare.png@stockcsv','').'</a>';
		}
        print '</td>';
        print '<td class="img_process stock_action">';
		print '<a href="'.$_SERVER['PHP_SELF'].'?action=ProcessManuel'.$rowMapping[$idSupplier].'&amp;idSupplier='.$rowMapping[$idSupplier].'" class="classfortooltip" title="'.$langs->trans("TraitementManuel").'">'.img_picto('','process.png@stockcsv','class="imgactions"').'</a>';
        print '</td>';
        print '<td class="stock_action-last">';
        print getImgState($rowMapping,$jourState);
        print '</td>';
        print '<td align="center">'.$dataSupplierState[$productCreateFromState].'</td>';
        print '<td align="center">'.$dataSupplierState[$productUpdateFromState].'</td>';
        print '<td align="center">'.$dataSupplierState[$productErrorFromState].'</td>';
        print '<td align="center">'.$dataSupplierState[$hoursUpdateFromState].'</td>';
        print '<td align="center">'.mediaTimeDeFormater($dataSupplierState[$duration]).'</td>';
        //print '				<td>'.$dataSupplierState[$duration].'</td>';
        //$duree_bruce = new DateTime();
        //$duree_bruce=$dataSupplierState[$duration];
        //print 					'<td>'.date("H:i:s",$duree_bruce).'</td>';    

        $instanceUser->fetch($dataSupplierState[$idUserFromState]);

        print '<td align="right">'.$instanceUser->getNomUrl().'</td>';
        print '</tr>';

        $totalproductCreateFromState+=$dataSupplierState[$productCreateFromState];
        $totalproductUpdateFromState+=$dataSupplierState[$productUpdateFromState];
        $totalproductErrorFromState+=$dataSupplierState[$productErrorFromState];
        $totalduration+=$dataSupplierState[$duration];
	}
}

print '<tr class="liste_total">';
print '<td>'.$langs->trans("TotalProcessManuel").'</td>';
print '<td></td>';
print '<td></td>';
print '<td></td>';
print '<td></td>';
print '<td></td>';
print '<td align="center">';
print $totalproductCreateFromState;
print '</td>';
print '<td align="center">';
print $totalproductUpdateFromState;
print '</td>';
print '<td align="center">';
print $totalproductErrorFromState;
print '</td>';
print '<td></td>';
print '<td align="center">';
print mediaTimeDeFormater($totalduration);
print '</td>';
print '<td></td>';
print '</tr>';
print '</form >';
print '</tbody>';
print '</table >';

dol_fiche_end();

llxFooter();

$db->close();