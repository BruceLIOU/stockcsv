<?php

/*
 * Actions
 */
if($action=='setmapdoli') {
	$res = dolibarr_set_const($db, 'STOCKCSV_MAP_SUPPLIER', GETPOST('STOCKCSV_MAP_SUPPLIER'),'chaine',0,'',$conf->entity);
	if (! $res > 0) $error++;
	$res = dolibarr_set_const($db, 'STOCKCSV_MAP_WAREHOUSE', GETPOST('STOCKCSV_MAP_WAREHOUSE'),'chaine',0,'',$conf->entity);
	if (! $res > 0) $error++;
	$res = dolibarr_set_const($db, 'STOCKCSV_MAP_FOLDER_FTP', GETPOST('STOCKCSV_MAP_FOLDER_FTP'),'chaine',0,'',$conf->entity);
	if (! $res > 0) $error++;
	$res = dolibarr_set_const($db, 'STOCKCSV_MAPOTHER_MASK', GETPOST('STOCKCSV_MAPOTHER_MASK'),'chaine',0,'',$conf->entity);
	if (! $res > 0) $error++;
	$res = dolibarr_set_const($db, 'STOCKCSV_MAP_CATEGORY', GETPOST('STOCKCSV_MAP_CATEGORY'),'chaine',0,'',$conf->entity);
	if (! $res > 0) $error++;
	$res = dolibarr_set_const($db, 'STOCKCSV_PREFIX_SUPPLIER', GETPOST('STOCKCSV_PREFIX_SUPPLIER'),'chaine',0,'',$conf->entity);
	if (! $res > 0) $error++;
	$res = dolibarr_set_const($db, 'STOCKCSV_SOLD_SUPPLIER', GETPOST('STOCKCSV_SOLD_SUPPLIER'),'chaine',0,'',$conf->entity);
	if (! $res > 0) $error++;
    if (! $error)
    {
        $db->commit();
        //$mesg = "<font class=\"ok\">".$langs->trans("SetupSaved")."</font>";
        setEventMessage($langs->trans("SetupSaved"));
    }
    else
    {
        $db->rollback();
        //$mesg = "<font class=\"error\">".$langs->trans("Error")."</font>";
        setEventMessage($langs->trans("Error"),'errors');
    }
}

if($action=='setmapcateg') {
	$res = dolibarr_set_const($db, 'STOCKCSV_MAPOTHER_CATEGORY_DOLI', GETPOST('STOCKCSV_MAPOTHER_CATEGORY_DOLI'),'chaine',0,'',$conf->entity);
	if (! $res > 0) $error++;
	$res = dolibarr_set_const($db, 'STOCKCSV_MAPOTHER_CATEGORY_PRESTA', GETPOST('STOCKCSV_MAPOTHER_CATEGORY_PRESTA'),'chaine',0,'',$conf->entity);
	if (! $res > 0) $error++;
    if (! $error)
    {
        $db->commit();
        //$mesg = "<font class=\"ok\">".$langs->trans("SetupSaved")."</font>";
        setEventMessage($langs->trans("SetupSaved"));
    }
    else
    {
        $db->rollback();
        //$mesg = "<font class=\"error\">".$langs->trans("Error")."</font>";
        setEventMessage($langs->trans("Error"),'errors');
    }
}

if($action=='setterms') {
	$res = dolibarr_set_const($db, 'STOCKCSV_TERMS', GETPOST('STOCKCSV_TERMS'),'chaine',0,'',$conf->entity);
	if (! $res > 0) $error++;

    if (! $error)
    {
        $db->commit();
        //$mesg = "<font class=\"ok\">".$langs->trans("SetupSaved")."</font>";
        setEventMessage($langs->trans("SetupSaved"));
    }
    else
    {
        $db->rollback();
        //$mesg = "<font class=\"error\">".$langs->trans("Error")."</font>";
        setEventMessage($langs->trans("Error"),'errors');
    }
}

if($action=='setsku') {
	$res = dolibarr_set_const($db, 'STOCKCSV_SKU', GETPOST('STOCKCSV_SKU'),'chaine',0,'',$conf->entity);
	if (! $res > 0) $error++;

    if (! $error)
    {
        $db->commit();
        //$mesg = "<font class=\"ok\">".$langs->trans("SetupSaved")."</font>";
        setEventMessage($langs->trans("SetupSaved"));
    }
    else
    {
        $db->rollback();
        //$mesg = "<font class=\"error\">".$langs->trans("Error")."</font>";
        setEventMessage($langs->trans("Error"),'errors');
    }
}

if($action=='setparam') {
	$res = dolibarr_set_const($db, 'STOCKCSV_COEF', GETPOST('STOCKCSV_COEF'),'chaine',0,'',$conf->entity);
	if (! $res > 0) $error++;
	$res = dolibarr_set_const($db, 'STOCKCSV_STOCK_TAMPON', GETPOST('STOCKCSV_STOCK_TAMPON'),'chaine',0,'',$conf->entity);
	if (! $res > 0) $error++;
	$res = dolibarr_set_const($db, 'STOCKCSV_DECREM', GETPOST('STOCKCSV_DECREM'),'chaine',0,'',$conf->entity);
	if (! $res > 0) $error++;
	$res = dolibarr_set_const($db, 'STOCKCSV_LOW_PRICE', GETPOST('STOCKCSV_LOW_PRICE'),'chaine',0,'',$conf->entity);
	if (! $res > 0) $error++;
	$res = dolibarr_set_const($db, 'STOCKCSV_ERRORSKU', GETPOST('STOCKCSV_ERRORSKU'),'chaine',0,'',$conf->entity);
	if (! $res > 0) $error++;
	$res = dolibarr_set_const($db, 'STOCKCSV_NBDAYS', GETPOST('STOCKCSV_NBDAYS'),'chaine',0,'',$conf->entity);
	if (! $res > 0) $error++;
	$res = dolibarr_set_const($db, 'STOCKCSV_CSVNOTPRESENT', GETPOST('STOCKCSV_CSVNOTPRESENT'),'chaine',0,'',$conf->entity);
	if (! $res > 0) $error++;
    if (! $error)
    {
        $db->commit();
        //$mesg = "<font class=\"ok\">".$langs->trans("SetupSaved")."</font>";
        setEventMessage($langs->trans("SetupSaved"));
    }
    else
    {
        $db->rollback();
        //$mesg = "<font class=\"error\">".$langs->trans("Error")."</font>";
        setEventMessage($langs->trans("Error"),'errors');
    }
}

if($action=='setpsbdd') {
	$res = dolibarr_set_const($db, 'STOCKCSV_PS_SERVER', GETPOST('STOCKCSV_PS_SERVER'),'chaine',0,'',$conf->entity);
	if (! $res > 0) $error++;
	$res = dolibarr_set_const($db, 'STOCKCSV_PS_PORT', GETPOST('STOCKCSV_PS_PORT'),'chaine',0,'',$conf->entity);
	if (! $res > 0) $error++;
	$res = dolibarr_set_const($db, 'STOCKCSV_PS_LOGIN', GETPOST('STOCKCSV_PS_LOGIN'),'chaine',0,'',$conf->entity);
	if (! $res > 0) $error++;
	$res = dolibarr_set_const($db, 'STOCKCSV_PS_PASSWORD', GETPOST('STOCKCSV_PS_PASSWORD'),'chaine',0,'',$conf->entity);
	if (! $res > 0) $error++;
	$res = dolibarr_set_const($db, 'STOCKCSV_PS_PREFIX', GETPOST('STOCKCSV_PS_PREFIX'),'chaine',0,'',$conf->entity);
	if (! $res > 0) $error++;
	$res = dolibarr_set_const($db, 'STOCKCSV_PS_ID_TRANSPORTEUR', GETPOST('STOCKCSV_PS_ID_TRANSPORTEUR'),'chaine',0,'',$conf->entity);
	if (! $res > 0) $error++;

    if (! $error)
    {
        $db->commit();
        //$mesg = "<font class=\"ok\">".$langs->trans("SetupSaved")."</font>";
        setEventMessage($langs->trans("SetupSaved"));
    }
    else
    {
        $db->rollback();
        //$mesg = "<font class=\"error\">".$langs->trans("Error")."</font>";
        setEventMessage($langs->trans("Error"),'errors');
    }
}


if (preg_match('/set_(.*)/',$action,$reg))
{
	$code=$reg[1];
	$value = GETPOST($code);
	if (dolibarr_set_const($db, $code, $value, 'chaine', 0, '', $conf->entity) > 0)
	{
		header("Location: ".$_SERVER["PHP_SELF"]);
		exit;
	}
	else
	{
		dol_print_error($db);
	}
}
	


if (preg_match('/del_(.*)/',$action,$reg))
{
	$code=$reg[1];
	if (dolibarr_del_const($db, $code) > 0)
	{
		Header("Location: ".$_SERVER["PHP_SELF"]);
		exit;
	}
	else
	{
		dol_print_error($db);
	}
}
