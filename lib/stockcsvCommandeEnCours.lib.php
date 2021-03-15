<?php

require_once DOL_DOCUMENT_ROOT.'/custom/stockcsv/lib/stockcsvProcess.lib.php';
require_once DOL_DOCUMENT_ROOT.'/custom/stockcsv/lib/stockcsv.lib.php';

function EmptyWarehouse($idWarehouse){

    global $db, $langs;

    // Pour se caller sur le replaceIntoProductStock

    $barcode    = 0;
    $qtte       = 3;

    $sql = "DELETE FROM ".MAIN_DB_PREFIX."product_stock WHERE fk_entrepot=".$idWarehouse;
  
    $resql = $db->query($sql);    

    if($resql)
    {
       // print 'delete ok';
    }
    else
    {
       // print 'delete ko';
    }
}

function addToEntrepotPendingOrder($idWarehousePendingOrder){

    EmptyWarehouse($idWarehouse);

    $barcode = 0;
    $qtte = 1;
    $arrayPendingOrder = getPendingOrder();

    replaceIntoProductStock        ($arrayPendingOrder,$idWarehousePendingOrder,$user);

    //$idWarehousePendingOrder

}

function getPendingOrder(){

    global $db, $langs;

    // Pour se caller sur le replaceIntoProductStock

    $barcode    = 0;
    $qtte       = 3;


    $sql = "SELECT p.barcode as p_barcode, sum(cfd.qty) as cfd_qty";
    $sql.= " FROM ".MAIN_DB_PREFIX."commande as cf";
    $sql.= " LEFT JOIN ".MAIN_DB_PREFIX."commandedet as cfd ON cf.rowid=cfd.fk_commande";
    $sql.= " LEFT JOIN ".MAIN_DB_PREFIX."product as p ON cfd.fk_product=p.rowid";
    $sql.= " WHERE cast(cf.date_creation as date) = cast(curdate() as date) ";
    $sql.= " AND p.barcode is not null";
    $sql.= " AND cfd.fk_commandefourndet=0";
    $sql.= " GROUP BY p.barcode";

    $resql = $db->query($sql);    

    if($resql)
    {
        $compteurligne=0;
        $nbTotalLignes = $db->num_rows($resql);

        while ($compteurligne < $nbTotalLignes)
        {
            $obj = $db->fetch_object($resql);

            $result[$compteurligne][$barcode]           = $obj->p_barcode;

            $result[$compteurligne][$qtte]              = -($obj->cfd_qty);

            $compteurligne= $compteurligne + 1;
        }  
    }
    else
    {
        $message = $langs->trans("TableUnavailableEmpty");

        setEventMessage($message,'errors');
    }

    return $result;
}

function getTva($fk_soc){

    global $db, $langs;

    $sql = ' SELECT tva FROM '.MAIN_DB_PREFIX.'mapping_stockcsv';
    $sql.= ' WHERE fk_supplier ="'.$fk_soc.'"';

    $resql = $db->query($sql);

    if($resql)
    {
        $obj= $db->fetch_object($resql);

        return $obj->tva;
    }
    else
    {
        // error ...
    }
}

function updateSoldPrice($arrayProductChanged,$user,$entity=1){

    global $db, $langs;

    // determine le prix d'achat le + cher

    $fk_product     = 0;
    $sellingPrice   = 1;
    $fk_warehouse   = 2;

    $rowid = 0;
    $ht = 1;
    $ttc =2;

    $result         = array();

    $arrayConst     = array();
    $premier        = true;

    $tblConstCSV    = getTableconst_stockcsv();

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


    $sql = "SELECT fk_product, max(price) as price";
    $sql.= " FROM ".MAIN_DB_PREFIX."product_fournisseur_price as pfp";
    $sql.= " GROUP BY pfp.fk_product";

    $resql = $db->query($sql);    
    addLogEvent($sql);

    if($resql)
    {
        $compteurligne = 0;
        $nbTotalLignes = $db->num_rows($resql);
 
        while ($compteurligne < $nbTotalLignes)
        {
            $obj = $db->fetch_object($resql);

            $arrayProductSellPrice[$obj->fk_product] = $obj->price;

            $compteurligne ++;
        }        
    }
    else
    {
        ErrorSql($sql);
    }

    $sql2= " DELETE FROM ".MAIN_DB_PREFIX."product_price";
    $sql2.= " WHERE fk_product IN (";

    $sql3= " INSERT INTO ".MAIN_DB_PREFIX."product_price";
    $sql3.= " (entity, fk_product, date_price, price, price_ttc, price_base_type, tva_tx, tosell, fk_user_author,tms)";
    $sql3.= " VALUES ";

    $sql1= "REPLACE INTO ".MAIN_DB_PREFIX."product";
    $sql1.= " (ref, label, description, barcode,fk_barcode_type,
                    entity,accountancy_code_sell,accountancy_code_buy,fk_user_author,tms,datec,price,price_ttc)";    
    $sql1.= " VALUES ";


    foreach($arrayProductChanged as $ligneProductChanged)
    {
        $rowidProduct = $ligneProductChanged[$fk_product];

        $priceHT = $arrayProductSellPrice[$rowidProduct];
        $priceTTC = $priceHT * (1+$ligneProductChanged[1]/100);

        if($priceTTC <= $sellPriceMinTo10)
        {
            $priceHT    = 10;
            $priceTTC   = 10;
        }

        else
        {
                $priceHT    *= $coefMarge;

                $priceTTC   *= $coefMarge;
        }      
       
        $sql1= ' UPDATE '.MAIN_DB_PREFIX.'product SET';
        $sql1.= ' price="'.$priceHT.'",';
        $sql1.= ' price_ttc="'.$priceTTC.'"';
        $sql1.= ' WHERE rowid="'.$ligneProductChanged[$fk_product].'";';
        
        // update Product
        $resql1 = $db->query($sql1);   
        addLogEvent($sql1);

        if($resql1)
        {
        }
        else
        {
            ErrorSql($sql1);
        }

        $sql_3= " (".$entity.", ";
        $sql_3.= $rowidProduct.", ";
        $sql_3.= "now(), ";
        $sql_3.= $priceHT.", ";
        $sql_3.= $priceTTC.", ";
        $sql_3.= '"HT", ';
        $sql_3.= $ligneProductChanged[1].", ";
        $sql_3.= "1, ";
        $sql_3.= $user->id;
        $sql_3.= ", now())";

        $newobject = new Product($db);
        $newobject->fetch($rowidProduct);
        $newobject->price = $priceHT;
        $newobject->tva_tx = $ligneProductChanged[1];
        $newobject->product_id = $newobject->id;

        //$result     = $newobject    ->call_trigger('PRODUCT_CREATE_STOCK_CSV',$user);
        $result = $newobject->call_trigger('PRODUCT_SUPPLIER_BUYPRICE_UPDATE_STOCK_CSV',$user);

        if ($premier)
        {
            $sql1.= $sql_1;
            $sql2.= $rowidProduct;
            $sql3.= $sql_3;
            $premier= false;     
        }
        else
        {
            $sql1.= ", ".$sql_1;
            $sql2.= ", ".$rowidProduct;
            $sql3.= ", ".$sql_3;
        }
    }

    $sql2.= ")";
    // delete Product_price
    $resql2 = $db->query($sql2);    
    addLogEvent($sql2);

    if($resql2)
    {
    }
    else
    {
        ErrorSql($sql2);
    }

    // insert Product_price
    $resql3 = $db->query($sql3);    
    addLogEvent($sql3);

    if($resql3)
    {
    }
    else
    {
        ErrorSql($sql3);
    }
}