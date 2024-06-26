﻿CREATE TABLE w_bporpdoexist AS 
SELECT * FROM dblink('dbname=dbseam user=postgres password=vony', 
'SELECT * FROM bporpdoexist_vue')
AS t(
annee real,
idreg Integer,
designation varchar,
bfgr BigInt,
bfpo BigInt,
bfpi BigInt,
bp BigInt,
bs BigInt,
ppmh BigInt,
fpmh BigInt,
bfgr_nf BigInt,
bfpo_nf BigInt,
bfpi_nf BigInt,
bp_nf BigInt,
bs_nf BigInt,
ppmh_nf BigInt,
fpmh_nf BigInt,
bfgr_r BigInt,
bfpo_r BigInt,
bfpi_r BigInt,
bp_r BigInt,
bs_r BigInt,
ppmh_r BigInt,
fpmh_r BigInt,
bfgr_nfr BigInt,
bfpo_nfr BigInt,
bfpi_nfr BigInt,
bp_nfr BigInt,
bs_nfr BigInt,
ppmh_nfr BigInt,
fpmh_nfr BigInt,
nbbenepdo BigInt,
nbbenepdorural BigInt
)
