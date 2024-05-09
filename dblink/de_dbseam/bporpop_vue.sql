CREATE TABLE w_bporpop  AS 
SELECT * FROM dblink('dbname=dbseam user=postgres password=vony', 
'SELECT * FROM bporpop_vue ')
AS t(idreg Integer,
annee real,
poprural Bigint,
popurbain Bigint
)
