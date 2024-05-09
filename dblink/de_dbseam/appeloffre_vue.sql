CREATE TABLE w_appeloffre  AS 
SELECT * FROM dblink('dbname=dbseam user=postgres password=vony', 
'SELECT * FROM appeloffre_vue')
AS t(
region varchar,
district varchar,
commune varchar,
intitule_offre varchar,
domaine varchar,
financement varchar,
date_remise Date,
montant Integer
)
