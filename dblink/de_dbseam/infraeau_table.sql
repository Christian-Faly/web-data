﻿CREATE TABLE w_infraeau  AS 
SELECT * FROM dblink('dbname=dbseam user=postgres password=vony', 
'SELECT * FROM infraeau_vue')
AS t(
idino Integer,
nipo varchar,
idtypineau Integer,
designationtypineau varchar,
idfoncouvr Integer,
desigfoncouvr varchar,
idmodgest Integer,
designationmodgest varchar,
nomgestino varchar,
idutil Integer,
designationutil varchar,
idloc Integer,
designationloc varchar,
idfok Integer,
designationfok varchar,
idcom Integer,
designationcom varchar,
idmil Integer,
designationmil varchar,
popurbcom Integer,
poptotcom Integer,
iddis Integer,
designationdis varchar,
idreg Integer,
designationreg varchar,
idprov Integer,
designationprov varchar,
nbbeneino Integer,
nbmngbeneino Integer,
nbreservino Integer,
longino real,
latino real,
altino Integer,
idtarif Integer,
designationtarif varchar,
tarifsceino real,
qteconsino real,
volprevino real,
intsceannuelino Integer,
autremogestino varchar,
obsino varchar,
idactino Integer
)
