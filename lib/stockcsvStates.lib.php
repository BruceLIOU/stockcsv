<?php
require_once '../lib/stockcsv.lib.php';
require_once '../lib/stockcsvProcess.lib.php';
date_default_timezone_set('Europe/Paris');
function getStateSuppliers($fk_supplier,$jour){

    global $db,$langs;

    $id                 = 0;
    $supplier           = 1;
    $state              = 2;
    $process            = 3;
    $details            = 4;
    $date               = 5;
    $productCreate      = 6;
    $productUpdate      = 7;
    $productError       = 8;
    $user               = 9;
    $hoursUpdate        = 10;
    $duration           = 11;

    $arrayStateSuppliers = array();

    // on recupere les products des commandes
    $sql = ' SELECT rowid ,date ,fk_supplier ,state,process,details,productCreate, productUpdate,productError,user,hoursUpdate,duration';
    $sql.= ' FROM '.MAIN_DB_PREFIX.'supplier_states';
    $sql.= ' WHERE fk_supplier ='.$fk_supplier;
    $sql.= ' AND date ='.$jour->format('Ymd');							



    $resql = $db->query($sql);    

    
    if($resql){

        $StateSuppliersObj = $db->fetch_object($resql);
            

        $arrayStateSuppliers[$id]                       = $StateSuppliersObj->rowid;
        $arrayStateSuppliers[$supplier]                 = $StateSuppliersObj->fk_supplier;
        $arrayStateSuppliers[$state]                    = $StateSuppliersObj->state;
        $arrayStateSuppliers[$process]                  = $StateSuppliersObj->process;
        $arrayStateSuppliers[$details]                  = $StateSuppliersObj->details;
        $arrayStateSuppliers[$date]                     = $StateSuppliersObj->date;
        $arrayStateSuppliers[$productCreate]            = $StateSuppliersObj->productCreate;
        $arrayStateSuppliers[$productUpdate]            = $StateSuppliersObj->productUpdate;
        $arrayStateSuppliers[$productError]             = $StateSuppliersObj->productError;
        $arrayStateSuppliers[$user]                     = $StateSuppliersObj->user;
        $arrayStateSuppliers[$hoursUpdate]              = $StateSuppliersObj->hoursUpdate;
        $arrayStateSuppliers[$duration]                 = $StateSuppliersObj->duration;        

    }
    else{
        $message = $langs->trans("TableStateEmpty");
        setEventMessage($message,'errors');
    }
    return $arrayStateSuppliers;

}

function getImgState($rowMapping,$jourState){

    global $langs;

    $form			= new Form($db);

    // Parcourir le tableau creer via la table mapping
    $supplier           = 1;
    $idSupplier         = 12;

    // Parcourir le tableau creer via la table StateSuppliers
    $id                 = 0;
    $supplier           = 1;
    $state              = 2;
    $process            = 3;
    $details            = 4;


    if($rowStateSuppliers = getStateSuppliers($rowMapping[$idSupplier],$jourState)){
				
        if(isset($rowStateSuppliers[$state])){
            if($rowStateSuppliers[$state] == 0){
                $img = '<img src="../img/state-ok.png">';
            }
            if($rowStateSuppliers[$state] == 1){
                $img = '<img src="../img/state-nok.png">';
            }
        }
        else{
            $img = '<img src="../img/state-notDone.png">';
        }

                        
        
        if(isset($rowStateSuppliers[$process])){
            if($rowStateSuppliers[$process] == 0)
            {
                $text = '<span >'.$langs->trans("auto").'</span>';
            }
            if($rowStateSuppliers[$process] == 1)
            {
                $text = '<span style="color:blue">'.$langs->trans("manuel").'</span>';
            }
        }
        else{
            $text = '<span >'.$langs->trans("attente").'</span>';
        }

        if($rowStateSuppliers[$details]){
            $tooltype = $rowStateSuppliers[$details];
        }
        else{
            $tooltype = "Traitement non effectué";
        }


        return $form->textwithtooltip(	$text,
                                        $tooltype,
                                        3,
                                        -1,
                                        $img,
                                        'process');
    }
    
}

function filesize_formatted($path)
{
    $size = filesize($path);
    $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
    $power = $size > 0 ? floor(log($size, 1024)) : 0;
    return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
}

function getFileStockHere($idFourn)
{

    global $langs, $db;

    $langs->load("stockcsv@stockcsv");

    $form               = new Form($db);
    $fourn              = array();
    $instanceFourn      = new ProductFournisseur($db);
    $fourn              = getThisSupplierFromMapping($idFourn);
    $arrayTableConst    = getTableconst_stockcsv();

    // Parcourir le tableau creer via la table mapping
    $idMapping                  = 0;
    $supplierMapping            = 1;
    $warehouseMapping           = 2;
    $folder_csvMapping          = 3;
    $mask_csvMapping            = 4;

    // Parcourir le tableau creer via la table StateSuppliers
    $id                 = 0;
    $supplier           = 1;

    // Parcourir le tableau creer via la table constante
    $ftp                = 0;

    $instanceFourn->fourn_id = $idFourn;

    /*
    MAJ : 23/06/2020 KJ pertuis fournit un xlsx au lieu d'un ods
    if ($idFourn == "9786") // king jouet pertuis
    {
        $extension = ".ods";
    }
    
    elseif ($idFourn == "9830") // king jouet mâcon
    {
        $extension = ".csv";
    }
    */
    //if ($idFourn > 0)
    //{
        $extension = ".xlsx"; // tous les autres king jouet
    //}

    $absolutPathFtp     = DOL_DATA_ROOT.$arrayTableConst[$ftp];

    $repFourn = $absolutPathFtp.'/'.$fourn[$folder_csvMapping];

    foreach (glob($repFourn."/*".$extension."") as $filename)
    {
        $filenameIn = $filename;
    }
                
	if (file_exists($filenameIn))
	{
		$img = '<img src="../img/state-ok.png">';

        $table = '	<table width="110%">
						<tr>
							<td colspan="2">'.$langs->trans("FileExistHere").'</td>
						</tr>
						<tr>
							<td width="24%">'.$langs->trans("FileSize").'</td>
							<td width="76%">: '.filesize_formatted($filenameIn).'</td>
						</tr>
						<tr>
							<td width="24%">'.$langs->trans("FileName").'</td>
							<td width="76%">: '.substr($filenameIn, strrpos($filenameIn, '/') + 1).'</td>
						</tr>
					</table>';
		$tooltype = $table;		
	}
	else
	{
		$img = '<img src="../img/state-nok.png">';
		$tooltype = $langs->trans("FileExistNotHere");
	}

    return $form->textwithtooltip('', $tooltype, 3, -1, $img, 'process');
 
}

function getFileStockCSVHere($rowMapping,$jourState)
{

    global $langs;

    $form   = new Form($db);
    $arrayTableConst    = getTableconst_stockcsv();

    // Parcourir le tableau creer via la table mapping
    $supplier   = 1;
    $folder_csv = 3;
    $mask_csv   = 4;
    $idSupplier = 12;

    // Parcourir le tableau creer via la table StateSuppliers
    $id = 0;
    $supplier   = 1;

    // Parcourir le tableau creer via la table constante
    $ftp    = 0;

    $maskDateIn = date('Ymd');
    $heure = date("Hi");
    $heurefinstock = "1330";

    $absolutPathFtp = DOL_DATA_ROOT.$arrayTableConst[$ftp];

    $repFourn = $absolutPathFtp.'/'.$rowMapping[$folder_csv];

    /*if ($heure < $heurefinstock)
    {
        $maskDateOut = date('Ymd');
    }
    else
    {
        $maskDateOut = date('Ymd', strtotime($maskDateIn.' + 1 DAY'));
    }*/

    $maskDateOut = date('Ymd');

    $filenameOut = $repFourn.'/'.$rowMapping[$mask_csv].$maskDateOut.'.csv';

    if($rowStateSuppliers = getStateSuppliers($rowMapping[$idSupplier],$jourState)){
                
        if (file_exists($filenameOut))
        {
            $img = '<img id="state-ok" src="../img/state-ok.png">';
            $table = '  <table width="110%">
                            <tr>
                                <td colspan="2">'.$langs->trans("FileExistHere").'</td>
                            </tr>
                            <tr>
                                <td width="35%">'.$langs->trans("FileSize").'</td>
                                <td width="65%">: '.filesize_formatted($filenameOut).'</td>
                            </tr>
                            <tr>
                                <td width="35%">'.$langs->trans("FileName").'</td>
                                <td width="65%">: '.substr($filenameOut, strrpos($filenameOut, '/') + 1).'</td>
                            </tr>
                        </table>';
            $tooltype = $table;

            $here = true;
        }
        else
        {
            $img = '<img id="state-nok" src="../img/state-nok.png">';
            $tooltype = $langs->trans("FileExistNotHere");

            $here = false;
        }

        return $form->textwithtooltip('', $tooltype, 3, -1, $img, 'process');
    } 
    else {
        return false;
    }  
}