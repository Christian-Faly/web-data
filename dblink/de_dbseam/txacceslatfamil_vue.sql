CREATE TABLE w_txacceslatfamil  AS 
SELECT * FROM dblink('dbname=dbseam user=postgres password=vony', 
'SELECT * FROM txacceslatfamil_vue')
AS t(
designationmil varchar,
idcom Integer,
designationcom varchar,
iddis Integer,
designationdis varchar,
idreg Integer,
designationreg varchar,
poptotcom Integer,
nbmenage Integer,
nb_util_latrine_amelioree_non_partagee Integer,
nb_util_latrine_amelioree_partagee Integer,
nb_util_latrine_non_amelioree_non_partagee Integer,
nb_util_latrine_non_amelioree_partagee Integer
)
