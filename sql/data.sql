-- INSERTION IN THE DIFFERENTS TABLES





-- [INSERTION] TABLE const_stockcsv



-- ADD CONSTANT PATH TO FIND THE ABSOLUT PATH TO THE DIRECTORY FTP

INSERT INTO llx_const_stockcsv (name, value, tms)

VALUES ('CONST_PATH_FINDING_FTP', '/ftp/stocks', now());



INSERT INTO llx_const_stockcsv (rowid,CONST_PATH_FINDING_FTP, 

                                CONST_COEF_MARGE_PRICE,

                                CONST_PRICE_HT_MIN,

                                CONST_EXCLUDE_PRODUCT_ERROR,

                                CONST_NB_DAY_BEFORE_DELETE_PRODUCT,

                                CONST_EMPTY_STOCK_PARTNER,

                                CONST_FK_USER,

                                CONST_WAREHOUSE_PENDING_ORDERS,

                                entity,

                                tms)

VALUES (1,"/ftp/stocks",2,1,1,2,0,1,1,1,now());





-- [INSERTION] TABLE EAN_exclude 



INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0000040052397");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0000772164177");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0000772167024");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0002084001645");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0026635083423");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0026635105767");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0026635181792");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0027084521375");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0027084966220");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0027084966299");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0028178003050");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0028178034313");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0028178280895");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0039897065045");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0048419413240");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0048419655770");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0065541068117");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0071662132828");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0073854008072");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0074427842765");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0074427848477");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0078257555048");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0080518137382");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0080518137429");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0082686099226");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0088168106048");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0090159150558");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0093577422535");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0093577480139");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0093577572834");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0115433564552");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0115439001150");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0539411604946");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0539411605554");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0614239028041");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0638097022164");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0673419235631");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0677726401000");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0677726603466");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0688623310005");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0711719267454");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0746775022013");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0746775072834");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0746775176150");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0746775193430");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0746775193546");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0746775211509");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0746775216955");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0746775234553");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0746775245931");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0746775289775");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0746775302955");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0746775316303");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0746775346492");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0746775361655");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0778988003589");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0778988019016");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0778988057247");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0778988064429");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0778988066379");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0778988090978");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0778988122860");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0778988123713");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0778988129494");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0778988192528");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0778988198650");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0778988214992");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0778988222034");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0778988617601");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0778988628799");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0778988635667");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0778988647332");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0778988657928");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0778988659274");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0778988669372");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0778988804957");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0778988871270");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0778988880456");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0778988880500");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0778988918722");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0796714270234");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0837654603970");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0845423006860");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0845423008765");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0872354008434");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0883028141234");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0883028186853");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0883028205523");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0883028205530");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0886747057350");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0886747057381");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0886747057411");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0886747057688");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0887961019025");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0887961046267");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0887961052893");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0887961060805");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0887961069785");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0887961104066");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0887961111156");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0887961240535");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0887961287233");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0887961323580");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0887961366532");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0887961372700");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0887961407129");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0887961408188");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0887961423556");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0887961533392");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("0887961533514");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("2001801322351");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("2001941524844");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("2004630000018");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3013648082731");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3016200302018");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3021105053385");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3021105053620");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3028760411529");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3028760414711");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3032160100419");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3032160280777");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3032161106045");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3032161404103");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3032162203255");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3032162510506");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3032163101536");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3032163111009");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3032163502074");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3032164201006");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3032167501059");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3032167501301");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3032167501424");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3032167501523");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3032167503435");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3032167503459");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3045670005884");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3048700001672");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3056562302004");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3070900072060");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3070900072152");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3070900072411");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3070900086302");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3070900086487");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3070900088818");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3070900089402");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3070900094925");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3070900095106");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3070900097230");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3070900097575");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3070900097926");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3086123249233");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3086124001700");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3103220030417");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3114524024347");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3114524044321");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3114524046806");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3120720004410");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3134729132500");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3148950015259");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3148950015266");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3148950015303");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3148957670017");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3155287824300");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3181860105337");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3181860117972");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3181860120606");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3181860178461");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3181860230503");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3181860234372");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3181860750421");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3219030001896");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3225280801209");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3225430001107");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3225430001510");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3225430002197");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3225430002203");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3225430002272");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3225430006119");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3225430012226");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3225430043992");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3225435007081");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3254775553002");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3262190001060");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3266792167698");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3279510090642");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3279510090963");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3279510098501");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3279663008297");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3280250006404");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3280250009917");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3280250024743");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3280250028635");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3281640243515");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3281640280572");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3286413034215");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3296580120352");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3296580359202");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3296580360208");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3296580397457");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3296580425556");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3296580425600");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3296580432004");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3296580496013");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3296580749300");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3296580749331");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3296580752799");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3296580840304");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3296580857654");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3298060227957");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3298060406390");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3301040330285");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3301040407833");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3301040558030");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3301046030134");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3373910006781");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3373910006927");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3373910008884");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3373910060059");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3373910088053");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3375701907574");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3375702015049");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3375702048924");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3380743029788");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3380743050867");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3380743053332");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3380743062884");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3395400101592");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3410442000402");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3410443000302");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3410443000357");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3410560049338");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3417761688052");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3417761792056");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3417762024552");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3417762172451");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3417762431053");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3417768930659");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3421271400226");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3421271401551");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3421272106813");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3421272106912");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3421272109517");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3421272114214");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3437011800010");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3438617927491");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3438617927514");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3465000389758");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3465000392413");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3465000393885");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3465000393892");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3465000701048");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3467452006368");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3467452042571");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3467452044988");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3471052844541");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3502250444964");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3517132223506");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3517133006825");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3551093116415");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3551093116446");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3555801358029");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3555801358036");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3555801370014");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3555801370038");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3555801385025");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3555801450051");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3555804012201");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3555808500025");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3558380011811");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3558380013327");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3558380018797");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3558380019190");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3558380022152");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3558380025894");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3558380027119");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3558380027447");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3558380030607");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3558380031772");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3558380031987");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3558380032557");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3558380032618");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3558380034162");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3558380035374");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3558380036166");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3558380037781");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3558380040309");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3558380043676");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3558380047476");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3561863332259");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3588270012093");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3588270022696");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3588270029909");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3588270031490");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3588270033128");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3588270042182");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3681643200292");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700010401770");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700010410246");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700010410260");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700010419256");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700126906183");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700143943017");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700143944052");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700217329891");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700217331047");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700217345532");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700217355432");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700217364816");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700217364854");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700217364939");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700217385149");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700217385156");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700217385170");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700224620318");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700320015001");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700320061299");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700320062425");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700325002419");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700335214383");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700335227994");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700349323323");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700349326553");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700460840235");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700514301026");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700514304270");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700514304355");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700514306366");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700514308568");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700514308773");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700514312503");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700815390590");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700855900780");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3700994301660");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3760039970213");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3760039972125");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3760046780874");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3760046781130");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3760049596397");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3760052141904");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3760052141997");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3760052142758");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3760085090286");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3760108733107");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3760108733121");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3760108733138");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3760108734852");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3760108741058");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3760108741126");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3760119710999");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3760125260495");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3760140361450");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3760205230295");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3760240533214");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("3800020456224");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4004181782201");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4005086137431");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4005086137547");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4005086143623");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4005086421240");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4005556060016");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4005556183302");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4005556184033");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4005556184040");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4005556184057");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4005556186464");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4005556186594");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4005556244669");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4005556848515");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4005556856473");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4006149507505");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4006149595342");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4006166602283");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4006592572105");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4006874016464");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4007176123560");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4007176126271");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4007817806029");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4008496748204");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4008789066657");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4008789068880");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4008789068897");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4009775452447");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4009775452546");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4009775479246");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4009847080073");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4010070179137");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4010070202095");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4010070227098");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4010070266462");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4010070271909");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4010070279585");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4010070303587");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4010070308414");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4010070319298");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4010070320560");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4010070321932");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4010070367633");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4010168032740");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4010168033372");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4010168034645");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4010168049502");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4010168073255");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4010168218083");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4010168222707");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4010168223759");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4010168226293");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4012390306002");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4012390387636");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4012927247396");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4013594153492");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4015731040061");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4015731099137");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4029811154197");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4030651040250");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4084900661710");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4084900661833");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4084900661895");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4084900662045");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4087205713030");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4601798061240");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4792247003345");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4891813202073");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4891813831518");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4891813880448");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4891813883333");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4892910282210");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4893993510733");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4894367005800");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4897059621302");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4897059621432");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("4897067860403");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010065053106");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010065082236");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010993303854");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010993305056");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010993315031");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010993328819");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010993328918");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010993329250");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010993333271");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010993337804");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010993337835");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010993345670");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010993350544");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010993350872");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010993352418");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010993354115");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010993359172");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010993370863");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010993378128");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010993381630");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010993389681");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010993413829");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010993445875");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010994012755");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010994080013");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010994124014");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010994256661");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010994701369");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010994706333");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010994714109");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010994777050");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010994838966");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010994841065");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010994848095");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010994859732");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010994895761");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010994913434");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010994918217");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010994919542");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010994920388");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010994942793");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010994944056");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010994944896");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010994950262");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010994957094");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010994960551");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5010994964184");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5011666065550");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5011666080744");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5022103000140");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5034566125797");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5038278000601");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5054131043332");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5054131044629");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5054131050323");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5054131050521");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5054131051009");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5054131052747");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5055285407919");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5060264398027");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5060264398423");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5200701002043");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5201184020777");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5201184041192");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5201184094938");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5201184096314");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5201184096352");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5201184817919");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5201184853948");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5201184881637");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5201184882375");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5201184882382");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5413538735798");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5413538745391");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5414561466765");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5414561466857");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5420025335812");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5600983606241");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5702014469884");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5702015347211");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5702016117134");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5706751031632");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5706751035494");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5706751036446");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("5900951251856");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("6911400357189");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("6911400364019");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("6940176622962");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("6940176622986");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("6942138921120");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("7290006433046");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("7290013371874");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("7299830019112");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("7640116260108");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8000825301902");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8000825531606");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8001011090723");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8001011150267");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8001011283019");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8001011531905");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8001444146875");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8001444150438");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8001444441857");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8001444456462");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8001478300649");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8001478302476");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8001478305392");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8001478500162");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8001478500346");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8001478501770");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8001478501787");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8001478501978");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8001478503378");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8001478503538");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8001478503644");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8001478504337");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8001478504627");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8001478506133");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8001478506270");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8001478506492");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8001478506591");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8001478507420");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8001478508243");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8001478509097");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8001478511434");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8001478519164");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8001478519171");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8001537623207");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8002595120202");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8002752061096");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8003029602561");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8004927214016");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8005125269624");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8005125303007");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8005125393879");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8005125520671");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8005125520695");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8005125521142");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8005125872039");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8005125937271");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8006612531002");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8006812012509");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8007315490009");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8033576211008");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8056379000563");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8056379008866");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8056379016205");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8056379022183");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8056379022244");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8056379027379");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8056379027416");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8056379027423");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8056379027478");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8056379034452");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8410446310335");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8410446314784");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8410446315033");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8410779020048");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8410788521727");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8412147690167");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8412668079779");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8412668176508");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8412906996837");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8412906996875");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8421134181854");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8426420026024");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8426420026048");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8426420026093");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8426420026123");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8435333843550");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8435333845295");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8435333858134");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8435333864890");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8710675105864");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8710675823027");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8711808306721");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8711808329287");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8711808329355");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8711808832114");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8711808851740");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8711866294541");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8711915031226");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8711915031257");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8711915034050");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8713291443426");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8714274360020");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8718226492661");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8718226492678");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8718637035891");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8809134369005");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8904001201232");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8904001201379");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8904001201928");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8904001203113");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8904001203144");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("8904001203144");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("9782012045750");

INSERT INTO `llx_EAN_exclude` (fk_ean) VALUES ("9782016271308");

