﻿CREATE TABLE w_hygiene1  AS 
SELECT * FROM dblink('dbname=dbseam user=postgres password=vony', 
'SELECT * FROM hygiene1')
AS t(
id Integer,
idhyg Integer,
nihyg varchar,
niveau varchar,
idp Integer,
province varchar,
idr Integer,
region varchar,
idd Integer,
district varchar,
idc Integer,
commune varchar,
popurbcom Integer,
poptotcom Integer,
idf Integer,
fokontany varchar,
idl Integer,
localites varchar,
nbdlm Integer,
valdreau varchar,
datvaldreau Date,
valsig varchar,
datvalsig Date,
valcentral varchar,
datvalcentral Date,
datecolldebhyg Date,
datecollhyg Date,
idacthyg Integer
)