﻿CREATE TABLE w_bpor2  AS 
SELECT * FROM dblink('dbname=dbseam user=postgres password=vony', 
'SELECT * FROM bpor2_vue ')
AS t(
idpdo Integer,
idtyppdo Integer,
idutil Integer,
idloc Integer,
idcom Integer,
idmodgest Integer,
idfoncouvr Integer,
idino Integer,
numpdo Integer,
gerantpdo varchar,
nbbenepdo Integer,
longpdo real,
latpdo real,
idtypineau Integer,
nbpdo Integer,
designationloc varchar,
designationfok varchar,
designationcom varchar,
iddis Integer,
designationdis varchar,
idreg Integer,
designationreg varchar,
designationmodgest varchar,
desigfoncouvr varchar,
designationtyppdo varchar,
designationtypineau varchar,
designationmil varchar,
idmil Integer
)