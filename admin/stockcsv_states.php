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

//date_default_timezone_set('Europe/Paris');

// Libraries

require_once DOL_DOCUMENT_ROOT.'/fourn/class/fournisseur.class.php';
require_once DOL_DOCUMENT_ROOT.'/product/stock/class/entrepot.class.php';
require_once DOL_DOCUMENT_ROOT.'/core/class/html.formother.class.php';
require_once DOL_DOCUMENT_ROOT . "/core/lib/admin.lib.php";
require_once '../lib/stockcsvStates.lib.php';

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

$page_name = "States";

llxHeader('', $langs->trans($page_name));

// Subheader
$linkback = '<a href="' . DOL_URL_ROOT . '/admin/modules.php">'
    . $langs->trans("BackToModuleList") . '</a>';
print_fiche_titre($langs->trans($page_name), $linkback);

// Configuration header
$head = stockcsvAdminPrepareHead();
dol_fiche_head(
    $head,
    'states',
    $langs->trans("Module100000Name"),
    0,
    'stockcsv@stockcsv'
);

$nbJourAffichage = 7;

$arrayStateSupp = array();

$instanceFourn = new ProductFournisseur($db);

$instanceWareHouse = new Entrepot($db);

$arrayTableMapping = getTableMapping_stockcsv($instanceFourn,$instanceWareHouse);

// Parcourir le tableau creer via la table mapping

$supplier = 1;

date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, 'fr_FR.utf8','fra');

$jourAffichage = new DateTime("now");

$jourState = new DateTime("now");

$intl_date_formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::NONE);

$var=false;


// Views
print '<table class="noborder stockcsv" width="100%">';
print '<tbody>';
print '<tr class="liste_titre">';
print '<td align="left" width="22%">'.$langs->trans("Suppliers").'</td>';

for ($i = 0; $i < $nbJourAffichage ; $i++)
{
		print '<td width="auto" align="center">'.$intl_date_formatter->format($jourAffichage).'</td>';

		$jourAffichage->modify('-1 day');
}

print '</tr>';

foreach ($arrayTableMapping as $rowMapping)
{
	$var=!$var;

	print '<tr '.$bc[$var].'>';

	if($rowMapping)
	{
		print '<td>';
		print $rowMapping[$supplier];
		print '</td>';

		for ($i = 0; $i < $nbJourAffichage ; $i++)
		{
			print '<td align = "center">';
			//print $form->textwithtooltip('<span >'.$langs->trans("manuel").'</span>',"tooltype",3,-1,'<img src="../img/state-ok.png">','process');
			print getImgState($rowMapping,$jourState);
			print '</td>';
			$jourState->modify('-1 day');
		}

		print '</td>';

		$jourState->modify('+7 day');
	}

	print '</tr>';
}

dol_fiche_end();

llxFooter();

$db->close();