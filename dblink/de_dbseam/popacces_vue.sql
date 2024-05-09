CREATE TABLE w_popacces  AS 
SELECT * FROM dblink('dbname=dbseam user=postgres password=vony', 
'SELECT * FROM popacces_vue')
AS t(
idmil Integer,
designationmil varchar,
designationreg varchar,
designationdis varchar,
idcom Integer,
designationcom varchar,
nbbene BigInt
)
