UPDATE w_latfamil
SET the_geom = st_setSRID(st_MakePoint(longloc,latloc),4326)

