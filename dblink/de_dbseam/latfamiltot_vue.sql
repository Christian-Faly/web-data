﻿CREATE TABLE w_latfamiltot AS 
SELECT * FROM dblink('dbname=dbseam user=postgres password=vony', 
'SELECT * FROM latfamiltot_vue')
AS t(
idlatf Integer,
nilaf varchar,
idloc Integer,
designationloc varchar,
longloc real,
latloc real,
altloc Integer,
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
designationprov varchar,
idclts Integer,
idacclts Integer,
intituleacclts varchar,
dateclts Date,
idnblat Integer,
idtypelaf Integer,
designationtypelaf varchar,
nblatrinenblat Integer,
nbnonfoncnblat Integer,
nbdlmnblat Integer,
nbmngnblat Integer,
nbutulisnblat Integer,
datedebnblat Date,
datecollnblat Date,
poputisysindbouelaf Integer,
accesscevidangbouelaf varchar,
zerodalodflaf varchar,
latetancheodflaf varchar,
dlmodflaf varchar,
datecolllaf Date,
valdreaulaf varchar,
datvaldreaulaf Date,
valsiglaf varchar,
datvalsiglaf Date,
valcentrallaf varchar,
datvalcentrallaf Date,
idactlatf Integer,
idact Integer,
designationact varchar,
idtypact Integer,
designationtypact varchar,
idtyptrav Integer,
designationtyptrav varchar,
idappr Integer,
designationappr varchar,
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