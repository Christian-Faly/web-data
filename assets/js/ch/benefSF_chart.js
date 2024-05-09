var config = {
    type: 'line',
    data: {
        labels: annee_benef_sf,
        datasets: [{
            label: 'Touts bénéficiaires',
            backgroundColor: window.chartColors.blue_,
            borderColor: window.chartColors.blue_,
            data: nb_benef_sf,
            fill: false,
        },{
            label: 'Hommes bénéficiaires',
            fill: false,
            backgroundColor: window.chartColors.grey,
            borderColor: window.chartColors.grey,
            data: homme_benef_sf,
        },{
            label: 'Femmes bénéficiaires',
            fill: false,
            backgroundColor: window.chartColors.red,
            borderColor: window.chartColors.red,
            data: femme_benef_sf,
        }]
    },
    options: {
        responsive: true,
        title: {
            display: false,
            text: 'Bénéficaires Services Financiers'
        },
        tooltips: {
            mode: 'index',
            intersect: false,
        },
        hover: {
            mode: 'nearest',
            intersect: true
        },
        scales: {
            xAxes: [{
                display: true,
                scaleLabel: {
                    display: false,
                    labelString: 'Année'
                }
            }],
            yAxes: [{
                display: true,
                scaleLabel: {
                    display: false,
                    labelString: 'Nb'
                }
            }]
        }
    }
};

window.onload = function() {
    var ctx = document.getElementById('canvas').getContext('2d');
    window.myLine = new Chart(ctx, config);
};

document.getElementById('select_region_benef_sf').addEventListener('change',function() {
    var code_region= this.value;
    if (this.value!='National')
    {
        link=site_url+"index.php/site/getbeneSF_Region/"
        $.get(link+code_region,function(data){
            var benef=JSON.parse(data);
            var annee=[];
            var nb=[];
            var nb_homme=[];
            var nb_femme=[];
            for ( var i = 0; i < benef.length; i++) {
                console.log( benef[i] ) ;
                annee.push(benef[i].date_part);
                nb.push(benef[i].nb);
                nb_homme.push(benef[i].homme);
                nb_femme.push(benef[i].femme);
                }
            window.myLine.config.data.labels = annee;
            //console.log(config.data.labels);
            window.myLine.config.data.datasets[0].data = nb;
            //console.log(config.data.datasets[0].data)
            window.myLine.config.data.datasets[1].data = nb_homme;
            //console.log(config.data.datasets[1].data)
            window.myLine.config.data.datasets[2].data = nb_femme;
            //console.log(config.data.datasets[2].data)
            window.myLine.update();
        })
    }
    else{
        window.myLine.config.data.labels = annee_benef_sf;
        //console.log(config.data.labels);
        window.myLine.config.data.datasets[0].data = nb_benef_sf;
        //console.log(config.data.datasets[0].data)
        window.myLine.config.data.datasets[1].data = homme_benef_sf;
        //console.log(config.data.datasets[1].data)
        window.myLine.config.data.datasets[2].data = femme_benef_sf;
        //console.log(config.data.datasets[2].data)
        window.myLine.update();
    }
    

});
