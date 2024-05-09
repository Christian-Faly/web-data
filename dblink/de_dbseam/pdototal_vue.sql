CREATE TABLE w_pdototal  AS 
SELECT * FROM dblink('dbname=dbseam user=postgres password=vony', 
'SELECT * FROM pdototal_vue')
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
idmil Integer,
datereceptech Date
)
