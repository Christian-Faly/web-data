CREATE TABLE w_bpor1  AS 
SELECT * FROM dblink('dbname=dbseam user=postgres password=vony', 
'SELECT * FROM bpor1_vue ')
AS t(
idreg Integer,
iddis Integer,
idcom Integer,
idfok Integer,
fokontany varchar,
region varchar,
district varchar,
commune varchar,
population Integer,
nbpdo BigInt,
nbpdononfonc BigInt,
nblf BigInt,
nblp BigInt,
nbli BigInt,
nbbs BigInt,
bailleur_pot varchar,
financement_acquit Integer,
etudes varchar,
priorite_manuel Integer,
priorite_auto Integer
)