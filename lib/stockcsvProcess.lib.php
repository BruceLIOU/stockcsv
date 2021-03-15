<?php

require_once DOL_DOCUMENT_ROOT.'/custom/stockcsv/lib/stockcsv.lib.php';
require_once DOL_DOCUMENT_ROOT.'/custom/stockcsv/lib/stockcsvCommandeEnCours.lib.php';
require_once DOL_DOCUMENT_ROOT.'/fourn/class/fournisseur.class.php';
require_once DOL_DOCUMENT_ROOT .'/core/class/CMailFile.class.php';
// Triggers
require_once DOL_DOCUMENT_ROOT .'/core/class/interfaces.class.php';
require_once DOL_DOCUMENT_ROOT .'/product/class/product.class.php';

date_default_timezone_set('Europe/Paris');

// Get the supplier's infos from the mapping
function getThisSupplierFromMapping($idfourn){

    global $db, $langs;

    $langs->load("stockcsv@stockcsv");

    $id                 = 0;
    $supplier           = 1;
    $warehouse          = 2;
    $folder_csv         = 3;
    $mask_csv           = 4;
    $fk_category        = 5;
    $prefix_supplier    = 6;
    $price_type         = 7;
    $discount_supplier  = 8;
    $tva                = 9;

    
    // on recupere les products des commandes
    $sql = ' SELECT mp.rowid as id ,mp.fk_supplier as supplier ,mp.fk_warehouse as warehouse ,mp.folder_csv as folder_csv,';
    $sql.= ' mp.mask_csv as mask_csv, mp.fk_category as fk_category, mp.prefix_supplier as prefix_supplier, mp.price_type as price_type,';
    $sql.= ' mp.discount_supplier as discount_supplier, mp.tva as tva';
    $sql.= ' FROM '.MAIN_DB_PREFIX.'mapping_stockcsv as mp';
	$sql.= ' WHERE mp.Entity =1 AND mp.fk_supplier ='.$idfourn;				

    $resql = $db->query($sql);

    if($resql)
    {
        $mappingObj = $db->fetch_object($resql);
        
        $mapping[$id]                       = $mappingObj->id;
        $mapping[$supplier]                 = $mappingObj->supplier;
        $mapping[$warehouse]                = $mappingObj->warehouse;
        $mapping[$folder_csv]               = $mappingObj->folder_csv;
        $mapping[$mask_csv]                 = $mappingObj->mask_csv;
        $mapping[$fk_category]              = $mappingObj->fk_category;
        $mapping[$prefix_supplier]          = $mappingObj->prefix_supplier;
        $mapping[$price_type]               = $mappingObj->price_type;
        $mapping[$discount_supplier]        = $mappingObj->discount_supplier;
        $mapping[$tva]                      = $mappingObj->tva;

        return $mapping;
    }
    else
    {
        ErrorSql($sql);
        $message = $langs->trans("TableMappingEmpty");
        setEventMessage($message,'errors');
    }
}

// Get all suppliers' infos from the mapping
function getMapping(){

    global $db, $langs;

    $langs->load("stockcsv@stockcsv");

    $mapping = array();

    // on recupere les products des commandes
    $sql = ' SELECT mp.rowid as id ,mp.fk_supplier as supplier ,mp.fk_warehouse as warehouse ,mp.folder_csv as folder_csv,';
    $sql.= ' mp.mask_csv as mask_csv, mp.fk_category as fk_category, mp.prefix_supplier as prefix_supplier, mp.price_type as price_type,';
    $sql.= ' mp.discount_supplier as discount_supplier, mp.tva as tva';
    $sql.= ' FROM '.MAIN_DB_PREFIX.'mapping_stockcsv as mp';
	$sql.= ' WHERE mp.Entity =1';							

    $resql = $db->query($sql);

    $id                 = 0;
    $supplier           = 1;
    $warehouse          = 2;
    $folder_csv         = 3;
    $mask_csv           = 4;
    $fk_category        = 5;
    $prefix_supplier    = 6;
    $price_type         = 7;
    $discount_supplier  = 8;
    $tva                = 9;

    if($resql)
    {
        $compteurligne=0;
        $nbTotalLignes = $db->num_rows($resql);
        
        while ($compteurligne < $nbTotalLignes)
        {
            $mappingObj = $db->fetch_object($resql);
            
            $mapping[$compteurligne][$id]                       = $mappingObj->id;
            $mapping[$compteurligne][$supplier]                 = $mappingObj->supplier;
            $mapping[$compteurligne][$warehouse]                = $mappingObj->warehouse;
            $mapping[$compteurligne][$folder_csv]               = $mappingObj->folder_csv;
            $mapping[$compteurligne][$mask_csv]                 = $mappingObj->mask_csv;
            $mapping[$compteurligne][$fk_category]              = $mappingObj->fk_category;
            $mapping[$compteurligne][$prefix_supplier]          = $mappingObj->prefix_supplier;
            $mapping[$compteurligne][$price_type]               = $mappingObj->price_type;
            $mapping[$compteurligne][$discount_supplier]        = $mappingObj->discount_supplier;
            $mapping[$compteurligne][$tva]                      = $mappingObj->tva;

            $compteurligne= $compteurligne + 1;
        }   
        return $mapping;
    }
    else
    {
        ErrorSql($sql);
        $message = $langs->trans("TableMappingEmpty");
        setEventMessage($message,'errors');
    }
}

// Get the supplier's unavailable date 
function getDateAbsence($supplier_id){

    global $db, $langs;

    $langs->load("stockcsv@stockcsv");

    $result = array();

    $sql = ' SELECT un.date_unavailable_start as dateStart ,un.date_unavailable_end as dateEnd ';
    $sql.= ' FROM '.MAIN_DB_PREFIX.'fourn_unavailable as un';
    $sql.= ' WHERE un.fk_supplierMapping ='.$supplier_id;

    $start  = 0;
    $end    = 1;

    $resql = $db->query($sql);
    if($resql)
    {
        $DateUnavailable    = $db->fetch_object($resql);
        if($DateUnavailable->dateStart && $DateUnavailable->dateEnd)
        {
            $result[$start]     = $DateUnavailable->dateStart;
            $result[$end]       = $DateUnavailable->dateEnd;
        }

        return $result;
    }

    else
    {
        ErrorSql($sql);
        //pas d'abs
    }
}

function test(){

    global $db;
    
    $user                   = new User($db);
    $arrayTableConst        = getTableconst_stockcsv();
    // Parcourir le tableau creer via la table constante
    $ftp                    = 0;
    $coefMarge              = 1;
    $priceHT                = 2;
    $excludeProductError    = 3;
    $nbDayBeforeDelete      = 4;
    $EmptyStockPartner      = 5;
    $userRobot              = 6;

    $userRobot = $arrayTableConst[$userRobot];
    $user->fetch($userRobot);
    print $user->getNomUrl();
}

// Not used yet
function realCsv($absolutPathFtp){

    $file = file_get_contents($absolutPathFtp, true);
    $file = str_replace(array("\"", "\"\""), "",$file);
    $file = str_replace(array("\n","\r\n","\r"),"",$file);

    $champs = explode(";", $file);

    $fileResult = '';

    for ($i = 0; $i <= count($champs); $i++) 
    {
        $fileResult.= $champs[$i].';';

        if(($i+1) % 5 ==0){
            $fileResult.= "\r\n";
        }
    }

    file_put_contents($absolutPathFtp,$fileResult);

}

function multidimensional_array_flip($array, $KeyToFlip, $KeyToFlip2=false, $Keep_Original_Key=false) {

    $flipped_array=array();

    foreach ($array as $Key=>$Value)
        { 
            if ($Keep_Original_Key) $Value[$Keep_Original_Key]=$Key;
            if (!is_string($Value[$KeyToFlip])) return false;
            if (is_string($KeyToFlip2))
            {
				if (!is_string($Value[$KeyToFlip2])) return false;
                $flipped_array[$Value[$KeyToFlip]][$Value[$KeyToFlip2]]=$Value;
            }

            else $flipped_array[$Value[$KeyToFlip]][]=$Value;
        }

    return $flipped_array;

}

// eject the doublons
function unique_multidim_array_with_mail($arrayCSVResult, $eanCSV,$fournNom, $user) {

    $temp_array = array();
    $i = 0;
    $eanCSV_array = array();
    $details = 'Pour le fournisseur : '.$fournNom.'<br/>';
    foreach($arrayCSVResult as $row)
    {
        if (!in_array($row[$eanCSV], $eanCSV_array))
        {
            $eanCSV_array[$i] = $row[$eanCSV];
            $temp_array[$i] = $row;
        }
        else
        {
            $details.= $row[$eanCSV].'<br/>';
            $subject = "Doublons ";
        }
        $i++;
    }
    if($subject)
    {
        sendMailPbmCsv($details, $subject,$user);
    }
    return $temp_array;
}

function getRowIdAndTvaFromArray($arrayProductChanged){

    global $db;

    $ean    = 0;
    $sku    = 1;
    $label  = 2;
    $qtte   = 3;
    $price  = 4;

    $fk_product     = 0;
    $tva            = 1;
    $fk_warehouse   = 2;
    $premier = true;

    $sql = 'SELECT DISTINCT pfp.fk_product , pfp.tva_tx';
    $sql.= " FROM ".MAIN_DB_PREFIX."product as p";
    $sql.= ' LEFT JOIN '.MAIN_DB_PREFIX.'product_fournisseur_price as pfp ON pfp.fk_product = p.rowid';
    $sql.= ' LEFT JOIN '.MAIN_DB_PREFIX.'product_stock as ps ON ps.fk_product = p.rowid';
    $sql.= ' WHERE pfp.fk_product IN(';
    foreach ($arrayProductChanged as $ligneChanged)
    {
        if($ligneChanged)
        {
            $sql2 = '(SELECT rowid from '.MAIN_DB_PREFIX.'product';
            $sql2.= ' WHERE barcode ="'.$ligneChanged[$ean].'")';
            if($premier)
            {
                $premier = false;
                $sql.= $sql2;
            }
            else
            {   
                $sql.= ','.$sql2;
            }
        }
    }
    $sql.= ')';
    if(!$premier)
    {
        $resql = $db->query($sql);
        addLogEvent($sql);
        if ($resql)
        {
            $compteurligne=0;
            $nbTotalLignes = $db->num_rows($resql);    

            while ($compteurligne < $nbTotalLignes)
            {
                $obj = $db->fetch_object($resql);
                $arrayChangeClean[$compteurligne][$fk_product]               = $obj->fk_product;
                $arrayChangeClean[$compteurligne][$tva]                      = $obj->tva_tx;
                $arrayChangeClean[$compteurligne][$fk_warehouse]             = $obj->fk_entrepot;

                $compteurligne= $compteurligne + 1;
            }
        }
        else
        {
            ErrorSql($sql);
        }
    }
    return $arrayChangeClean;
}

// Main function, the "manuel" preparefile
function prepareFileManuel($idFourn, $user)
{
    include DOL_DOCUMENT_ROOT.'/admin/tools/PHPExcel/Classes/PHPExcel/IOFactory.php';

    global $mysoc, $langs, $db;

    $form           = new Form($db);

    $langs->load("stockcsv@stockcsv");

    $fourn                      = array();
    $instanceFourn              = new ProductFournisseur($db);
    $fourn                      = getThisSupplierFromMapping($idFourn);
    $arrayTableConst            = getTableconst_stockcsv();

    // Parcourir le tableau creer via la table mapping
    $idMapping                  = 0;
    $supplierMapping            = 1;
    $warehouseMapping           = 2;
    $folder_csvMapping          = 3;
    $mask_csvMapping            = 4;

    // Parcourir le tableau creer via la table constante
    $ftp                    = 0;
    $userRobot              = 6;

    $instanceFourn->fourn_id    = $idFourn;
    $fournNom                   = $instanceFourn->getSocNomUrl('','supplier');

    $absolutPathFtp             = DOL_DATA_ROOT.$arrayTableConst[$ftp];

    // on vérifie l'existance du fichier selon le masque MarketPlace_XLSx_0237-AAAAMMJJHHMM.csv

    $maskDateIn = date('Ymd');
    $heure = date("Hi");
    $heurefinstock = "1330";

    //MAJ : 23/06/2020 KJ pertuis fournit un xlsx au lieu d'un ods
    
    /*if ($idFourn == "9786") // king jouet pertuis
    {
        $extension = ".ods";
    }
    /*elseif ($idFourn == "9830") // king jouet mâcon
    {
        $extension = ".csv";
    }*/
    //else
    //{
        $extension = ".xlsx"; // tous les autres king jouet
    //}

    $repFourn = $absolutPathFtp.'/'.$fourn[$folder_csvMapping];

    foreach (glob($repFourn."/*".$extension."") as $filename)
    {
        $filenameIn = $filename;
    }

    // on enregistre le fichier csv avec comme masque ExtractArt_AAAAMMJJ.csv
    if ($heure < $heurefinstock)
    {
        $maskDateOut = date('Ymd');
    }
    else
    {
        $maskDateOut = date('Ymd', strtotime($maskDateIn.' + 1 DAY'));
    }

    $filenameOut = $repFourn.'/ExtractArt_'.$maskDateOut.'.csv';
    $delimiter = ';';
    $enclosure = '"';

    // Creation du chemin pour ouvrir le fichier
    $pathFic = $repFourn.'/'.$filenameIn;

    //$from = "commercial@bruman.fr"; 
    //$to = "commercial@bruman.fr";
    //$headers = "From:" . $from;

    // si il existe on le traite
    if (file_exists($filenameIn))
    {

        $i = 0;
        $newdata = [];
        $data = array();


        try
        {
            $inputFileType = PHPExcel_IOFactory::identify($filenameIn);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = PHPExcel_IOFactory::load($filenameIn);
        }
        catch(Exception $e)
        {
            print("fichier introuvable");
            exit();
        }


        // on séléctionne le bonne feuille du document
        $sheet = $objPHPExcel->getSheet(0);
        // on sauvegarde le nombre de lignes du document.
        $highestRow = $sheet->getHighestRow();
        // on sauvegarde le nombre d colonnes du document.
        $highestColumn = $sheet->getHighestColumn();

        // nous parcourrons les lignes du document.
        for ($row = 1; $row <= $highestRow; $row++)
        {
            $data = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                NULL,
                TRUE,
                FALSE);

            $newdata[] = $data[0];
        }


        // EXPORT CSV
        $fp = fopen($filenameOut, 'w');

        foreach ($newdata as $rows) {
            if ((!empty($rows[2]) && $rows[2] > 0))
            {
                $ean = $rows[0];
                $sku = "-".$rows[4];
                $label = $rows[1];
                $qte = $rows[2];
                $prix = str_replace(",", ".", $rows[3]);

                $tableau = array_filter(array($ean, $sku, $label, $qte, $prix, $prix));
                fputcsv($fp, $tableau, $delimiter, $enclosure);
                //print "<br>";
                
            }

                //print $prix."<br>";

                //fclose($fp);

        }
        //print $filenameIn;
        fclose($fp);
        unlink($filenameIn);

        // on envoi un mail pour absence de fichier
        $subject = $langs->trans("StockOf").' '.$fournNom.' '.$langs->trans("Succes");
     
        $details = $langs->trans("FilStockSuccess");

        YesFile($fourn,$fournNom,$details,$subject,$user);

        $img = '<img src="../img/state-ok.png">';
        $tooltype = "Fichier présent";

        $form->textwithtooltip(  '',
                                        $tooltype,
                                        3,
                                        -1,
                                        $img,
                                        'preparefile');
        
        }
        // si il n'existe pas
        else
        {
            // on envoi un mail pour absence de fichier
            $subject = $langs->trans("StockOf").' '.$fournNom.' '.$langs->trans("Error");
         
            $details = $langs->trans("FileStockError")." ".$fournNom;

            NoFile($fourn,$fournNom,$details,$subject,$user);

            $img = '<img src="../img/state-nok.png">';
            $tooltype = "fichier absent";

            $form->textwithtooltip(  '',
                                        $tooltype,
                                        3,
                                        -1,
                                        $img,
                                        'preparefile');
            
        }
}

function YesFile($fourn,$fournNom,$details,$subject,$user){      

    global $langs;

    $langs->load("stockcsv@stockcsv");

    $supplierMapping            = 1;
    
    $details = $langs->trans("FileSupplierOf")." ".$fournNom." ".$langs->trans("DoneFile");
    //print $fournNom;
    $subject = $langs->trans("FileSupplierHere").' '.$fournNom;

    sendMailPrepareCsv($details, $subject, $user);

    $message = $langs->trans("FileSupplierHere");
    setEventMessage($message.' '.$fournNom);

}

function NoFile($fourn,$fournNom,$details,$subject,$user){      

    global $langs;

    $langs->load("stockcsv@stockcsv");

    $supplierMapping            = 1;
    
    $details = $langs->trans("FileSupplierOf")." ".$fournNom." ".$langs->trans("NotHere");
    //print $fournNom;
    $subject = $langs->trans("FileSupplierNotHere").' '.$fournNom;

    sendMailPrepareCsv($details, $subject, $user);

    $message = $langs->trans("FileSupplierNotHere");
    setEventMessage($message.' '.$fournNom, 'errors');

}
// Send mail if csv bug
function sendMailPrepareCsv($details, $subject, $user){
    

    global $conf,$db,$langs;

    $langs->load("stockcsv@stockcsv");

    // à ajouter aux const du mapping

    $today  = new DateTime("now");

    $constmailToAdresse = $conf->global->MAIN_INFO_SOCIETE_MAIL;
    $constmailToLabel = $conf->global->MAIN_INFO_SOCIETE_NOM;
    

    //$filename_list = array();
    require_once DOL_DOCUMENT_ROOT.'/user/class/user.class.php';

    $message = message($details,$user);

    $subject = $langs->trans("PrepareFile");

    $emailFrom = $user->email; // robot
    $emailTo = $constmailToAdresse; // champs mail table constante
    

    $filename_list = array();
    $mimetype_list = array();
    $mimefilename_list = array();
    $msgishtml=1;

    $mailfile = new CMailFile($subject, $emailTo, $emailFrom, $message, $filename_list, $mimetype_list, $mimefilename_list , '', '', $deliveryreceipt=0, $msgishtml, $conf->global->MAIN_MAIL_ERRORS_TO);
              
    if(!$mailfile->error)
    {
        $result = $mailfile->sendfile();
    }

    else
    {
        setEventMessages($mail->error, $mail->errors, 'errors');
    }

}

// Main function, the "manual" process
function getCSVMappingManuel($idFourn,$user){

    global $mysoc, $langs, $db;

    $langs->load("stockcsv@stockcsv");

    $BacASable=DOL_DOCUMENT_ROOT.'/custom/stockcsv/log/BacASable.log';
    if(file_exists($BacASable)){
        unlink($BacASable);
    }

    $Fichier=DOL_DOCUMENT_ROOT.'/custom/stockcsv/log/fichier.log';
    if(file_exists($Fichier)){
        unlink($Fichier);
    }

    deleteSupplierState();
    
    $fourn = array();

    // 1 -> manuel, 0 -> automatique
    $process = 1;

    $arrayProductPriceChanged           = array();
    $instanceFourn 			            = new ProductFournisseur($db);
    $arrayTerms                         = getTableTermsExclude();
    $fourn                              = getThisSupplierFromMapping($idFourn);
    $arrayTableConst                    = getTableconst_stockcsv();

    // Parcourir le tableau creer via la table mapping
    $idMapping                  = 0;
    $supplierMapping            = 1;
    $warehouseMapping           = 2;
    $folder_csvMapping          = 3;
    $mask_csvMapping            = 4;
    $fk_categoryMapping         = 5;
    $prefix_supplierMapping     = 6;
    $price_typeMapping          = 7;
    $discount_supplierMapping   = 8;
    $tvaMapping                 = 9;

    // Parcourir le tableau creer via la table constante
    $ftp                    = 0;
    $coefMarge              = 1;
    $priceHT                = 2;
    $excludeProductError    = 3;
    $nbDayBeforeDelete      = 4;
    $EmptyStockPartner      = 5;
    $userRobot              = 6;

    // Parcourir le tableau creer via le CSV
    $csvEAN    = 0;
    $csvSKU    = 1;
    $csvLABEL  = 2;
    $csvQTTE   = 3;
    $csvPRICE  = 4;

    // Parcourir le tableau creer via load_Table 
    $eanProduct     = 0;
    $rowIdProduct   = 1;
    $qtProduct      = 2;
    $priceProduct   = 3;

    // Initialisations des Dates 
    $startAbs  = new DateTime('2000-01-01');
    $endAbs    = new DateTime('2000-01-01');
    $accountancy_code_sell   = 707;
    $accountancy_code_buy    = 606;

    // Recuperations des datas de la table constante

    $absolutPathFtp             = DOL_DATA_ROOT.$arrayTableConst[$ftp];
    $viderStockApresNbJour      = viderStockApresNbJour($arrayTableConst[$EmptyStockPartner]);
    $nbDayBeforeDeleteCst       = $arrayTableConst[$nbDayBeforeDelete];

    $instanceFourn->fourn_id    = $idFourn;
    $fournNom                   = $instanceFourn->getSocNomUrl('','supplier');

    $startDuration              = microtime(true);

    // Initialisation des differents tableaux
    $arrayEAN                           = getTableEANExclude();
    $arraySKU                           = getTableSKUExclude();
    $change                             = false;


    $arrayTableProductbyEAN             = getTableProductEAN();
    $arrayTableProductbyEANFlipped      = array_flip($arrayTableProductbyEAN);
    $arrayCSVResult                     = array();
    $arrayCSVResultEANInTableLoad       = array();
    $arrayProductToCreate               = array();
    $arrayProductQtteToUpdate           = array();
    $arrayProductPriceToUpdate          = array();
    $arrayProductToReplace              = array();

    $dateDepart             = new DateTime("now");
    $today                  = new DateTime("now");

    $nbProdCreate           = 0;
    $nbProdQtteUpdate       = 0;
    $nbProdPriceUpdate      = 0;


    $errorProduct           = 0;
    $compteurChangement     = 0;
    $compteurPasDeChgmnt    = 0;

    //Creation du nom de fichier Ã  chercher
    $namefic = $fourn[$mask_csvMapping].$dateDepart->format('Ymd').".csv";

    // Creation du chemin pour ouvrir le fichier
    $pathFic = $absolutPathFtp.'/'.$fourn[$folder_csvMapping].'/'.$namefic;
    $refSupplier = $fourn[$prefix_supplierMapping];

    $startAbs  = new DateTime('2000-01-01');
    $endAbs    = new DateTime('2000-01-01');

    // On recupere les dates d'absences du supplier

    if($dates = getDateAbsence($fourn[$supplierMapping]))
    {
        // Debut et fin des dates d'absences
        $startAbs  = new DateTime($dates[0]);
        $endAbs    = new DateTime($dates[1]);
    }

    //print '<br/><h1> Test fourn :'.$fourn[$supplierMapping].' entrepot : '.$fourn[$warehouseMapping].'</h1>';
    // On verifie la periode d'indisponibilitée
    if($today->format('Ymd') >= $startAbs->format('Ymd') && $today->format('Ymd') <= $endAbs->format('Ymd') ) 
    {
        $state      = 1;
        vestingPeriod($fourn,$fournNom,$details,$subject,$user);
    }
    else
    {
        // On verifie si le fichier exist
        if (file_exists($pathFic))
        {
            // On recupere les datas (ean | rowid | quantite | price) par rapport au fournisseur et son entrepot
            $arrayLoadTable = load_stock($fourn[$supplierMapping],$fourn[$warehouseMapping]);

            if($arrayLoadTable)
            {
                $total_pdt = count($arrayLoadTable);
                $arrayCSVResult = createArrayFromCsv($pathFic,$arrayEAN,$arrayTerms,$arraySKU,$arrayTableConst,$fourn,$fournNom, $user);
                $arrayRequestEANBdd = load_stockEAN($fourn[$supplierMapping],$fourn[$warehouseMapping]);

                // peut se changer dans la requete
                $arrayRequestEANBddFlipped = array_flip($arrayRequestEANBdd);

                // Parcours fichier CSV
                foreach($arrayCSVResult as $lignesCSVResult)
                {
                    if($lignesCSVResult)
                    {
                        // si l'ean n'existe pas dans la table Product
                        if(!isset($arrayTableProductbyEANFlipped[$lignesCSVResult[$csvEAN]]))
                        {
                                $arrayProductToCreate[] = $lignesCSVResult;
                                // Creer le pdt dans la table pdt
                        }
                        else
                        { 
                            // si l EAN exist
                            // Si ean du CSV correspond à une ligne de la table load 
                            // donc que le produit a un stock et un price 
                            if(isset($arrayRequestEANBddFlipped[$lignesCSVResult[$csvEAN]]))
                            {
                                // On recupere la ligne de la table Load
                                $ligneTableRequestATraiter = $arrayRequestEANBddFlipped[$lignesCSVResult[$csvEAN]];
                                //si les qtte ne correspondent pas

                                if($lignesCSVResult[$csvQTTE] != $arrayLoadTable[$ligneTableRequestATraiter][$qtProduct])
                                {
                                         $arrayProductQtteToUpdate[] = $lignesCSVResult;
                                    $change = true;
                                }
                                // si les price ne correspondent pas
                                if(round($lignesCSVResult[$csvPRICE],2,PHP_ROUND_HALF_UP) != round($arrayLoadTable[$ligneTableRequestATraiter][$priceProduct],2,PHP_ROUND_HALF_UP) )
                                {
                                    $arrayProductPriceToUpdate[] = $lignesCSVResult;
                                    $change = true;
                                }
                                // On enleve le produit de Load_Table
                                // Pour n'avoir que les produits qui sont dans Load_Table mais pas dans le CSV
                                unset($arrayLoadTable[$ligneTableRequestATraiter]);
                            }
                            else
                            {
                                // si le produit exist
                               // qu'il n'est pas dans load table (produit qui n'a pas de qtte et/ou de price )
                                $arrayProductToReplace[] = $lignesCSVResult;
                                $compteurChangement++;
                            }
                        }
                        // Connaitre les produits modifiés
                        if($change)
                        {
                            $compteurChangement = $compteurChangement +1;
                        }
                        $change = false;
                    }// fin du if ($ligne)     
                }// fin du foreach parcours CSV
            }
            else
            {                // pas de load_Table
                $arrayCSVResult = createArrayFromCsv($pathFic,$arrayEAN,$arrayTerms,$arraySKU,$arrayTableConst,$fourn,$fournNom, $user);
                // Parcours fichier CSV
                foreach($arrayCSVResult as $lignesCSVResult)
                {
                    if($lignesCSVResult)
                    {
                        // si l'ean n'existe pas dans la table Product
                        // Creer le pdt dans la table pdt
                        if(!isset($arrayTableProductbyEANFlipped[$lignesCSVResult[$csvEAN]]))
                        {
                            $arrayProductToCreate[] = $lignesCSVResult;
                        }
                        else
                        {  
                                // si l EAN exist 
                                // si le produit exist
                                // qu'il n'est pas dans load table (produit qui n'a pas de qtte et/ou de price )
                            $arrayProductToReplace[] = $lignesCSVResult;
                            $compteurChangement ++;
                        }
                    }// fin du if ($ligne)
                }// fin du foreach parcours CSV
            }
            sendMailEanError($user);
            // Traitement des produits : 
            
            // TREATMENT

            // CREATION
            if(!empty($arrayProductToCreate))
            {
                $nbProdCreate += insertIntoProduct($arrayProductToCreate,
                                                   $accountancy_code_sell,
                                                   $accountancy_code_buy,
                                                   $fourn[$fk_categoryMapping],
                                                   $fourn[$warehouseMapping],
                                                   $fourn[$supplierMapping],
                                                   $fourn[$tvaMapping],
                                                   $refSupplier,
                                                   $arrayTableConst[$excludeProductError],
                                                   $user
                                                );
                $errorProduct = count($arrayProductToCreate) - $nbProdCreate;
            }

            // UPDATE
            if(!empty($arrayProductQtteToUpdate))
            {
                $nbProdQtteUpdate += updateProductStock($arrayProductQtteToUpdate,
                                                        $fourn[$warehouseMapping],$user
                                                        );
            }

            if(!empty($arrayProductPriceToUpdate))
            {
                /*$nbProdPriceUpdate += updateProductSupplierPrice(   $arrayProductPriceToUpdate,
                                                                    $fourn[$supplierMapping],
                                                                    $fourn[$tvaMapping],
                                                                    $user
                );*/
                $nbProdPriceUpdate += replaceIntoProductSupplierPrice($arrayProductPriceToUpdate,
                                                                      $fourn[$supplierMapping],
                                                                      $fourn[$tvaMapping],
                                                                      $refSupplier,
                                                                      $user
                                                                      );
            }

            // REPLACE
            if(!empty($arrayProductToReplace))
            {
                replaceIntoProductStock($arrayProductToReplace,
                                        $fourn[$warehouseMapping],
                                        $user
                                        );

                replaceIntoProductSupplierPrice($arrayProductToReplace,
                                                $fourn[$supplierMapping],
                                                $fourn[$tvaMapping],
                                                $refSupplier,
                                                $user
                                                );
            }

            // DELETE
            if(!empty($arrayLoadTable))
            {    

                //Si il reste des produits dans la table load après avoir traité le CSV mettre à 0 qtte et delete les prices.
                deleteProductSupplierPrice($arrayLoadTable,
                                           $fourn[$supplierMapping],
                                           $user
                                           );
                updateProductStockTo0($arrayLoadTable,
                                      $fourn[$warehouseMapping],
                                      $user
                                      );
            }
            // le traitement c'est bien passé
            $state = 0;
            /*print affichagePascal(    $total_pdt,
                                        $compteurLigneCsvSale,
                                        $arrayCSVResult,
                                        $arrayProductPriceToUpdate,
                                        $arrayProductQtteToUpdate,
                                        $nbProdQtteUpdate,
                                        $nbProdPriceUpdate,
                                        $arrayProductToCreate,
                                        $nbProdCreate,
                                        $errorProduct,
                                        ($compteurChangement+count($arrayProductToCreate)+count($arrayLoadTable)),
                                        $arrayProductToReplace,
                                        $arrayLoadTable);*/

            //print ' <br/>';
            $details = affichageBasiqueSimple($arrayCSVResult,$nbProdCreate,$errorProduct,($compteurChangement+count($arrayLoadTable)),$arrayProductToCreate);
            //print $details;

            $arrayProductPriceChanged = array_merge($arrayProductPriceChanged,$arrayLoadTable,$arrayProductToReplace,$arrayProductPriceToUpdate,$arrayProductToCreate);
            
            $memoryArray = getRowIdAndTvaFromArray($arrayProductPriceChanged);
            
            if(!empty($memoryArray))
            {    
                updateSoldPrice($memoryArray,$user);
            }

            setEventMessage($langs->trans("getCSVMappingManuelSuccess"));

			sendMailEanError($user);

        } // fic doesn't exist

        else
        {
        	$state   = 1;

            $details = $langs->trans("NoFindCSV");

            checkOlderFicExist($fournNom,$fourn,$viderStockApresNbJour,$pathFic,$absolutPathFtp,$nbDayBeforeDeleteCst,$dateDepart,$user);
        } 
    } // fin du else de la periode d'indisponibilité

    $endDuration = microtime(true);

    $duration = $endDuration - $startDuration;  

    replaceIntoSupplierStates($fourn[$supplierMapping],
                              $state,
                              $process,
                              $details,
                              $nbProdCreate,
                              ($compteurChangement+count($arrayLoadTable)),
                              $errorProduct,
                              $today->format("H:i:s"),
                              $duration,
                              $user
                              );
    
    //echo 'Exécution du script : ' . $duration . ' <br/>';
}

// Main function, the "automatique" process
function getCSVMappingAutomatique($user){

    global $mysoc, $langs, $db;

    $langs->load("stockcsv@stockcsv");

    //on supprime le fichier cron_run_jobs.php.log avant tout
	/*$CronLog=DOL_DATA_ROOT.'/cron_run_jobs.php.log';
		if(file_exists($CronLog)){
		        unlink($CronLog);
	}*/

	$BacASable=DOL_DOCUMENT_ROOT.'/custom/stockcsv/log/BacASable.log';
    if(file_exists($BacASable)){
        unlink($BacASable);
    }

	$Fichier=DOL_DOCUMENT_ROOT.'/custom/stockcsv/log/fichier.log';
    if(file_exists($Fichier)){
        unlink($Fichier);
    }


	deleteSupplierState();

    // 1 -> manuel, 0 -> automatique
    $process = 0;
    $arrayProductPriceChanged = array();
    $instanceFourn = new ProductFournisseur($db);

    // timestamp en millisecondes du début du script (en PHP 5)

    $arrayTerms                 = getTableTermsExclude();
    $arrayTableMapping          = getMapping();
    $arrayTableConst            = getTableconst_stockcsv();

    // Parcourir le tableau creer via la table mapping
    $idMapping                  = 0;
    $supplierMapping            = 1;
    $warehouseMapping           = 2;
    $folder_csvMapping          = 3;
    $mask_csvMapping            = 4;
    $fk_categoryMapping         = 5;
    $prefix_supplierMapping     = 6;
    $price_typeMapping          = 7;
    $discount_supplierMapping   = 8;
    $tvaMapping                 = 9;

    // Parcourir le tableau creer via la table constante
    $ftp                    = 0;
    $coefMarge              = 1;
    $priceHT                = 2;
    $excludeProductError    = 3;
    $nbDayBeforeDelete      = 4;
    $EmptyStockPartner      = 5;
    $userRobot              = 6;

    // Parcourir le tableau creer via le CSV
    $csvEAN    = 0;
    $csvSKU    = 1;
    $csvLABEL  = 2;
    $csvQTTE   = 3;
    $csvPRICE  = 4;

    // Parcourir le tableau creer via load_Table 
    $eanProduct     = 0;
    $rowIdProduct   = 1;
    $qtProduct      = 2;
    $priceProduct   = 3;

    // Initialisations des Dates 
    $startAbs  = new DateTime('2000-01-01');
    $endAbs    = new DateTime('2000-01-01');
    $accountancy_code_sell   = 707;
    $accountancy_code_buy    = 606;

    // Recuperations des datas de la table constante
    $absolutPathFtp             = DOL_DATA_ROOT.$arrayTableConst[$ftp];
    $viderStockApresNbJour      = viderStockApresNbJour($arrayTableConst[$EmptyStockPartner]);
    $nbDayBeforeDeleteCst       = $arrayTableConst[$nbDayBeforeDelete];

    // On parcour 1 à 1 les founisseurs
    foreach($arrayTableMapping as $fourn)
    {
	    $instanceFourn->fourn_id    = $fourn[$supplierMapping];
    	$fournNom                   = $instanceFourn->getSocNomUrl('','supplier');

   		$startDuration              = microtime(true);

	    // Initialisation des differents tableaux
	    $arrayEAN                  = getTableEANExclude();
	    $arraySKU                  = getTableSKUExclude();
	    $change                    = false;


	    $arrayTableProductbyEAN             = getTableProductEAN();
	    $arrayTableProductbyEANFlipped      = array_flip($arrayTableProductbyEAN);
	    $arrayCSVResult                     = array();
	    $arrayCSVResultEANInTableLoad       = array();
	    $arrayProductToCreate               = array();
	    $arrayProductQtteToUpdate           = array();
	    $arrayProductPriceToUpdate          = array();
	    $arrayProductToReplace              = array();

	    $dateDepart             = new DateTime("now");
	    $today                  = new DateTime("now");

	    $nbProdCreate           = 0;
	    $nbProdQtteUpdate       = 0;
	    $nbProdPriceUpdate      = 0;

	    $errorProduct           = 0;
	    $compteurChangement     = 0;
	    $compteurPasDeChgmnt    = 0;

	    //Creation du nom de fichier à chercher
	    $namefic = $fourn[$mask_csvMapping].$dateDepart->format('Ymd').".csv";

	    // Creation du chemin pour ouvrir le fichier
	    $pathFic = $absolutPathFtp.'/'.$fourn[$folder_csvMapping].'/'.$namefic;
	    $refSupplier = $fourn[$prefix_supplierMapping];

	    $startAbs  = new DateTime('2000-01-01');
	    $endAbs    = new DateTime('2000-01-01');

	    // On recupere les dates d'absences du supplier

	    if($dates = getDateAbsence($fourn[$supplierMapping]))
        {
	        // Debut et fin des dates d'absences
	        $startAbs  = new DateTime($dates[0]);
	        $endAbs    = new DateTime($dates[1]);

    	}

	    //print '<br/><h1> Test fourn :'.$fourn[$supplierMapping].' entrepot : '.$fourn[$warehouseMapping].'</h1>';
	    // On verifie la periode d'indisponibilitée
	    if($today->format('Ymd') >= $startAbs->format('Ymd') && $today->format('Ymd') <= $endAbs->format('Ymd') ) 
	    {
	        $state      = 1;
	        vestingPeriod($fourn,$fournNom,$details,$subject,$user);
	    }
	    else
        {
        // On verifie si le fichier exist
        if (file_exists($pathFic))
        {
            // On recupere les datas (ean | rowid | quantite | price) par rapport au fournisseur et son entrepot
            $arrayLoadTable = load_stock($fourn[$supplierMapping],$fourn[$warehouseMapping]);

            if($arrayLoadTable)
            {
                $total_pdt = count($arrayLoadTable);
                $arrayCSVResult = createArrayFromCsv($pathFic,$arrayEAN,$arrayTerms,$arraySKU,$arrayTableConst,$fourn,$fournNom, $user);
                $arrayRequestEANBdd = load_stockEAN($fourn[$supplierMapping],$fourn[$warehouseMapping]);

                // peut se changer dans la requete
                $arrayRequestEANBddFlipped = array_flip($arrayRequestEANBdd);

                // Parcours fichier CSV
                foreach($arrayCSVResult as $lignesCSVResult)
                {
                    if($lignesCSVResult)
                    {
                        // si l'ean n'existe pas dans la table Product
                        if(!isset($arrayTableProductbyEANFlipped[$lignesCSVResult[$csvEAN]]))
                        {
                                $arrayProductToCreate[] = $lignesCSVResult;
                                // Creer le pdt dans la table pdt
                        }
                        else
                        { 
                            // si l EAN exist
                            // Si ean du CSV correspond à une ligne de la table load 
                            // donc que le produit a un stock et un price 
                            if(isset($arrayRequestEANBddFlipped[$lignesCSVResult[$csvEAN]]))
                            {
                                // On recupere la ligne de la table Load
                                $ligneTableRequestATraiter = $arrayRequestEANBddFlipped[$lignesCSVResult[$csvEAN]];
                                //si les qtte ne correspondent pas

                                if($lignesCSVResult[$csvQTTE] != $arrayLoadTable[$ligneTableRequestATraiter][$qtProduct])
                                {
                                    $arrayProductQtteToUpdate[] = $lignesCSVResult;
                                    $change = true;
                                }
                                // si les price ne correspondent pas
                                if(round($lignesCSVResult[$csvPRICE],2,PHP_ROUND_HALF_UP) != round($arrayLoadTable[$ligneTableRequestATraiter][$priceProduct],2,PHP_ROUND_HALF_UP) )
                                {
                                    $arrayProductPriceToUpdate[] = $lignesCSVResult;
                                    $change = true;
                                }
                                // On enleve le produit de Load_Table
                                // Pour n'avoir que les produits qui sont dans Load_Table mais pas dans le CSV
                                unset($arrayLoadTable[$ligneTableRequestATraiter]);
                            }
                            else
                            {
                                // si le produit exist
                               // qu'il n'est pas dans load table (produit qui n'a pas de qtte et/ou de price )
                                $arrayProductToReplace[] = $lignesCSVResult;
                                $compteurChangement++;
                            }
                        }
                        // Connaitre les produits modifiés
                        if($change)
                        {
                            $compteurChangement = $compteurChangement +1;
                        }
                        $change = false;
                    }// fin du if ($ligne)     
                }// fin du foreach parcours CSV
            }
            else
            {                // pas de load_Table

                $arrayCSVResult = createArrayFromCsv($pathFic,$arrayEAN,$arrayTerms,$arraySKU,$arrayTableConst,$fourn,$fournNom, $user);
                // Parcours fichier CSV
                foreach($arrayCSVResult as $lignesCSVResult)
                {
                    if($lignesCSVResult)
                    {
                        // si l'ean n'existe pas dans la table Product
                        // Creer le pdt dans la table pdt
                        if(!isset($arrayTableProductbyEANFlipped[$lignesCSVResult[$csvEAN]]))
                        {
                            $arrayProductToCreate[] = $lignesCSVResult;
                        }
                        else
                        {  
                                // si l EAN exist 
                                // si le produit exist
                                // qu'il n'est pas dans load table (produit qui n'a pas de qtte et/ou de price )
                            $arrayProductToReplace[] = $lignesCSVResult;
                            $compteurChangement ++;
                        }
                    }// fin du if ($ligne)
                }// fin du foreach parcours CSV
            }
            // Traitement des produits : 
            
            // TREATMENT

            // CREATION
            if(!empty($arrayProductToCreate))
            {
                $nbProdCreate += insertIntoProduct($arrayProductToCreate,
                                                   $accountancy_code_sell,
                                                   $accountancy_code_buy,
                                                   $fourn[$fk_categoryMapping],
                                                   $fourn[$warehouseMapping],
                                                   $fourn[$supplierMapping],
                                                   $fourn[$tvaMapping],
                                                   $refSupplier,
                                                   $arrayTableConst[$excludeProductError],
                                                   $user
                                                );
                $errorProduct = count($arrayProductToCreate) - $nbProdCreate;
                dol_syslog($fourn[$supplierMapping], LOG_ERR);
            }

            // UPDATE

            if(!empty($arrayProductQtteToUpdate))
            {
                $nbProdQtteUpdate += updateProductStock($arrayProductQtteToUpdate,
                                                        $fourn[$warehouseMapping],$user
                                                        );
                dol_syslog($fourn[$warehouseMapping], LOG_ERR);
            }

            if(!empty($arrayProductPriceToUpdate))
            {
                $nbProdPriceUpdate += updateProductSupplierPrice($arrayProductPriceToUpdate,
                                                                 $fourn[$supplierMapping],
                                                                 $fourn[$tvaMapping],
                                                                 $user
                                                                );
                dol_syslog($fourn[$supplierMapping], LOG_ERR);
            }

            // REPLACE

            if(!empty($arrayProductToReplace))
            {
                replaceIntoProductStock($arrayProductToReplace,
                                        $fourn[$warehouseMapping],
                                        $user
                                        );
                dol_syslog($fourn[$warehouseMapping], LOG_ERR);

                replaceIntoProductSupplierPrice($arrayProductToReplace,
                                                $fourn[$supplierMapping],
                                                $fourn[$tvaMapping],
                                                $refSupplier,
                                                $user
                                                );
                dol_syslog($fourn[$supplierMapping], LOG_ERR);
            }

            // DELETE
            if(!empty($arrayLoadTable))
            {    
               //Si il reste des produits dans la table load après avoir traité le CSV mettre à 0 qtte et delete les prices.
                deleteProductSupplierPrice($arrayLoadTable,
                                           $fourn[$supplierMapping],
                                           $user
                                           );
                dol_syslog($fourn[$supplierMapping], LOG_ERR);
                updateProductStockTo0($arrayLoadTable,
                                      $fourn[$warehouseMapping],
                                      $user
                                      );
                dol_syslog($fourn[$warehouseMapping], LOG_ERR);
            }
            // le traitement c'est bien passé
            $state = 0;
            /*print affichagePascal(    $total_pdt,
                                        $compteurLigneCsvSale,
                                        $arrayCSVResult,
                                        $arrayProductPriceToUpdate,
                                        $arrayProductQtteToUpdate,
                                        $nbProdQtteUpdate,
                                        $nbProdPriceUpdate,
                                        $arrayProductToCreate,
                                        $nbProdCreate,
                                        $errorProduct,
                                        ($compteurChangement+count($arrayProductToCreate)+count($arrayLoadTable)),
                                        $arrayProductToReplace,
                                        $arrayLoadTable);*/

            //print ' <br/>';
            $details = affichageBasiqueSimple($arrayCSVResult,$nbProdCreate,$errorProduct,($compteurChangement+count($arrayLoadTable)),$arrayProductToCreate);
            //print $details;

            $arrayProductPriceChanged = array_merge($arrayProductPriceChanged,$arrayLoadTable,$arrayProductToReplace,$arrayProductPriceToUpdate,$arrayProductToCreate);
            
            /*print '<br/>';
            print 'merge : ';
            print count($arrayProductPriceChanged);
            print '<br/>';*/


            ///////////////////////////////////////////////////////////

            //$message = $langs->trans("ChangmntDone");

            //$message2 = $langs->trans("CreateDone");

            //$supplierNbr = $langs->trans("supplierNbr");



            //setEventMessage($supplierNbr.$fourn[$supplierMapping]);

            //setEventMessage($message.$compteurChangement);

            setEventMessage($langs->trans("getCSVMappingManuelSuccess"));
		
        } // fic doesn't exist
        else{


            $state   = 1;
            $details = $langs->trans("NoFindCSV");
            checkOlderFicExist($fournNom,$fourn,$viderStockApresNbJour,$pathFic,$absolutPathFtp,$nbDayBeforeDeleteCst,$dateDepart,$user);
        } 

    } // fin du else de la periode d'indisponibilité

    $endDuration = microtime(true);

    $duration = $endDuration - $startDuration;

    replaceIntoSupplierStates($fourn[$supplierMapping],
                              $state,
                              $process,
                              $details,
                              $nbProdCreate,
                              ($compteurChangement+count($arrayLoadTable)),
                              $errorProduct,
                              $today->format("H:i:s"),
                              $duration,
                              $user
                              );
        //echo 'Exécution du script : ' . $duration . ' <br/>';
    } // fin de la boucle foreach fourn

    //sendMailEanError($user);
        
    $memoryArray = getRowIdAndTvaFromArray($arrayProductPriceChanged);

    if(!empty($memoryArray)){    

        updateSoldPrice($memoryArray,$user);
    }

    sendMailEanError($user);
}


// Display
function secondsToTime($s){

    $s = floor($s);
    $h = floor($s / 3600);
    $s -= $h * 3600;
    $m = floor($s / 60);
    $s -= $m * 60;
    $today =  $h.':'.$m.':'.$s;
    return $today;
}

function mediaTimeDeFormater($seconds)
{
    /*if (!is_numeric($seconds))
        throw new Exception("Invalid Parameter Type!");*/


    $ret = "";
	if (is_numeric($seconds))
	{
	    $hours = (string )floor($seconds / 3600);
	    $secs = (string )$seconds % 60;
	    $mins = (string )floor(($seconds - ($hours * 3600)) / 60);

	    if (strlen($hours) == 1)
	        $hours = "0" . $hours;
	    if (strlen($secs) == 1)
	        $secs = "0" . $secs;
	    if (strlen($mins) == 1)
	        $mins = "0" . $mins;
	    $minstext = " (min)";
        $hourstext = " (h)";
        $secondstext = " (s)";

	    /*if (!empty($mins))
	        $ret = "$mins:$secs".$secondstext;
	    else
	        $ret = "$hours:$mins:$secs".$hourstext;*/
		$ret = "$hours:$mins:$secs";
	    return $ret;
	}
	else
	return $ret;	
}

// Insert a row in the Table Product
function insertIntoProduct($arrayProductToCreate, $accountancy_code_sell, $accountancy_code_buy, $fk_categ, $fk_warehouse, $fk_supplier, $tva, $refSupplier, $excludeProductError, $user, $entity=1){

    global $db;

    $error	= 0;

    $ean    = 0;
    $sku    = 1;
    $label  = 2;
    $qtte   = 3;
    $price  = 4;

    $compteurUpdate =0;

    // Aucun insert ne se fait si SKU existe déjà /!\

    foreach ($arrayProductToCreate as $ligneProduct)
    {
        if($ligneProduct)
        {
            //$refProduct = substr($ligneProduct[$sku], 1, -1);
            $refProduct = ltrim($ligneProduct[$sku], '-');

            $sql = "INSERT INTO ".MAIN_DB_PREFIX."product";
            $sql.= " (ref, label, description, barcode,fk_barcode_type,entity,accountancy_code_sell,accountancy_code_buy,fk_user_author,tms,datec)";
            $sql.= " VALUES";
            $sql.= ' ("'.$refProduct.'","'.$ligneProduct[$label].'","'.$ligneProduct[$label].'","'.$ligneProduct[$ean].'",2,'.$entity.','.$accountancy_code_sell.','.$accountancy_code_buy.','.$user->id.',now(),now())'; 
            
            $resql = $db->query($sql);
                            addLogEvent($sql);
            if ($resql)
            {
                $compteurUpdate += 1;

                insertIntoProductCategorie($ligneProduct,$fk_categ,$user);
                insertIntoProductSupplierPrice($ligneProduct,$fk_supplier,$tva,$refSupplier,$user);
                insertIntoProductStock($ligneProduct,$fk_warehouse,$user);

                if($idobject = getRowIdProduct($ligneProduct[$ean]))
                {
                    $newobject = new Product($db);
                    $newobject->fetch($idobject);
                    $newobject->entrepot_id = $fk_warehouse;
                    $newobject->product_id = $newobject->id;
                    $newobject->price = $ligneProduct[$price];
                    $newobject->tva_tx = $tva;

                    require_once DOL_DOCUMENT_ROOT .'/categories/class/categorie.class.php';
                    $newcateg = new Categorie($db);
                    $newcateg->fetch($fk_categ);
                    $newcateg->linkto=$newobject;

                    $result1     = $newobject->call_trigger('PRODUCT_CREATE_STOCK_CSV',$user);
                    $result4     = $newcateg->call_trigger('CATEGORY_LINK_STOCK_CSV',$user);

                    //deleteCategorieProduct  ($idobject,'46');
                    //$result2     = $newobject    ->call_trigger('PRODUCT_SUPPLIER_BUYPRICE_UPDATE_STOCK_CSV',$user);
                    $result3     = $newobject->call_trigger('PRODUCT_STOCK_MOVEMENT_STOCK_CSV',$user);
					
					if ($result1 < 0) $error++;
					if ($result4 < 0) $error++;
					if ($result3 < 0) $error++;

					/*if ($result1 < 0)
	                {
	                	$error++;
	                	$db->rollback();
	                	return -1;
	                }
	                if ($result4 < 0)
	                {
	                	$error++;
	                	$db->rollback();
	                	return -1;
	                }
					if ($result3 < 0)
	                {
	                	$error++;
	                	$db->rollback();
	                	return -1;
	                }	                
	                // End call triggers

	                $db->commit();*/


                    /*print '<br/>';
                    print '$result1 : '.$result1;
                    print '<br/>';
                    print '$result2 : '.$result2;
                    print '<br/>';
                    print '$result3 : '.$result3;                    
                    print '<br/>';                    
                    print '$result4 : '.$result4;                    
                    print '<br/>';*/


                }
                else
                {
                    EanBugTrigger($ligneProduct[$ean]);
                }
            }
            else
            {  // !$resql

                if($excludeProductError)
                {   // Voir le mapping
                    insertEANExclude($ligneProduct[$ean]);
                }
                else
                {
                    ErrorLogEan($ligneProduct[$ean], $fk_supplier, $ligneProduct[$sku]);
                }
            }
        }
    }
    return $compteurUpdate;
}

// Insert a row in the Table Product Categ
function insertIntoProductCategorie($ligneProduct,$fk_categ,$user){

    global $db;
    
    $ean            = 0;
    $sku            = 1;
    $label          = 2;
    $qtte           = 3;
    $price          = 4;
    $compteurUpdate = 0;

    // Aucun insert ne se fait si SKU existe déjà /!\
    
    $sql = "INSERT INTO ".MAIN_DB_PREFIX."categorie_product";
    $sql.= " (fk_categorie, fk_product)";
    $sql.= " VALUES";
    $sql.= ' ("'.$fk_categ.'",';
    $sql.= " (";
    $sql.= " SELECT rowid FROM ".MAIN_DB_PREFIX."product";
    $sql.= ' WHERE barcode ="'.$ligneProduct[$ean].'"';
    $sql.= " ))";  

    $resql = $db->query($sql);
    
    addLogEvent($sql);

    if ($resql)
    {
        $compteurUpdate += 1;
    }

    else
    {
        ErrorSql($sql);
    }

    return $compteurUpdate;

}

// Insert a row in the Table Product Supplier Price
function insertIntoProductSupplierPrice($ligneProduct,$fk_supplier,$tva,$refSupplier,$user,$entity=1,$qt=1){

    global $db;

    $ean                    = 0;
    $sku                    = 1;
    $label                  = 2;
    $qtte                   = 3;
    $price                  = 4;
    $compteurPriceInserted  = 0;

    $sql = "INSERT INTO ".MAIN_DB_PREFIX."product_fournisseur_price";
    $sql.= " (fk_product, fk_soc,price,tva_tx,entity,ref_fourn,datec,tms,unitprice,fk_user,quantity)";
    $sql.= " VALUES";
    $sql.= " ((";
    $sql.= " SELECT rowid FROM ".MAIN_DB_PREFIX."product";
    $sql.= ' WHERE barcode ="'.$ligneProduct[$ean].'"';
    $sql.= " ),";
    $sql.= $fk_supplier.','.$ligneProduct[$price].','.$tva.','.$entity.',SUBSTRING("'.$refSupplier.$ligneProduct[$sku].'",1, 30),now(),now(),'.($ligneProduct[$price]/$qt).','.$user->id.','.$qt;
    $sql.= ')'; 

    $resql = $db->query($sql);
    addLogEvent($sql);

    if ($resql)
    {
        $compteurPriceInserted +=1;

    }

    else
    {
        ErrorSql($sql);
    } 

    return $compteurPriceInserted;
}

// Insert a row in the Table Product Stock
function insertIntoProductStock($ligneProduct,$fk_warehouse,$user){

    global $db;

    $ean                    = 0;
    $sku                    = 1;
    $label                  = 2;
    $qtte                   = 3;
    $price                  = 4;
    $compteurQtteInserted   = 0;

    $sql = "INSERT INTO ".MAIN_DB_PREFIX."product_stock";
    $sql.= " (fk_product, fk_entrepot,reel, tms )";
    $sql.= " VALUES";
    $sql.= " ((";
    $sql.= " SELECT rowid FROM ".MAIN_DB_PREFIX."product";
    $sql.= ' WHERE barcode ="'.$ligneProduct[$ean].'"';
    $sql.= " ),";
    $sql.= $fk_warehouse.",".$ligneProduct[$qtte].",now())"; 

    $resql = $db->query($sql);
    addLogEvent($sql);
    if ($resql)
    {
        $compteurQtteInserted += 1;
    }

    else
    {
        ErrorSql($sql);
    }

    return $compteurQtteInserted;
}

// Update multiRow in the Table Product Supplier Price
function updateProductSupplierPrice($arrayProductPriceToUpdate,$idFourn,$tva,$user,$entity=1,$qt =1){

    global $db;

    $ean                    = 0;
    $sku                    = 1;
    $label                  = 2;
    $qtte                   = 3;
    $price                  = 4;
    $compteurPriceUpdated   = 0;

    foreach ($arrayProductPriceToUpdate as $ligneProduct)
    {
        if($ligneProduct)
        {
            $sql2 = '(SELECT p.rowid FROM '.MAIN_DB_PREFIX.'product as p';
            $sql2.= ' WHERE p.barcode ='.$ligneProduct[$ean];
            $sql2.= ')';

            $sql = 'UPDATE '.MAIN_DB_PREFIX.'product_fournisseur_price';
            $sql.= ' SET price ="'.$ligneProduct[$price].'"';
            $sql.= ' ,tms = now()';
            $sql.= ' ,tva_tx ='.$tva;
            $sql.= ' ,fk_user ='.$user->id;
            $sql.= ' ,entity ='.$entity;
            $sql.= ' ,unitprice ='.($ligneProduct[$price]/$qt);
            $sql.= ' ,quantity ='.$qt;
            $sql.= ' WHERE fk_soc = '.$idFourn;
            $sql.= " AND fk_product = ".$sql2.";";

            $resql = $db->query($sql);
            addLogEvent($sql);

            if ($resql)
            {
                $compteurPriceUpdated +=1;
            }

            else
            {
                ErrorSql($sql);
            }
        }
    }

    return $compteurPriceUpdated;
}

// Update multiRow in the Table Product Stock
function updateProductStock($arrayProductQtteToUpdate,$idWarehouse,$user){

    global $db;

    $error=0;

    $ean                    = 0;
    $sku                    = 1;
    $label                  = 2;
    $qtte                   = 3;
    $price                  = 4;
    $compteurQtteUpdated    = 0;

    foreach ($arrayProductQtteToUpdate as $ligneProduct)
    {
        if($ligneProduct)
        {

            $sql2 = '(SELECT p.rowid FROM '.MAIN_DB_PREFIX.'product as p';
            $sql2.= ' WHERE p.barcode ='.$ligneProduct[$ean];
            $sql2.= ')';
            
            $sql = "UPDATE ".MAIN_DB_PREFIX."product_stock";
            $sql.= " SET reel =".$ligneProduct[$qtte];
            $sql.= " ,tms = now()";
            $sql.= " WHERE fk_entrepot = ".$idWarehouse;
            $sql.= " AND fk_product = ".$sql2.";";

            $resql = $db->query($sql);
            addLogEvent($sql);

            if ($resql)
            {
                $compteurPriceUpdated +=1;
                $newobject = new Product($db);

                if($idobject = getRowIdProduct($ligneProduct[$ean]))
                {
                    $theUser = new User($db);
                    $theUser->fetch($user->id);

                    $newobject->fetch($idobject);
                    $newobject->product_id    = $newobject->id;
                    $newobject->entrepot_id   = $idWarehouse;
                    
                    $result = $newobject->call_trigger('PRODUCT_STOCK_MOVEMENT_STOCK_CSV',$user);

                    if ($result < 0) $error++;
                }

                else
                {
                    EanBugTrigger($ligneProduct[$ean]);
                }
            }

            else
            {
                ErrorSql($sql);
            }
        }
    }

    return $compteurQtteUpdated;
}

// Update multiRow in the Table Product Stock (down the stock to 0)
function updateProductStockTo0($arrayProductQtteToUpdate,$idWarehouse,$user){

    global $db;

    $error					= 0;

    $ean                    = 0;
    $sku                    = 1;
    $label                  = 2;
    $qtte                   = 3;
    $price                  = 4;
    $sql                    = '';
    $arrayEanStockUpdated   = array() ; 
    $compteurQtteUpdatedTo0 = 0;
    $premier                = true;

    $sql = "UPDATE ".MAIN_DB_PREFIX."product_stock";
    $sql.= " SET reel = 0";
    $sql.= " ,tms = now()";
    $sql.= " WHERE fk_entrepot = ".$idWarehouse;
    $sql.= ' AND fk_product IN(';

    foreach ($arrayProductQtteToUpdate as $ligneProduct)
    {
        if($ligneProduct)
        {
            $sql2 = '(SELECT rowid from '.MAIN_DB_PREFIX.'product';
            $sql2.= ' WHERE barcode ="'.$ligneProduct[$ean].'")';
            
            if($premier)
            {
                $premier = false;
                $sql.= $sql2;
            }

            else
            {
                $sql.= ','.$sql2;
            }

            $arrayEanStockUpdated[] = $ligneProduct[$ean];
        }
    }
    $sql.= ')';

    $resql = $db->query($sql);
    addLogEvent($sql);

    if ($resql)
    {
        $compteurPriceUpdated +=1;
        foreach($arrayEanStockUpdated as $ean)
        {
            if($ean)
            {

                $newobject = new Product($db);
                if($idobject = getRowIdProduct($ean))
                {          
                    $theUser = new User($db);
                    $theUser->fetch($user->id);      

                    $newobject->fetch($idobject);
                    $newobject->product_id    = $newobject->id;
                    $newobject->entrepot_id   = $idWarehouse;
                    $result = $newobject->call_trigger('PRODUCT_STOCK_MOVEMENT_STOCK_CSV',$user);

                    if ($result < 0) $error++;

                }

                else
                {
                    EanBugTrigger($ligneProduct[$ean]);
                }
            }
        }
    }

    else
    { // !resql
        ErrorSql($sql);
    }

    return $compteurQtteUpdatedTo0;
}

// Update all the row in Table Product (down the stock to 0)
function updateProductStockTo0General($idWarehouse,$user){

    global $db;

    $ean    = 0;
    $sku    = 1;
    $label  = 2;
    $qtte   = 3;
    $price  = 4;
    $sql    = '';

    $sql = "UPDATE ".MAIN_DB_PREFIX."product_stock";
    $sql.= " SET reel = 0";
    $sql.= " ,tms = now()";
    $sql.= " WHERE fk_entrepot = ".$idWarehouse;

    $resql = $db->query($sql);
    addLogEvent($sql);
    if ($resql)
    {
        //done
        // faire la fonction qui recupere tous les rowid de la table product stock
        /*foreach($arrayEanStockUpdated as $ean){
            $newobject  = new Product($db);
            $idobject   = getRowIdProduct($ean);
            $newobject->fetch($idProduct);
            $newobject->product_id  = $newobject->id;
            $newobject->entrepot_id = $idWarehouse;
            $result     = $newobject->call_trigger('PRODUCT_STOCK_MOVEMENT_STOCK_CSV',$user);
        }*/
    }
    else
    {
        ErrorSql($sql);
    }
}

// Delete multiRow in the Table Product Supplier Price
function deleteProductSupplierPrice($arrayProductPriceToDelete,$idFourn,$user){

    global $db;
 
    $ean    = 0;
    $sku    = 1;
    $label  = 2;
    $qtte   = 3;
    $price  = 4;

    $sql                    = '';
    $arrayEanPriceUpdated   = array();
    $compteurPriceDeleted   = 0;
    $premier                = true;

    $sql = 'DELETE FROM '.MAIN_DB_PREFIX.'product_fournisseur_price';
    $sql.= ' WHERE fk_soc = '.$idFourn;
    $sql.= ' AND fk_product IN(';

    foreach ($arrayProductPriceToDelete as $ligneProduct)
    {
        if($ligneProduct)
        {
            $sql2 = '(SELECT rowid from '.MAIN_DB_PREFIX.'product';
            $sql2.= ' WHERE barcode ="'.$ligneProduct[$ean].'")';

            if($premier)
            {
                $premier = false;
                $sql.= $sql2;
            }

            else
            {
                $sql.= ','.$sql2;
            }

            $arrayEanPriceUpdated[] = $ligneProduct[$ean];
        }
    }
    $sql.= ')';

    if(!$premier)
    {
        $resql = $db->query($sql);
        addLogEvent($sql);
        
        if ($resql)
        {
            $compteurPriceDeleted +=1;

            /*foreach($arrayEanPriceUpdated as $ean){

                $newobject  = new Product($db);
                if($idobject   = getRowIdProduct($ean)){
                    $newobject  ->fetch($idobject);
                    $newobject  ->price = $ligneProduct[$price];
                    $newobject  ->entrepot_id   = $idWarehouse;
                    $result     = $newobject->call_trigger('PRODUCT_SUPPLIER_BUYPRICE_UPDATE_STOCK_CSV',$user);
                }else{

                    EanBugTrigger($ligneProduct[$ean]);
                }
            }*/
        }
        else
        {
            ErrorSql($sql);
        }
    }

    return $compteurPriceDeleted;
}

// Delete all the row in Table Product Supplier Price
function deleteProductSupplierPriceGeneral($idFourn,$user){

    global $db;

    $ean    = 0;
    $sku    = 1;
    $label  = 2;
    $qtte   = 3;
    $price  = 4;

    $sql        = '';
    $arraySql   = array();


    $sql.= 'DELETE FROM '.MAIN_DB_PREFIX.'product_fournisseur_price';
    $sql.= ' WHERE fk_soc = '.$idFourn;

    $resql = $db->query($sql);
    addLogEvent($sql);

    if ($resql)
    {
        //ok
        // faire la fonction qui recupere tous les rowid de la table product_fournisseur_price
        /*
        foreach($arrayEanPriceUpdated as $ean){
            $newobject  = new Product($db);
            $idobject   = getRowIdProduct($ean);
            $newobject  ->fetch($idobject);
                                $newobject  ->price = $ligneProduct[$price];
            $result     = $newobject->call_trigger('PRODUCT_SUPPLIER_BUYPRICE_UPDATE_STOCK_CSV',$user);
        }*/
    }

    else
    {
        ErrorSql($sql);
    }
}

/*function deleteCategorieProduct  ($idProduct,$categDelet){

    global $db;

    $ean    = 0;
    $sku    = 1;
    $label  = 2;
    $qtte   = 3;
    $price  = 4;

    $sql        = '';
    $arraySql   = array();


    $sql.= 'DELETE FROM '.MAIN_DB_PREFIX.'categorie_product';
    $sql.= ' WHERE fk_categorie = '.$categDelet;
    $sql.= ' AND fk_product ='.$idProduct;

    print $sql;
    $resql = $db->query($sql);
    addLogEvent($sql);

    if ($resql){

    }else{

        ErrorSql($sql);
    }
}*/

// Replace multiRow the row in Table Product Supplier Price (down the stock to 0)
function replaceIntoProductSupplierPrice($arrayProductPriceToReplace,$fk_supplier,$tva,$refSupplier,$user,$entity=1,$qt=1){

    global $db;

    $ean    = 0;
    $sku    = 1;
    $label  = 2;
    $qtte   = 3;
    $price  = 4;

    $premier                =true;
    $arrayEanPriceUpdated   = array();

    $sql = "REPLACE INTO ".MAIN_DB_PREFIX."product_fournisseur_price";
    $sql.= " (fk_product,fk_soc,price,tva_tx,entity,ref_fourn,datec,tms,unitprice,fk_user,quantity)";
    $sql.= " VALUES";
    foreach ($arrayProductPriceToReplace as $ligneProduct)
    {
        if($ligneProduct)
        {
            $sql2 = " ((";
            $sql2.= " SELECT rowid FROM ".MAIN_DB_PREFIX."product";
            $sql2.= ' WHERE barcode ="'.$ligneProduct[$ean].'"';
            $sql2.= " ),";
            $sql2.= $fk_supplier.','.$ligneProduct[$price].','.$tva.','.$entity.',SUBSTRING("'.$refSupplier.$ligneProduct[$sku].'",1, 30),now(),now(),'.($ligneProduct[$price]/$qt).','.$user->id.','.$qt;
            $sql2.= ')';

            if($premier)
            {
                $premier = false;
                $sql.= $sql2;
            }

            else
            {
                $sql.= ','.$sql2;
            }

            $arrayEanPriceUpdated[] = $ligneProduct[$ean];
        }
    }

    $resql = $db->query($sql);
    addLogEvent($sql);
    if ($resql)
    {
        $compteurPriceReplaced +=1;

        foreach($arrayEanPriceUpdated as $ean)
        {
            /*if($ean){

                if($idobject   =   getRowIdProduct($ean)){
                    
                    $newobject  = new Product($db);
                    $newobject  ->fetch($idobject);
                    $newobject  ->price = $ligneProduct[$price];
               //     $newobject  ->entrepot_id   = $idWarehouse;

               //     $result     =   $newobject->call_trigger('PRODUCT_SUPPLIER_BUYPRICE_UPDATE_STOCK_CSV',$user);
                }
                else{

                    EanBugTrigger($ligneProduct[$ean]);
                }
            }*/
        }
    }
    else
    {  // no resql
        ErrorSql($sql);
    }

    /*

        foreach ($arrayProductPriceToReplace as $ligneProduct){

            if($ligneProduct){

                $sql = "REPLACE INTO ".MAIN_DB_PREFIX."product_fournisseur_price";

                $sql.= " (fk_product,fk_soc,price,tva_tx,entity,ref_fourn,datec,tms,unitprice,fk_user,quantity)";

                $sql.= " VALUES";

                $sql.= " ((";

                $sql.= " SELECT rowid FROM ".MAIN_DB_PREFIX."product";

                $sql.= " WHERE barcode =".$ligneProduct[$ean];

                $sql.= " ),";

                $sql.= $fk_supplier.','.$ligneProduct[$price].','.$tva.','.$entity.',"'.$refSupplier.$ligneProduct[$sku].'",now(),now(),'.($arrayProductPriceToUpdate[$price]/$qt).','.$user.','.$qt;

                $sql.= ')'; 



            }

            $arraySql[]=$sql;



        }



        foreach($arraySql as $ligneSql)
        {

            if($ligneSql)

            {

                $resql = $db->query($ligneSql);

                addLogEvent($ligneSql);



                if ($resql) {

                    print "replace llx_product_fourn ok : ";

                    print $ligneSql;





                    print '<br/>';

                    $compteurPriceReplaced += 1;



                }

                else{

                    print "replace llx_product_fourn pbm : ";

                    print $ligneSql;



                    print '<br/>';



                    print "le prix du produit: (".$fk_product.") existe déjà <br/>";



                } 

            }   

            

        }

    */
    return $compteurPriceReplaced;
}

// Replace multiRow the row in Table Product Stock
function replaceIntoProductStock($arrayProductQtteToReplace,$fk_warehouse,$user){

    global $db;

    $error	= 0;

    $ean    = 0;
    $sku    = 1;
    $label  = 2;
    $qtte   = 3;
    $price  = 4;

    $premier = true;
    $arrayEanStockUpdated = array();

    $sql = "REPLACE INTO ".MAIN_DB_PREFIX."product_stock";
    $sql.= " (fk_product, fk_entrepot,reel, tms )";
    $sql.= " VALUES";
    foreach ($arrayProductQtteToReplace as $ligneProduct)
    {
        if($ligneProduct)
        {
            $sql2 = " ((";
            $sql2.= " SELECT rowid FROM ".MAIN_DB_PREFIX."product";
            $sql2.= ' WHERE barcode ="'.$ligneProduct[$ean].'"';
            $sql2.= " ),";
            $sql2.= $fk_warehouse.",".$ligneProduct[$qtte].",now())"; 

            if($premier)
            {
                $premier = false;
                $sql.= $sql2;
            }

            else
            {
                $sql.= ','.$sql2;
            }

            $arrayEanStockUpdated[] = $ligneProduct[$ean];
        }
    }

    $resql = $db->query($sql);
    addLogEvent($sql);
    if ($resql)
    {
            $compteurQtteReplaced += 1;

            foreach($arrayEanStockUpdated as $ean)
            {
                if($ean)
                {
                    if($idobject   =   getRowIdProduct($ean))
                    {
                        $newobject  =   new Product($db);
                        $newobject->fetch($idobject);
                        $newobject->entrepot_id   = $fk_warehouse;
                        $newobject->product_id    = $newobject->id;
                        $result     =   $newobject->call_trigger('PRODUCT_STOCK_MOVEMENT_STOCK_CSV',$user);

                        if ($result < 0) $error++;
                    }

                    else
                    {
                        EanBugTrigger($ligneProduct[$ean]);
                    }
                }
            }
    }

    else
    {
        ErrorSql($sql);
    }  

    return $compteurQtteReplaced;
}

// Useless
function viderStockApresNbJour($EmptyPartnerStock){

    if($EmptyPartnerStock)
    {
        // Dans le mapping la valeur est Oui
        return true;
    }

    else
    {
        // Dans le mapping la valeur est Non
        return false;
    }
}

// fichier.log
function addLogEvent($event){

    $time = date("D, d M Y H:i:s");
    $time = "[".$time."] ";
    $event = $time.$event."\n";

    file_put_contents(DOL_DOCUMENT_ROOT.'/custom/stockcsv/log/fichier.log', $event, FILE_APPEND);

}

// BacASable.log
function ErrorLogEan($ean, $fk_supplier, $sku){

    // si le fichier exist

    if(file_exists(DOL_DOCUMENT_ROOT.'/custom/stockcsv/log/BacASable.log'))
    {
        $file   = file_get_contents(DOL_DOCUMENT_ROOT.'/custom/stockcsv/log/BacASable.log', true);
        $file   = str_replace(array("\n","\r\n","\r"),"",$file);
        $champs = explode(";", $file);

        // si l'ean n'est pas déjà dans le fichier
        if(!in_array($ean,$champs))
        {
            $ean = $ean.'|'.$fk_supplier.'|'.$sku.";\n";
            file_put_contents(DOL_DOCUMENT_ROOT.'/custom/stockcsv/log/BacASable.log', $ean, FILE_APPEND);
        }
    }

    else
    {
        // on creer le fichier
        $ean = $ean.'|'.$fk_supplier.'|'.$sku.";\n";
        file_put_contents(DOL_DOCUMENT_ROOT.'/custom/stockcsv/log/BacASable.log', $ean, FILE_APPEND);
    }
}

// EanBugTrigger.log
function EanBugTrigger($ean){

    // si le fichier exist
    if(file_exists(DOL_DOCUMENT_ROOT.'/custom/stockcsv/log/EanBugTrigger.log'))
    {
        $file   = file_get_contents(DOL_DOCUMENT_ROOT.'/custom/stockcsv/log/EanBugTrigger.log', true);
        $file   = str_replace(array("\n","\r\n","\r"),"",$file);
        $champs = explode(";", $file);

        // si l'ean n'est pas déjà dans le fichier
        $ean = $ean.";\n";
        //file_put_contents(DOL_DOCUMENT_ROOT.'/custom/stockcsv/log/EanBugTrigger.log', $ean, FILE_APPEND);
    }

    else
    {
        // on creer le fichier
        $ean = $ean.";\n";
        //file_put_contents(DOL_DOCUMENT_ROOT.'/custom/stockcsv/log/EanBugTrigger.log', $ean, FILE_APPEND);
    }
}

// errorSQL.log
function ErrorSql($event){

    $time   = date("D, d M Y H:i:s");
    $time   = "[".$time."] ";
    $event  = $time.$event."\n";
    file_put_contents(DOL_DOCUMENT_ROOT.'/custom/stockcsv/log/errorSQL.log', $event, FILE_APPEND);
}

function formattingRowCSV($champs,$arrayTerms,$arrayEAN,$arraySKU,$priceMinHT,$isTTC,$tva){
  
    $EAN = 0;
    $SKU = 1;
    $LABEL = 2;
    $QTTE = 3;
    $PRIX = 4;

    if(!isset($champs[$EAN]) ||!isset($champs[$SKU]) ||!isset($champs[$LABEL]) ||!isset($champs[$QTTE])||!isset($champs[$PRIX]))
        return;

    // On supprime les guillemets simple et double 
    $champs[$EAN]=str_replace   (array("\"", "\"\""), "",$champs[$EAN]);
    $champs[$SKU]=str_replace   (array("\"", "\"\""), "",$champs[$SKU]);
    $champs[$LABEL]=str_replace (array("\"", "\"\""), "",$champs[$LABEL]);
    $champs[$QTTE]=str_replace  (array("\"", "\"\""), "",$champs[$QTTE]);
    $champs[$PRIX]=str_replace  (array("\"", "\"\""), " ",$champs[$PRIX]);

    // PARTIE SKU

    // On commence par traiter les sku pour les comparer aux EAN 12

    // si les 5 derniers nombres des sku sont egaux à ceux de l'EAN

    if (substr($champs[$SKU],-5) == substr($champs[$EAN],-5)) return ;

    // PARTIE EAN

    // si les 3 premiers nombres de l'EAN sont egaux à 978 ( => livres )
    if (substr($champs[$EAN],0,3) == "978") return ;

    // si les 3 premiers nombres de l'EAN sont egaux à 979 ( => livres )
    if (substr($champs[$EAN],0,3) == "979") return ;

    // recupere sa taille
    $tailleEAN = strlen($champs[$EAN]);

    // si les l'EAN n'est ni un EAN 12 ni 13
    if ($tailleEAN < 12 || $tailleEAN >13) return ;

    // si c'est un EAN 12 on calcul son EAN 13
    if ($tailleEAN == 12)
    {
        $calcul = (($champs[$EAN][1]+$champs[$EAN][3]+$champs[$EAN][5]+$champs[$EAN][7]+$champs[$EAN][9]+$champs[$EAN][11])*3)+($champs[$EAN][0]+$champs[$EAN][2]+$champs[$EAN][4]+$champs[$EAN][6]+$champs[$EAN][8]+$champs[$EAN][10]);

	    // $champs[$EAN][X] où X correspond à la position du caractère dans la chaine. Le premier caractère équivaut à l'emplacement 0.
      
        // On récupère la dernière unité de $calcul
        $unite = substr($calcul,-1, 1); 

        // On vérifie que $unite ne soit pas égale à 0
        if($unite!=0) 

            $clef = 10-$unite; 

        else 

            $clef=0;

        $champs[$EAN] = $champs[$EAN].$clef;
    }

    //si l'EAN 13 fait parti des EAN à exclure
    if(in_array($champs[$EAN],$arrayEAN)) return ;

    if(in_array($champs[$SKU],$arraySKU)) return ;

    // PARTIE LABEL
    // on compare mot par mot
    // cherche si le mot est dans le tableau des terms à exclure
    foreach($arrayTerms as $term)
    {
        if(stristr(strtoupper($champs[$LABEL]),$term))
       	//if(stristr($champs[$LABEL],$term)) 
        {
            return;
        }
    }

    // PARTIE PRIX
    // changer le prix TTC en HT
    if($isTTC == 'TTC')
    {
        $champs[$PRIX] = $champs[$PRIX] / (1+($tva/100));
    }

    // si le prix est inferieur à celui du mapping
    if ($champs[$PRIX] < $priceMinHT) return;

    // PARTIE QTTE
    // si décimal arrondir à l'entier inférieur
    $champs[$QTTE] = floor($champs[$QTTE]);

    return $champs;
}

// Get all the Price & Stock for each product of the supplier (show barcode, owid, qty, price)

function load_stock($fournId,$warehouseId){

    global $db;

    $result = array();

    $sql = "SELECT p.barcode as EAN, p.rowid as rowid, ps.reel as reel, pfp.price as price";
    $sql.= " FROM ".MAIN_DB_PREFIX."product as p";
    $sql.= ' LEFT JOIN '.MAIN_DB_PREFIX.'product_fournisseur_price as pfp ON pfp.fk_product = p.rowid';
    $sql.= ' LEFT JOIN '.MAIN_DB_PREFIX.'product_stock as ps ON ps.fk_product = p.rowid';
    $sql.= ' WHERE pfp.fk_soc ='.$fournId;
    $sql.= " AND ps.fk_entrepot =".$warehouseId;
    $sql.= " AND pfp.entity IN (".getEntity('stock', 1).")";

    //print $sql;
    $EAN    = 0;
    $rowid  = 1;
    $qtte   = 2;
    $price  = 3;

    $resql = $db->query($sql);
    if ($resql)
    {
        $nbResult = $db->num_rows($result);
        $compteurligne=0;
        if ($nbResult > 0)
        {
            while ($compteurligne < $nbResult)
            {
                $obj = $db->fetch_object($resql);

                $result[$compteurligne][$EAN]              = $obj->EAN;
                $result[$compteurligne][$rowid]            = $obj->rowid;
                $result[$compteurligne][$qtte]             = $obj->reel;
                $result[$compteurligne][$price]            = $obj->price;

                $compteurligne ++;
            }
        }

        else
        {
            ErrorSql($sql);
            //requete vide
        }
    }

    else
    {
        ErrorSql($sql);
        //error requete
    }
    return $result;
}

// Get all the Price & Stock for each product of the supplier (show barcode)
function load_stockEAN($fournId,$warehouseId){

    global $db;

    $resql = array();

    $sql = "SELECT p.barcode as EAN";
    $sql.= " FROM ".MAIN_DB_PREFIX."product as p";
    $sql.= ' LEFT JOIN '.MAIN_DB_PREFIX.'product_fournisseur_price as pfp ON pfp.fk_product = p.rowid';
    $sql.= ' LEFT JOIN '.MAIN_DB_PREFIX.'product_stock as ps ON ps.fk_product = p.rowid';
    $sql.= ' WHERE pfp.fk_soc ='.$fournId;
    $sql.= " AND ps.fk_entrepot =".$warehouseId;
    $sql.= " AND pfp.entity IN (".getEntity('stock', 1).")";

    $EAN    = 0;

    $resql = $db->query($sql);
    if ($resql)
    {
        $nbResult = $db->num_rows($resql);
        $compteurligne=0;
        if ($nbResult > 0)
        {
            while ($compteurligne < $nbResult)
            {
                $obj = $db->fetch_object($resql);

                $result[$compteurligne]              = $obj->EAN;

                $compteurligne ++;
            }
        }

       else
        {
           ErrorSql($sql);
            //requete vide
        }
    }
    else
    {
        ErrorSql($sql);
        //error requete
    }
    return $result;
}

// Replace a row in Table Supplier States
function replaceIntoSupplierStates($supplier, $state, $process, $details, $nbProdCreate, $nbProdUpdate, $nbProdError, $time, $duration, $user, $entity=1){
    
    global $db;

    $compteurQtteInserted = 0;

    $sql = "REPLACE INTO ".MAIN_DB_PREFIX."supplier_states";
    $sql.= " (date, fk_supplier, state, process, details, productCreate, productUpdate, productError, user, hoursUpdate, duration, entity )";
    $sql.= " VALUES";
    $sql.= " (";
    $sql.= " now(), '".$supplier."', '".$state."', '".$process."', '".$details."','".$nbProdCreate."','".$nbProdUpdate."','".$nbProdError."', '".$user->id."', '".$time."','".$duration."' , '".$entity."')";
            
    $resql = $db->query($sql);
    addLogEvent($sql);
    if ($resql)
    {
        // done
    }

    else
    {
        ErrorSql($sql);
    } 
        
    return $compteurQtteInserted;
}

// Delete all the row in Table Supplier States after 7 days pass
function deleteSupplierState(){

    global $db;

    $sql.= 'DELETE FROM '.MAIN_DB_PREFIX.'supplier_states';
    $sql.= ' WHERE TO_DAYS(now() ) - TO_DAYS(date) >=7';
    
    $resql = $db->query($sql);
    addLogEvent($sql);

    if ($sql)
    {
        //ok
    }
    else
    {
        ErrorSql($sql);
    }

}

// Body mail message
function message($details="Vous trouverez les ean en piece jointe", $user){

	global $langs;

    $langs->load("stockcsv@stockcsv");

    $message = $langs->trans("HelloCSV").'<br/><br/>';
    $message.= $details.'<br/><br/>';

    $message.="SAS BRUMAN";
    $message.='<br/>';
    $message.='<br/>';

    $message.= $user->firstname. ' ' . $user->lastname;
    $message.='<br/>';
    $message.='<br/>';

    return $message;
}

// Send mail if csv bug
function sendMailPbmCsv($details, $object, $user){
    

    global $conf,$db,$langs;

    $langs->load("stockcsv@stockcsv");

    // à ajouter aux const du mapping

    $today  = new DateTime("now");

    $constmailToAdresse = $conf->global->MAIN_INFO_SOCIETE_MAIL;
    $constmailToLabel = $conf->global->MAIN_INFO_SOCIETE_NOM;
    

    //$filename_list = array();
    require_once DOL_DOCUMENT_ROOT.'/user/class/user.class.php';

    $message = message($details,$user);

    $subject = $langs->trans("ErrorProcessAuto");
    $subject.= $object;

    $emailFrom = $user->email; // robot
    $emailTo = $constmailToAdresse; // champs mail table constante
    

    $filename_list = array();
	$mimetype_list = array();
	$mimefilename_list = array();
    $msgishtml=1;

    //$filename_list[]        = $pathficToSend;
    //$mimefilename_list[]    = "Ean error the ".$today->format("d M Y - h:m:s");

    // $subject,$sendto,$replyto,$message,$filepath,$mimetype,$filename,$cc,$ccc,$deliveryreceipt,$msgishtml,$errors_to,$css,$trackid,$moreinheader,$sendcontext
	$mailfile = new CMailFile($subject, $emailTo, $emailFrom, $message, $filename_list, $mimetype_list, $mimefilename_list , '', '', $deliveryreceipt=0, $msgishtml, $conf->global->MAIN_MAIL_ERRORS_TO);

    /*$mailfile = new CMailFile(  $subject,
                                $emailTo,
                                $emailFrom,
                                $message,
                                "",
                                "",
                                "",
                                "",
                                "",
                                "",
                                $msgishtml
                            );*/

                                //$mailfile -> dump_mail();
              
    if(!$mailfile->error)
    {
        $result = $mailfile->sendfile();
        /*if ($result)
        {
            print 'Le message a bien été envoyé<br/>';
        }
        else{
            print 'Une erreur est survenue lors de l\'envoie du mail<br/>';					
        }*/
    }

    else
    {
        setEventMessages($mail->error, $mail->errors, 'errors');
    }

}

// Send mail ean error
function sendMailEanError($user){
    
    global $conf, $db, $langs;

    $langs->load("stockcsv@stockcsv");

    //$pathficToSend = '/custom/stockcsv/log/BacASable.log';
    $pathficToSend = DOL_DOCUMENT_ROOT.'/custom/stockcsv/log/BacASable.log';
    if(file_exists($pathficToSend))
    {
        // à ajouter aux const du mapping
        $today                  = new DateTime("now");
        $todayEan               = date_format($today, "d/m/Y - H:i:s");

        $constmailToAdresse = $conf->global->MAIN_INFO_SOCIETE_MAIL;
        $constmailToLabel = $conf->global->MAIN_INFO_SOCIETE_NOM;

        require_once DOL_DOCUMENT_ROOT.'/user/class/user.class.php';

        $subject = $langs->trans("ErrorEANToday");
        $emailFrom = $user->email; // robot
        $emailTo = $constmailToAdresse; // champs mail table constante
        $message = message('',$user);

        
        $filename_list[]        = $pathficToSend;
        //$mimefilename_list[]    = "Ean error the ".$today->format("d M Y - H:i:s");
        //$mimefilename_list[]    = "Ean error the ".date_format($today, "d/m/Y - H:i:s");
        $mimefilename_list[]    = $langs->trans("Eanerrorthe", $todayEan).'.log';
        //$mimefilename_list[];
		$msgishtml=1;

        $mailfile = new CMailFile($subject, $emailTo, $emailFrom, $message, $filename_list, $mimetype_list, $mimefilename_list , '', '', $deliveryreceipt=0, $msgishtml, $conf->global->MAIN_MAIL_ERRORS_TO);


        //$mailfile = new CMailFile($subject, $emailTo, $emailFrom, $message, $filename_list, $mimetype_list, $mimefilename_list, "", "", $msgishtml);

        //$mailfile -> dump_mail();

        if(!$mailfile->error)
        {
            $result = $mailfile->sendfile();
        } 

        else
        {
            setEventMessages($mail->error, $mail->errors, 'errors');
        }
    }

}
// Best display ever
function affichagePascal($total_pdt, $compteurLigneCsvSale, $arrayCSVResult, $arrayProductPriceToUpdate, $arrayProductQtteToUpdate, $nbProdQtteUpdate, $nbProdPriceUpdate, $arrayProductToCreate, $nbProdCreate, $errorProduct, $compteurChangement, $arrayProductToReplace, $arrayLoadTable){

    $details = 'nb Produit Load Table  : '.$total_pdt;
    $details.= '<br/>';


    $details.= 'nb Produit dans le csv "sale" : '.$compteurLigneCsvSale ;
    $details.= '<br/>';
        
    // -1 car derniere ligne vide.
    $details.= 'nb Produit dans le csv "propre" : '.(count($arrayCSVResult)-1) ;
    $details.= '<br/>';


    $details.= 'Produit(s) à modifier : ' .$compteurChangement;


    $details.= 'Produit(s) qui sont créé(s): '.$nbProdCreate;
    $details.= '<br/>';
    $details.= "Produit(s) avec une création erronée : ".$errorProduct;
    $details.= '<br/>';


    $details.= 'Produit(s) load table replace(s) (existe dans le csv mais pas dans load table => creer stock + prix ) : ';
    $details.= count($arrayProductToReplace);
    $details.= '<br/>';
    
    $details.= 'Produit(s) load table non traité (existe dans load table mais pas dans le csv => delete + stock 0) : ';
    $details.= count($arrayLoadTable);
    $details.= '<br/>';

    return $details;
}

// Normal display
function affichageBasiqueSimple($arrayCSVResult,$nbProdCreate,$errorProduct,$compteurChangement,$arrayProductToCreate){
	
	global $langs;

    $langs->load("stockcsv@stockcsv");

    //$details = 'Produit dans le csv "propre" : '.(count($arrayCSVResult)-1) ;
    $details = '<b>'.date("H:i:s").'</b><br/>';
    $details.= $langs->trans("ProductCsvPropre").' '.(count($arrayCSVResult)-1) ;
    $details.= '<br/>';
    //$details.= 'Produit(s) qui sont créé(s): '.$nbProdCreate;
    $details.= $langs->trans("ProduitCreate").' '.$nbProdCreate;
    $details.= '<br/>';
    //$details.= 'Produit(s) avec une création erronée : '.$errorProduct;
    $details.= $langs->trans("ProduitError").' '.$errorProduct;
    $details.= '<br/>';
    //$details.= 'Produit(s) avec une modification réussie : '. $compteurChangement;
    $details.= $langs->trans("ProduitSucces").' '.$compteurChangement;
    $details.= '<br/>';

    return $details;

}
// Update the bdd and send a mail
function vestingPeriod($fourn,$fournNom,$details,$subject,$user){      

    global $langs;

    $langs->load("stockcsv@stockcsv");

    $supplierMapping            = 1;
    $warehouseMapping           = 2;

    deleteProductSupplierPriceGeneral($fourn[$supplierMapping],$user);
    updateProductStockTo0General($fourn[$warehouseMapping],$user);
    
    $details = $langs->trans("Partenaire")." ".$fournNom." ".$langs->trans("Stocks0Unavailable");
    //print $fournNom;
    $subject = $langs->trans("Partenaire Indisponible");

   	sendMailPbmCsv($details, $subject,$user);

    $message = $langs->trans("Unavailable");
    setEventMessage($message.' '.$fournNom, 'errors');

}

function createArrayFromCsv($pathFic,$arrayEAN,$arrayTerms,$arraySKU,$arrayTableConst,$fourn,$fournNom, $user){
                    
    //realCsv($pathFic);
    // Parcourir le tableau creer via la table mapping
    $price_typeMapping          = 7;
    $tvaMapping                 = 9;

    // Parcourir le tableau creer via la table constante
    $priceHT                = 2;
    // On recupere seulement la data (ean)
    // fonction qui enleve les \n
    //realCsv($pathFic);
    // On ouvre le fichier csv
    $fic = fopen($pathFic, "r");

    $compteurlignes = 0;
    $compteurLigneCsvSale =0;
    // On parcours tout le fichier 
    
    while(!feof($fic))
    {
        // On recupere ligne par ligne 
        $ligne = fgets($fic);

        // On delimite les champs de chaque ligne par les ";"
        $champs = explode(";", $ligne);

        // On transforme les champs pour afficher les caractères
        $champs = array_map("utf8_encode", $champs);
        // On recupere le csv formalisé
       
        if($arrayCSVResult[$compteurlignes] = formattingRowCSV($champs,
                                                    $arrayTerms,
                                                    $arrayEAN,
                                                    $arraySKU,
                                                    $arrayTableConst[$priceHT],
                                                    $fourn[$price_typeMapping],
                                                    $fourn[$tvaMapping]))
        {
            $compteurlignes ++;
        }       
    }

    // Fermeture du fichier
    fclose($fic);

    $arrayCSVResult = unique_multidim_array_with_mail($arrayCSVResult,0,$fournNom, $user);

    return $arrayCSVResult;
}

function checkOlderFicExist($fournNom,$fourn,$viderStockApresNbJour,$pathFic,$absolutPathFtp,$nbDayBeforeDeleteCst,$dateDepart,$user){

	global $langs;

    $langs->load("stockcsv@stockcsv");

    // Parcourir le tableau creer via la table mapping
    $supplierMapping            = 1;
    $warehouseMapping           = 2;
    $folder_csvMapping          = 3;
    $mask_csvMapping            = 4;

    $details = $langs->trans("NoFileSupplier")." ".$fournNom;

    $ficfound = false;
    $message = $langs->trans("NoFic");
    setEventMessage($message.' '.$fournNom, 'errors');
    $compteurJour = 0;
    if($viderStockApresNbJour)
    {
        while($compteurJour < $nbDayBeforeDeleteCst && !$ficfound)
        {
            //print 'test';
            if(file_exists($pathFic))
            {
                $ficfound = true;                        
            }

            else
            {
                
                $dateDepart->modify('-1 day');
           
              	$namefic = $fourn[$mask_csvMapping].$dateDepart->format('Ymd').".csv";
                $pathFic = $absolutPathFtp.'/'.$fourn[$folder_csvMapping].'/'.$namefic;

                //print '<p style="color: red;">/!\ Pas de fichier ici  </p><br/>';

                $compteurJour +=1;
            }
        }

        if($compteurJour == $nbDayBeforeDeleteCst)
        {

            deleteProductSupplierPriceGeneral($fourn[$supplierMapping],$user);
            updateProductStockTo0General($fourn[$warehouseMapping],$user);
            $details.=' '.$langs->trans("StocksMissingToDay");
        }
    } // fin du if vider stock

    $subject = $langs->trans("MissingFile");
    sendMailPbmCsv($details, $subject,$user);
}
