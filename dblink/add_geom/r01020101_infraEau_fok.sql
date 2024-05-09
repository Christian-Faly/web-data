UPDATE r010105_localites
SET the_geom = st_setSRID(st_MakePoint(longloc,latloc),4326)
WHERE (longloc > 0 and latloc > 0);
