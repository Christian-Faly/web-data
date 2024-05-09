CREATE TABLE r010105_localites AS 
SELECT * FROM dblink('dbname=entrepot_me user=postgres password=vony', 
'SELECT localites.idloc, localites.designationloc, region.designationreg, district.designationdis, commune.designationcom, fokontany.designationfok, localites.poploc, localites.longloc, localites.latloc
FROM (((localites INNER JOIN fokontany ON localites.idfok = fokontany.idfok) 
INNER JOIN commune ON fokontany.idcom = commune.idcom) INNER JOIN district ON commune.iddis = district.iddis) INNER JOIN region ON district.idreg = region.idreg'
)
AS t(idloc Integer,
designationloc varchar,
designationreg varchar,
designationdis varchar,
designationcom varchar,
designationfok varchar,
poploc Integer,
longloc real,
latloc real
)
