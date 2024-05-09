create view p010307_poindeau_typtrav1 as
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
SELECT distinct w_pointdeautot.designationcom,
    w_pointdeautot.designationdis,
    w_pointdeautot.designationreg,
    w_pointdeautot.idino,
    sum(
        CASE
            WHEN w_pointdeautot.idtyptrav = 1 THEN 1
            ELSE 0
        END) as nouvelle,
    sum(
        CASE
            WHEN w_pointdeautot.idtyptrav = 2 THEN 1
            ELSE 0
        END) rehabilitation,    
    sum(
        CASE
            WHEN w_pointdeautot.idtyptrav = 3 THEN 1
            ELSE 0
        END) AS extensio,
    sum(
        CASE
            WHEN w_pointdeautot.idtyptrav = 4 THEN 1
            ELSE 0
        END) AS autre, 
        w_pointdeautot.idcom,   
    w_pointdeautot.iddis,
    w_pointdeautot.idreg
   FROM w_pointdeautot
  GROUP BY  w_pointdeautot.idtyptrav, w_pointdeautot.idino,w_pointdeautot.designationcom, w_pointdeautot.designationdis, w_pointdeautot.designationreg, w_pointdeautot.idcom, w_pointdeautot.iddis, w_pointdeautot.idreg
)as a
GROUP BY a.designationcom, a.designationdis, a.designationreg, a.idcom, a.iddis, a.idreg;