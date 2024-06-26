﻿CREATE TABLE w_infraeautot  AS 
SELECT * FROM dblink('dbname=dbseam user=postgres password=vony', 
'SELECT * FROM infraeautot_vue')
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
idmil Integer,
designationmil varchar,
idloc Integer,
designationloc varchar,
idfok Integer,
designationfok varchar,
idcom Integer,
designationcom varchar,
popurbcom Integer,
poptotcom Integer,
iddis Integer,
designationdis varchar,
idreg Integer,
designationreg varchar,
idprov Integer,
designationprov varchar,
nbbeneino Integer,
nbbfino Integer,
nbbpino Integer,
nbbsino Integer,
nbbfnfoncino Integer,
nbbpnfoncino Integer,
nbbsnfoncino Integer,
nbreservino Integer,
longino real,
latino real,
altino Integer,
valdreauino varchar,
datvaldreauino Date,
valsigino varchar,
datvalsigino Date,
valcentralino varchar,
datvalcentralino Date,
idactino Integer,
idact Integer,
designationact varchar,
idtypact Integer,
designationtypact varchar,
idtyptrav Integer,
designationtyptrav varchar,
idprogproj Integer,
progproj varchar,
montanttotalact Integer,
dureeact real,
datreceptprovact Date,
observationact varchar,
idbail Integer,
bailleur varchar,
idpart Integer,
partmiseoeuvre varchar
)
