CREATE TABLE w_activitessappr AS 
SELECT * FROM dblink('dbname=dbseam user=postgres password=vony', 
'SELECT * FROM activitessappr_vue')
AS t(
idact Integer,
designationact varchar,
idtypact Integer,
designationtypact varchar,
idtyptrav Integer,
designationtyptrav varchar,
idprogproj Integer,
progproj varchar,
montanttotalact Integer,
dureeact real,
datreceptprovact Date,
observationact varchar,
idbail Integer,
bailleur varchar,
idpart Integer,
partmiseoeuvre varchar
)
