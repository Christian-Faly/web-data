var myState = {
    pdf: null,
    currentPage: 1,
    zoom: 1
}

// more code here

var current_link ='http://31.207.35.114/cgi-bin/qgis_mapserv.fcgi?map=/var/www/html/qgis-web-client-master/projects/Zone_intervention_2Server_.qgs&SERVICE=WMS&VERSION=1.3&REQUEST=GetPrint&FORMAT=pdf&EXCEPTIONS=application/vnd.ogc.se_inimage&TRANSPARENT=true&SRS=EPSG:3857&DPI=300&TEMPLATE=PROSPERER&map0:extent=4380027.1,-2695090.3,6225071.5,-1547562.7&map0:rotation=0&map0:scale=7500000&map0:grid_interval_x=250000&map0:grid_interval_y=250000&LAYERS=nb%20MER%20benecifiaire%20(sans%20r%C3%A9dondance)%2Ccoordination%20v7v%2Ccoordination%20sofia%2Ccoordination%20itasy%2Ccoordination%20haute%20matsiatra%2Ccoordination%20bongolava%2Ccoordination%20boeny%2Ccoordination%20atsinanana%2Ccoordination%20analanjirofo%2Ccoordination%20analamanga&OPACITIES=255%2C255%2C255%2C255%2C255%2C255%2C255%2C255%2C255%2C255'
pdfjsLib.getDocument(current_link).then((pdf) => {

// more code here
});

var canvas = document.getElementById("pdf_renderer");
var ctx = canvas.getContext('2d');
 
var viewport = page.getViewport(myState.zoom);
