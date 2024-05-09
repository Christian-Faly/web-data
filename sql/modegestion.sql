create view p010306_infraeau_typtrav1 as
SELECT a.designationcom,
    a.designationdis,
    a.designationreg,
    count(a.idino),
    sum(case when a.nouvelle>1 then 1 else 0 end) as nbnouvelle,
    sum(case when a.rehabilitation>1  then  1 else 0 end ) as nbrehabilitation,    
    sum(case when a.extensio>1 then 1 else 0 end) nbextension,
    sum(case when a.autre>1 then 1 else 0 end ) as nbautre, 
    a.idcom,   
    a.iddis,
    a.idreg
   FROM (
SELECT distinct w_infraeautot.designationcom,
    w_infraeautot.designationdis,
    w_infraeautot.designationreg,
    w_infraeautot.idino,
    sum(
        CASE
            WHEN w_infraeautot.idtyptrav = 1 THEN 1
            ELSE 0
        END) as nouvelle,
    sum(
        CASE
            WHEN w_infraeautot.idtyptrav = 2 THEN 1
            ELSE 0
        END) rehabilitation,    
    sum(
        CASE
            WHEN w_infraeautot.idtyptrav = 3 THEN 1
            ELSE 0
        END) AS extensio,
    sum(
        CASE
            WHEN w_infraeautot.idtyptrav = 4 THEN 1
            ELSE 0
        END) AS autre, 
        w_infraeautot.idcom,   
    w_infraeautot.iddis,
    w_infraeautot.idreg
   FROM w_infraeautot
  GROUP BY  w_infraeautot.idtyptrav, w_infraeautot.idino,w_infraeautot.designationcom, w_infraeautot.designationdis, w_infraeautot.designationreg, w_infraeautot.idcom, w_infraeautot.iddis, w_infraeautot.idreg
)as a
GROUP BY a.designationcom, a.designationdis, a.designationreg, a.idcom, a.iddis, a.idreg;