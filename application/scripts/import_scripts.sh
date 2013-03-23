# import the stops to the database
awk -F "," '{if (NR != 1 && !($2 ~ /^[ ]*$/)){print "insert into ass3_stops(id,code,name,description,latitude,longitude) values("$1","$2",\""$3"\",\""$4"\","$5","$6");"}}' stops.txt > stops.sql
awk -F "," '{if (NR != 1 && ($2 ~ /^[ ]*$/)){print "insert into ass3_stops(id,name,description,latitude,longitude) values("$1",\""$3"\",\""$4"\","$5","$6");"}}' stops.txt > stops.sql

# import the locations to the database
cat stops-html-stripped.txt | sed "s/<\/option>/<\/option>\n/g" | sed 's/<option value="//g;s/<\/option>//g;s/">.*$//g' | sed 's/;-122/;-122\./g;s/;-123/;-123\./g;s/;49/;49./g;s/\&amp;/\&/g' | awk -F ";" '{print "insert into ass3_locations(name, longitude, latitude) values(\""$1"\","$2","$3");"}' > locations.sql
