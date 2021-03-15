<?php
date_default_timezone_set('Europe/Paris');
        // on cherche tant qu'on a pas depassé la limite de jour (mapping)

        /*
    
    
    
    
    
            // On remet à la date du jour pour le prochain fourn
        if($compteurJour != 0)
        {
            $compteurJour = $compteurJour -1;
            $DateDepart->modify('+'.$compteurJour.' day');
        }
    
    */


        //$user=new User($db);

        //$user->fetch($rowIDRobot);        // robot;

        // id user = 4;


        // PROCESS LIB
function updateProductSupplierPrice     ($arrayProductPriceToUpdate,$idFourn,$tva,$user,$entity=1,$qt =1){

    global $db;

    $ean                    = 0;
    $sku                    = 1;
    $label                  = 2;
    $qtte                   = 3;
    $price                  = 4;
    $compteurPriceUpdated   = 0;

    $sql ='';

    foreach ($arrayProductPriceToUpdate as $ligneProduct){

        if($ligneProduct){

            $sql2 = '(SELECT p.rowid FROM '.MAIN_DB_PREFIX.'product as p';
            $sql2.= ' WHERE p.barcode ='.$ligneProduct[$ean];
            $sql2.= ')';

            $sql.= 'UPDATE '.MAIN_DB_PREFIX.'product_fournisseur_price';
            $sql.= ' SET price ="'.$ligneProduct[$price].'"';
            $sql.= ' ,tms = now()';
            $sql.= ' ,tva_tx ='.$tva;
            $sql.= ' ,fk_user ='.$user->id;
            $sql.= ' ,entity ='.$entity;
            $sql.= ' ,unitprice ='.($ligneProduct[$price]/$qt);
            $sql.= ' ,quantity ='.$qt;
            $sql.= ' WHERE fk_soc = '.$idFourn;
            $sql.= " AND fk_product = ".$sql2.";";
        }
    }
    $resql = $db->query($sql);

    addLogEvent($sql);

    if ($resql){

        $compteurPriceUpdated +=1;

    }
    else{

        ErrorSql($sql);
    }
    
    
    return $compteurPriceUpdated;
}



    // COMMANDE EN COURS LIB
foreach($arrayProductChanged as $ligneProductChanged){
    $priceHT = $arrayProductSellPrice[$ligneProductChanged[$fk_product]];
    $priceTTC = $priceHT * (1+$ligneProductChanged[1]/100);
    if($priceTTC <= $sellPriceMinTo10){
        $priceHT    = 10;
        $priceTTC   = 10;
    }
    else{
            $priceHT    *= $coefMarge;
            $priceTTC   *= $coefMarge;
    }
    $sql = "UPDATE ".MAIN_DB_PREFIX."product SET ";
    $sql.= " price =".$priceHT.",";
    $sql.= " price_ttc =".$priceTTC;
    $sql.= " WHERE rowid =".$ligneProductChanged[$fk_product];
    $resql = $db->query($sql);       
    if($resql){
        addLogEvent($sql);
    }else{

        ErrorSql($sql);
    }

    //$sql2 = "DELETE FROM ".MAIN_DB_PREFIX."product_price";
    //$sql2.= " WHERE fk_product=".$ligneProductChanged[$fk_product];
    //$resql2 = $db->query($sql2);    
    //if($resql2){
    //    addLogEvent($sql2);
    //}
    //else{
    //    ErrorSql($sql2);
    //}
    $sql3 = " REPLACE INTO ".MAIN_DB_PREFIX."product_price";
    $sql3.= " (entity, fk_product, date_price, price, price_ttc, price_base_type, tva_tx, tosell, fk_user_author)";

    $sql3.= " VALUES ";


    /*
        $sql1.= $tblProduct[$rowidProduct][$sku].',';
        $sql1.= $tblProduct[$rowidProduct][$label].',';
        $sql1.= $tblProduct[$rowidProduct][$description].',';
        $sql1.= $tblProduct[$rowidProduct][$sbarcodeku].',';
        $sql1.= $tblProduct[$rowidProduct][$sku].',';
        $sql1.= $tblProduct[$rowidProduct][$sku].',';
        $sql1.= $tblProduct[$rowidProduct][$sku].',';
        $sql1.= $tblProduct[$rowidProduct][$sku].',';
        $sql1.= $tblProduct[$rowidProduct][$sku].',';

        $sku                    = 0;
        $description            = 1;
        $barcode                = 2;
        $accountancy_code_sell  = 3;
        $accountancy_code_buy   = 4;
        $fk_user_author         = 5;
        $datec                  = 6;
        $label                  = 7;
        $entity                 = 8;
        $tblProduct[$rowidProduct][$sku].',' label, description, barcode,fk_barcode_type,
        entity,accountancy_code_sell,accountancy_code_buy,fk_user_author,tms,datec,price,price_ttc)";


    */

    $sql3.= " (".$entity.", ";
    $sql3.= $ligneProductChanged[$fk_product].", ";
    $sql3.= "now(), ";
    $sql3.= $priceHT.", ";
    $sql3.= $priceTTC.", ";
    $sql3.= '"HT", ';

    $sql3.= $ligneProductChanged[1].", ";
    $sql3.= "1, ";
    $sql3.= $user->id;
    $sql3.= ")";

    $resql3 = $db->query($sql3);    
    if($resql3){
        addLogEvent($sql3);
    }
    else{
        ErrorSql($sql3);
    }
}
































































function getAllTableProduct(){

    global $db,$langs;

    $sku                    = 0;
    $theDescription         = 1;
    $barcode                = 2;
    $typeBarcode            = 3;
    $accountancy_code_sell  = 4;
    $accountancy_code_buy   = 5;
    $fk_user_author         = 6;
    $datec                  = 7;
    $label                  = 8;
    $entity                 = 9;

    $result = array();
    
    // on recupere les products des commandes
    $sql = ' SELECT p.rowid as rowid, p.ref as sku ,p.description as theDescription ,p.barcode as barcode, fk_barcode_type as typeBarcode';
    $sql.= ' p.accountancy_code_sell as accountancy_code_sell, p.accountancy_code_buy as accountancy_code_buy,';
    $sql.= ' p.fk_user_author as fk_user_author, p.datec as datec, p.label as label, p.entity as entity';
    $sql.= ' FROM '.MAIN_DB_PREFIX.'product as p';
	$sql.= ' WHERE p.entity =1 ';				


    $resql = $db->query($sql);


    if($resql){

        while($obj = $db->fetch_object($resql))
        {
            $result[$obj->rowid][$sku]                          = $obj->sku;
            $result[$obj->rowid][$theDescription]               = $obj->theDescription;
            $result[$obj->rowid][$barcode]                      = $obj->barcode;
            $result[$obj->rowid][$typeBarcode]                  = $obj->typeBarcode;
            $result[$obj->rowid][$accountancy_code_sell]        = $obj->accountancy_code_sell;
            $result[$obj->rowid][$accountancy_code_buy]         = $obj->accountancy_code_buy;
            $result[$obj->rowid][$fk_user_author]               = $obj->fk_user_author;
            $result[$obj->rowid][$datec]                        = $obj->datec;
            $result[$obj->rowid][$label]                        = $obj->label;
            $result[$obj->rowid][$entity]                       = $obj->entity;
        }
        return $result;
    }else{

        ErrorSql($sql);
        $message = $langs->trans("TableMappingEmpty");
        setEventMessage($message,'errors');
    }
}









































                        /*
                        if(in_array($lignesCSVResult[$csvEAN],$arrayRequestBdd,true))
                        {
                                // On recupere la colonne EAN du CSV "propre" 
                                $arrayCSVResultEANInTableLoad[] = $lignesCSVResult[$csvEAN];
                        }*/








                    // pour chaque ligneCSV
                    // est elle dans le tableau des lignesRequest
                    //  -> ok 
                    //      la qtte est different ?
                    //                  on met le boolean change à True
                    //
                    //      le prix est different ?
                    //                  on met le boolean change à True
                    //      -> boolean change = True 
                    //                  -> ok insere dans une table avec les valeurs du csv
                    //  -> ko
                    //      create le pdt dans dolibarr




























                        // pour chaque ligne du fichier csv "propre"
                    /*foreach($arrayCSVResult as $lignesCSV)
                    {
                        // On verifie que la ligne existe
                        if($lignesCSV)
                        {
                            // On regarde si la ligne n'appartient pas au Tableau des EAN du fournisseur
                            if(!in_array($lignesCSV[$csvEAN],$arrayStockEANProducts,true)){



                                
                                // checker si le produit est bien dans la table product (faire un array)
                                // regle le pbm des EAN à exclure ?

                                insertIntoProduct($lignesCSV[$csvSKU],
                                                $lignesCSV[$csvLABEL],
                                                $lignesCSV[$csvEAN],
                                                $entity=1);
                                
                                $rowidProduct= getRowIdProduct($lignesCSV[$csvEAN]);
                                
                                //checker si le produit n'est pas dans la table product
                                insertIntoProductSupplierPrice($rowidProduct,
                                                            $fourn[$supplierMapping],
                                                            $lignesCSV[$csvPRICE],
                                                            $tva,
                                                            $entity=1);

                                //checker si le produit n'est pas dans la table product
                                                           
                                insertIntoProductSock($rowidProduct,
                                                    $fourn[$warehouseMapping],
                                                    $lignesCSV[$csvQTTE]);  

                                                    
                                $compteurCreate = $compteurCreate +1;                                
                            }

                        $change = false;
                        // on a la ligne du tableau creer sur lequel ce situe l'EAN
                            
                        $ligneTableRequeteATraiter = array_search($lignesCSV[$csvEAN], $arrayStockEANProducts); 

                        // On regarde mtn si les données correspondent
                            if($arrayRequestBdd[$ligneTableRequeteATraiter][$qtProduct] != $lignesCSV[$csvQTTE])
                            {
                                updateProductStock($lignesCSV[$csvQTTE],
                                                $fourn[$warehouseMapping],
                                                $arrayRequestBdd[$ligneTableRequeteATraiter][$rowIdProduct]);
                                                $change = true;
                                                
                            }

                            if($arrayRequestBdd[$ligneTableRequeteATraiter][$priceProduct] != $lignesCSV[$csvPRICE])
                            {
                                updateProductSupplierPrice($lignesCSV[$csvPRICE],
                                                        $fourn[$supplierMapping],
                                                        $arrayRequestBdd[$ligneTableRequeteATraiter][$rowIdProduct]);
                                
                                $change = true;
                                //log
                            }
                            
                            if($change){
                                $compteurChangement = $compteurChangement +1;
                            }
                        }
                    }*/


































/*

// si le produit n'existe pas
                        if(!in_array($lignesCSVResult[$csvEAN],$arrayTableProductbyEAN)){

                            $notCreate++;
                            //print $lignesCSVResult[$csvEAN];
                            print "<br/>";

                            insertIntoProduct(  $lignesCSVResult[$csvSKU],
                                                $lignesCSVResult[$csvLABEL],
                                                $lignesCSVResult[$csvEAN],
                                                $accountancy_code_sell,
                                                $accountancy_code_buy);

                            $compteurCreate = $compteurCreate +1;             
                                                
                            // si un pdt a bien été crée
                       
                            if($rowid = getRowIdProduct($lignesCSVResult[$csvEAN])){

                                $refSupplier = $fourn[$prefix_supplierMapping].$lignesCSVResult[$csvSKU];

                                insertIntoProductSock(  $fk_product,
                                                        $fourn[$warehouseMapping],
                                                        $lignesCSVResult[$csvQTTE]);

                                insertIntoProductSupplierPrice( $fk_product,
                                                                $fourn[$supplierMapping],
                                                                $lignesCSVResult[$csvPRICE],
                                                                $tva,
                                                                '',
                                                                $refSupplier);
                                $compteurChangement = $compteurChangement+1;
                            }
                        }
                        else{ // si le produit exist
                            $exist++;
                            print "<br/>";

                            $qtteReplace = 0;
                            $priceReplace = 0;

                            if($fk_product = getRowIdProduct($lignesCSVResult[$csvEAN])){

                                // on a la ligne du tableau creer sur lequel ce situe l'EAN
                                // si le ean du csv result est dans la requete table
                                // donc qu'il existe un stock et un prix
                                if($ligneTableRequestATraiter = array_search($lignesCSVResult[$csvEAN],$arrayRequestEANBdd)){

                                    //si les qtte ne correspondent pas
                                        if($lignesCSVResult[$csvQTTE] != $arrayRequestBdd[$ligneTableRequestATraiter][$qtProduct]){
                                            print "qtte not match";
                                            print $arrayRequestBdd[$ligneTableRequestATraiter][$qtProduct]; 
                                            print " != ";
                                            print $lignesCSVResult[$csvQTTE];
                                            print "<br/>";

                                            $qtteReplace = $lignesCSVResult[$csvQTTE]; 
                                            updateProductStock( $qtteReplace,
                                                                $fourn[$warehouseMapping],
                                                                $fk_product);         
                                            $change = true;

                                        }
            
                                        // si les price ne correspondent pas
                                        if($lignesCSVResult[$csvPRICE] != $arrayRequestBdd[$ligneTableRequestATraiter][$priceProduct] ){
                                            print "price not match : ";
                                            print $arrayRequestBdd[$ligneTableRequestATraiter][$priceProduct];
                                            print " != ";
                                            print $lignesCSVResult[$csvPRICE];
                                            print "<br/>";

                                            $priceReplace = $lignesCSVResult[$csvPRICE];

                                            updateProductSupplierPrice( $fk_product,
                                                                        $priceReplace,
                                                                        $fourn[$supplierMapping],
                                                                        $refSupplier,
                                                                        $tva);

                                            $change = true;

                                        }
                                
                                }
                                else{ // il n'existe pas de stock / pas de prix

                                    $compteurPasdeStock ++;
                                    print 'ici';
                                    insertIntoProductSock(  $fk_product,
                                                            $fourn[$warehouseMapping],
                                                            $qtteReplace);

                                    insertIntoProductSupplierPrice( $fk_product,
                                                                    $fourn[$supplierMapping],
                                                                    $priceReplace,
                                                                    $tva,
                                                                    '',
                                                                    $refSupplier);
                                }
                            }
                            
                            // si les qtte ne correspondent pas
                            //arrayRequestBdd()


                            if($change){

                                $compteurChangement = $compteurChangement +1;

                            }
                            if(true){// product stock empty
                                //insertIntoProductSock($fk_product,$fk_warehouse,$qtte);
                                //insertIntoProductSupplierPrice($fk_product,$fk_supplier,$price,$tva,$entity=1,$refSupplier)
                            }


*/


SELECT p.barcode as EAN, p.rowid as id, ps.reel as reel, pfp.price as price 
FROM llx_product as p
LEFT JOIN llx_product_fournisseur_price as pfp ON pfp.fk_product = p.rowid
LEFT JOIN llx_product_stock as ps ON ps.fk_product = p.rowid
WHERE pfp.fk_soc = 38
AND ps.fk_entrepot = 1
AND pfp.entity =1;

p.29

UPDATE llx_product_stock SET reel =14 ,pmp =14 ,tms = now() 
WHERE fk_entrepot = 1 
AND fk_product = (
    SELECT p.rowid FROM llx_product as p 
    WHERE p.barcode =0638097856653
);

INSERT INTO llx_product_stock
(fk_product, fk_entrepot,reel,pmp, tms )
VALUES
((SELECT rowid FROM llx_product WHERE barcode =0638097856653 AND ref = 727512), 1,15,15,now());


if (!$resql) {
    $error ++;
    $errors[] = "Error " . $db->lasterror();
    print $sql;
    print 'mauvaise update price';
    print '<br/>';
}
else{
    return 1;
}    
if ($errors) {
    
    
    
    
    foreach ( $errors as $errmsg ) {
        dol_syslog("::updateProductSupplierPrice " . $errmsg, LOG_ERR);
        $error .= ($error ? ', ' . $errmsg : $errmsg);
    }
}









