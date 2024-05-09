CREATE VIEW r010102_popu_district AS 
SELECT * FROM dblink('dbname=entrepot_me user=postgres password=vony', 
'SELECT district.iddis,district.designationdis, region.designationreg, district.cheflieudis, Sum(commune.poptotcom) AS population
FROM (commune INNER JOIN district ON commune.iddis = district.iddis) INNER JOIN region ON district.idreg = region.idreg
GROUP BY district.iddis, district.designationdis, region.designationreg, district.cheflieudis
')
AS t(iddis Integer,
designationdis varchar,
designationreg varchar,
cheflieudis varchar,
population integer
)
