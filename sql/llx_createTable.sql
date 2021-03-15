CREATE TABLE IF NOT EXISTS llx_mapping_stockcsv (
	rowid 				INTEGER 		NOT NULL auto_increment PRIMARY KEY,
	fk_supplier 		INTEGER(11) 	NOT NULL,
	fk_warehouse 		INTEGER(11) 	NOT NULL,
	folder_csv			VARCHAR(255)	NOT NULL,
	mask_csv 			VARCHAR(255)	NOT NULL,
	fk_category 		INTEGER 		NOT NULL,
	prefix_supplier 	VARCHAR(255)	NOT NULL,
	price_type 			VARCHAR(3) 		NOT NULL,
	tva 				DECIMAL(5,2) 	NOT NULL,
	discount_supplier 	INTEGER 		NOT NULL,
	entity 				INTEGER 		NOT NULL DEFAULT 1
) ENGINE=innodb;


CREATE TABLE IF NOT EXISTS llx_const_stockcsv(
	rowid 								INTEGER 		NOT NULL auto_increment PRIMARY KEY,
	CONST_PATH_FINDING_FTP 				VARCHAR(255) 	NOT NULL,
	CONST_COEF_MARGE_PRICE 				INTEGER 		NOT NULL,
	CONST_PRICE_HT_MIN 					INTEGER 		NOT NULL,
	CONST_EXCLUDE_PRODUCT_ERROR 		INTEGER 		NOT NULL,
	CONST_NB_DAY_BEFORE_DELETE_PRODUCT 	INTEGER 		NOT NULL,
	CONST_EMPTY_STOCK_PARTNER 			INTEGER 		NOT NULL,
	CONST_FK_USER 						INTEGER (11) 	NOT NULL,
	CONST_WAREHOUSE_PENDING_ORDERS 		INTEGER (11) 	NOT NULL,
	CONST_SELL_PRICE_MIN_TO_10 			INTEGER (11) 	NOT NULL,
	entity 								INTEGER 		NOT NULL DEFAULT 1,
	tms 								TIMESTAMP 		NOT NULL
) ENGINE=innodb;

CREATE TABLE IF NOT EXISTS llx_fourn_unavailable(
	rowid 					INTEGER 		NOT NULL auto_increment PRIMARY KEY,
	fk_supplierMapping 		INTEGER 		NOT NULL,
	date_unavailable_start 	DATE 			NOT NULL,
	date_unavailable_end 	DATE 			NOT NULL,
	reason 					VARCHAR(255),
	entity 					INTEGER 		NOT NULL DEFAULT 1,
	tms 					TIMESTAMP

) ENGINE=innodb;

CREATE TABLE IF NOT EXISTS llx_Terms_exclude(
	rowid 	INTEGER 		NOT NULL auto_increment PRIMARY KEY,
	name 	VARCHAR(255) 	NOT NULL
) ENGINE=innodb;

CREATE TABLE IF NOT EXISTS llx_EAN_exclude(
	rowid 	INTEGER 		NOT NULL auto_increment PRIMARY KEY,
	fk_ean 	varchar(255) 	NOT NULL
) ENGINE=innodb;

CREATE TABLE IF NOT EXISTS llx_SKU_exclude(
	rowid 	INTEGER 		NOT NULL auto_increment PRIMARY KEY,
	fk_sku 	varchar(255) 	NOT NULL
) ENGINE=innodb;

CREATE TABLE IF NOT EXISTS llx_supplier_states (
	rowid 			INTEGER 	NOT NULL auto_increment PRIMARY KEY,
	date 			DATE 		NOT NULL,
	fk_supplier 	INTEGER(11) NOT NULL,
	state 			TINYINT 	NOT NULL,
	process 		TINYINT 	NOT NULL,
	details 		LONGTEXT 	NOT NULL,
	productCreate 	bigint(20) 	NOT NULL,
 	productUpdate 	bigint(20) 	NOT NULL,
	productError 	bigint(20) 	NOT NULL,
	user 			INTEGER(11)	NOT NULL,
	hoursUpdate 	TIME 		NOT NULL,
	duration		FLOAT 		NOT NULL,
	entity INTEGER 				NOT NULL DEFAULT 1
) ENGINE=innodb;