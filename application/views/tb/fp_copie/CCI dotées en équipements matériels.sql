SELECT nregion, appuyes id, 1 AS valeur,  date_debut  AS daty
FROM s050502_dotation_fcci_cci
WHERE (id_dotation IS NOT NULL)