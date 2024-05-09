CREATE TABLE w_localites  AS 
SELECT * FROM dblink('dbname=dbseam user=postgres password=vony', 
'SELECT localites.*, fokontany.designationfok, commune.idcom, commune.designationcom, district.iddis, district.designationdis, region.idreg, region.designationreg
FROM (((localites INNER JOIN fokontany ON localites.idfok = fokontany.idfok) INNER JOIN commune ON fokontany.idcom = commune.idcom) INNER JOIN district ON commune.iddis = district.iddis) INNER JOIN region ON district.idreg = region.idreg;
')
AS t(
idloc Integer,
idfok Integer,
designationloc varchar,
longloc real,
latloc real,
altloc Integer,
poploc Integer,
prioritetecheauloc Integer,
prioritetechassloc Integer,
nbmenageloc Integer,
prioriteeauloc Integer,
prioriteassloc Integer,
designationfok varchar,
idcom Integer,
designationcom varchar,
iddis Integer,
designationdis varchar,
idreg Integer,
designationreg varchar
)
