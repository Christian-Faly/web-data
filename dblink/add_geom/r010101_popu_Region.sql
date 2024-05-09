CREATE VIEW r010101_popu_Region AS 
SELECT * FROM dblink('dbname=entrepot_me user=postgres password=vony', 
'SELECT district.idreg, region.designationreg, region.cheflieureg, Sum(commune.poptotcom) AS population
FROM (commune INNER JOIN district ON commune.iddis = district.iddis) INNER JOIN region ON district.idreg = region.idreg
GROUP BY district.idreg, region.designationreg, region.cheflieureg;
')
AS t(idreg Integer,
designationreg varchar,
cheflieureg varchar,
population integer
)
