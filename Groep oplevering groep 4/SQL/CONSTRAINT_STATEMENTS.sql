/* MULTI PRIMARY KEY */
ALTER TABLE dbo.veiling
ADD CONSTRAINT pk_veiling PRIMARY KEY(voorwerp_id, titel);