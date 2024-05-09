CREATE TABLE w_activiteavappr  AS 
SELECT * FROM dblink('dbname=dbseam user=postgres password=vony', 
'SELECT * FROM activiteavappr_vue ')
AS t(idact Integer,
designationact varchar,
idtypact Integer,
designationtypact varchar,
idtyptrav Integer,
designationtyptrav varchar,
idappr Integer,
designationappr varchar,
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
