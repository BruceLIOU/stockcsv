-- <one line to give the program's name and a brief idea of what it does.>
-- Copyright (C) <year>  <name of author>
--
-- This program is free software: you can redistribute it and/or modify
-- it under the terms of the GNU General Public License as published by
-- the Free Software Foundation, either version 3 of the License, or
-- (at your option) any later version.
--
-- This program is distributed in the hope that it will be useful,
-- but WITHOUT ANY WARRANTY; without even the implied warranty of
-- MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
-- GNU General Public License for more details.
--
-- You should have received a copy of the GNU General Public License
-- along with this program.  If not, see <http://www.gnu.org/licenses/>.



ALTER TABLE llx_mapping_stockcsv ADD CONSTRAINT FK_fk_warehouse FOREIGN KEY (fk_warehouse) REFERENCES llx_entrepot(rowid) ON DELETE CASCADE; 
ALTER TABLE llx_mapping_stockcsv ADD UNIQUE INDEX FK_fk_supplier (fk_supplier);
ALTER TABLE llx_mapping_stockcsv ADD UNIQUE INDEX FK_fk_warehouse (fk_warehouse);

ALTER TABLE llx_supplier_states ADD CONSTRAINT FK_fk_supplier FOREIGN KEY (fk_supplier) REFERENCES llx_societe(rowid) ON DELETE CASCADE; 
ALTER TABLE llx_supplier_states ADD UNIQUE INDEX FK_fk_warehouse (fk_supplier,date);

ALTER TABLE llx_supplier_states ADD productCreate BIGINT NOT NULL AFTER details, ADD productUpdate BIGINT NOT NULL AFTER productCreate, ADD productError BIGINT NOT NULL AFTER productUpdate; 

ALTER TABLE llx_const_stockcsv ADD UNIQUE INDEX uk_name (name);

--ALTER TABLE llx_fourn_unavailable ADD CONSTRAINT FK_fk_supplier_unavailable FOREIGN KEY (fk_supplierMapping) REFERENCES llx_mapping_stockcsv(rowid) ON DELETE CASCADE; 
ALTER TABLE llx_fourn_unavailable ADD UNIQUE INDEX FK_fk_supplier_unavailable (fk_supplierMapping);




ALTER TABLE llx_EAN_exclude ADD UNIQUE INDEX FK_fk_ean (fk_ean);
