CREATE VIEW r010103_popu_commune AS 
SELECT * FROM dblink('dbname=entrepot_me user=postgres password=vony', 
'SELECT commune.idcom, commune.designationcom, region.designationreg, district.designationdis, commune.cheflieucom, commune.poptotcom
FROM (commune INNER JOIN district ON commune.iddis = district.iddis) INNER JOIN region ON district.idreg = region.idreg
')
AS t(idcom Integer,
designationcom varchar,
designationreg varchar,
designationdis varchar,
cheflieucom varchar,
poptotcom Integer
)
