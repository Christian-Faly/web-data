CREATE TABLE w_progproj  AS 
SELECT * FROM dblink('dbname=dbseam user=postgres password=vony', 
'SELECT * FROM progproj_vue')
AS t(
idptf Integer,
idtypact Integer,
iddom Integer,
representantptf varchar,
gdbailfondptf varchar,
bailfondptf varchar,
agexecptf varchar,
progprojptf varchar,
autresptf varchar,
firmeptf varchar,
designationptf varchar,
adresseptf varchar,
mailptf varchar,
telephoneptf varchar,
faxptf varchar,
sitewebptf varchar,
bpptf varchar,
persressptf varchar,
mailprptf varchar,
telprptf varchar,
zoneptf varchar,
budgettotalptf Integer,
validation varchar
)
