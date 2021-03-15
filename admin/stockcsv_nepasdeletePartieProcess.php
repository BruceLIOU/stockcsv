<?php
$fourn = array(
	'CAHORS',
	'FOIX',
	'LATOUR',
	'REVEL',
	'LAVELANET',
	'SAVENAY',
	'PAMIERS',
	'MONTAUBAN',
	'FARANDOLE'
	);

$var=false;

// Views
$traitement_fourn = 1;
$process='70%';

print '<div class="div-process" align="center">';
print '<button class="button button-process">Lancer le traitement</button>';
print '</div>';

// S'AFFICHE LORSQU'ON CLICQUE SUR LE BUTTON
print '<div class="div-progressbar" align="center">';
print '<div class="progress" align="center">';
print '<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:70%">';
print $process;
print '</div>';
print '</div>';
print '</div>';

// S'AFFICHE LORSQUE LE PROCESS EST TERMINÉ
print '<table class="noborder" style="width:100%">';
print '		<tr class="liste_titre">';
print '			<td width="20%" align="left">'.$langs->trans("Suppliers").'</td>';
print '			<td width="20%" align="center">'.$langs->trans("States").'</td>';
print '			<td width="20%" align="center">'.$langs->trans("MajProducts").'</td>';
print '			<td width="20%" align="center">'.$langs->trans("CreateProducts").'</td>';
print '			<td width="20%" align="center">'.$langs->trans("ErrorProducts").'</td>';
print '		</tr>';
print '	<tbody>';

foreach($fourn as $fournitem)
{
	$var=!$var;
	print '<tr '.$bc[$var].'>';
	print '<td align="left">'.$fournitem.'</td>';
	print '<td align="center">';

	if ($traitement_fourn == 1)
	{
		print '<img src="../img/state-ok.png">';
	}
	else
	{
		print '<img src="../img/state-nok.png">';
	}

print'</td>';
print '			<td align="center">3500</td>';
print '			<td align="center">150</td>';
print '			<td align="center">458</td>';
}

print '		</tr>';
print '	</tbody>';
print '</table>';