CREATE TABLE w_txacces  AS 
SELECT * FROM dblink('dbname=dbseam user=postgres password=vony', 
'SELECT * FROM txacces_vue')
AS t(
idmil Integer,
designationmil varchar,
idcom Integer,
designationcom varchar,
iddis Integer,
designationdis varchar,
idreg Integer,
designationreg varchar,
popurbcom Integer,
poptotcom Integer,
nbbene BigInt
)
