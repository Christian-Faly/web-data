// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}



// Area Chart Example
var ctx = document.getElementById("myAreaChart");
var area_config ={
  type: 'line',
  data: {
    labels: annee_benef,
    datasets: [{
      label: "Nb bénéficiaires: ",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: nb_benef_par_annee,
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return number_format(value,0,',',' ');
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + number_format(tooltipItem.yLabel,0,',',' ');
        }
      }
    }
  }
}
var myLineChart = new Chart(ctx, area_config );

document.getElementById('select_region_benef').addEventListener('change',function(){
  var code_region= this.value;
  if (this.value!='National'){
    link=site_url+"index.php/site/getBeneficiaire_Region/"
    $.get(link+code_region,function(data){
      var annee=[];
      var nb=[];
      $.each(JSON.parse(data),function(index, gotObj){ 
        annee.push( parseInt (gotObj.date_part));
        nb.push( parseInt (gotObj.count_a_ctompony));
      })
      //console.log(annee);
      area_config.data.labels = annee;
      area_config.data.datasets[0].data = nb;
      myLineChart.update();
    })

    link=site_url+"index.php/site/getBenefRepartition_genre_Region/"
    $.get(link+code_region,function(data){
      var genre_benef_=[];
      var nb=[];
      benefHF_Piehart_config.data.labels = genre_benef_;
      benefHF_Piehart_config.data.datasets[0].data = nb;
      myPieChart.update();
      $.each(JSON.parse(data),function(index, gotObj){ 
        console.log(gotObj.genre);
        genre_benef_.push(gotObj.genre);
        nb.push( parseInt (gotObj.count_a_ctompony));
      })
      console.log(JSON.parse(data));
      if (genre_benef_[0]="Homme") benefHF_Piehart_config.data.datasets.backgroundColor=['#4e73df','rgb(255, 99, 132)', '#1cc88a', '#36b9cc'];
      else benefHF_Piehart_config.data.datasets.backgroundColor=['rgb(255, 99, 132)','#4e73df', '#1cc88a', '#36b9cc'];
      benefHF_Piehart_config.data.labels = genre_benef_;
      benefHF_Piehart_config.data.datasets[0].data = nb;
      myPieChart.update();
    })
  }
  else{
    area_config.data.labels = annee_benef;
    area_config.data.datasets[0].data = nb_benef_par_annee;
    myLineChart.update();

    var genre_benef_=[];
    var nb=[];
    benefHF_Piehart_config.data.labels = genre_benef_;
    benefHF_Piehart_config.data.datasets[0].data = nb;
    myPieChart.update();
    if (genre_benef[0]="Homme") benefHF_Piehart_config.data.datasets.backgroundColor=['#4e73df','rgb(255, 99, 132)', '#1cc88a', '#36b9cc'];
    else benefHF_Piehart_config.data.datasets.backgroundColor=['rgb(255, 99, 132)','#4e73df', '#1cc88a', '#36b9cc'];
    benefHF_Piehart_config.data.labels = genre_benef;
    benefHF_Piehart_config.data.datasets[0].data = nb_genre_benef;
    myPieChart.update();
  }
});



// Bar Chart Example

var ctx = document.getElementById("myBarChart");
var bar_chart_formation_config={
  type: 'bar',
  data: {
    labels: types_formation,
    datasets: [{
      label: "nb bénéficiaires",
      backgroundColor: "#4e73df",
      hoverBackgroundColor: "#2e59d9",
      borderColor: "#4e73df",
      data: nb_benef_formation,
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 6
        },
        maxBarThickness: 25,
      }],
      yAxes: [{
        ticks: {
          min: 0,
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return '' + number_format(value,0,',',' ');
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': ' + number_format(tooltipItem.yLabel,0,',',' ');
        }
      }
    },
  }
}
var myBarChart = new Chart(ctx, bar_chart_formation_config);

document.getElementById('select_region_benef_formation').addEventListener('change',function(){
  var code_region= this.value;
  if (this.value!='National'){
    link=site_url+"index.php/site/getBeneficiaireTypeFormation_Region/"
    $.get(link+code_region,function(data){
      var type_formation_reg=[];
      var nb=[];
      $.each(JSON.parse(data),function(index, gotObj){ 
        console.log(gotObj.type_formation);
        type_formation_reg.push(gotObj.type_formation);
        nb.push( parseInt (gotObj.count_a_ctompony));
      })
      bar_chart_formation_config.data.labels = type_formation_reg;
      bar_chart_formation_config.data.datasets[0].data = nb;
      myBarChart.update();
    })
  }
  else{
    bar_chart_formation_config.data.labels = types_formation;
    bar_chart_formation_config.data.datasets[0].data = nb_benef_formation;
    myBarChart.update();
  }
});



// Pie Chart Example
var ctx = document.getElementById("myPieChart");
benefHF_Piehart_config={
  type: 'doughnut',
  data: {
    labels: genre_benef,
    datasets: [{
      data: nb_genre_benef,
      backgroundColor: ['#4e73df','rgb(255, 99, 132)', '#1cc88a', '#36b9cc'],
      hoverBackgroundColor: ['#2e59d9', 'rgb(255, 99, 132)', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: true
    },
    cutoutPercentage: 80,
  },
}
var myPieChart = new Chart(ctx, benefHF_Piehart_config);




var ctx = document.getElementById("myBarChart_benef_foire");
var bar_chart_foire_config={
  type: 'bar',
  data: {
    labels: types_foire,
    datasets: [{
      label: "nb bénéficiaires",
      backgroundColor: "#4e73df",
      hoverBackgroundColor: "#2e59d9",
      borderColor: "#4e73df",
      data: nb_benef_foire,
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 6
        },
        maxBarThickness: 25,
      }],
      yAxes: [{
        ticks: {
          min: 0,
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return '' + number_format(value,0,',',' ');
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': ' + number_format(tooltipItem.yLabel,0,',',' ');
        }
      }
    },
  }
}
var myBarChartFoire = new Chart(ctx, bar_chart_foire_config);


var ctx = document.getElementById("myPieChart_benef_foireHF");
benefHF_Piehart_config_foire={
  type: 'doughnut',
  data: {
    labels: genre_benef_foire,
    datasets: [{
      data: nb_genre_benef_foire,
      backgroundColor: ['#4e73df','rgb(255, 99, 132)', '#1cc88a', '#36b9cc'],
      hoverBackgroundColor: ['#2e59d9', 'rgb(255, 99, 132)', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: true
    },
    cutoutPercentage: 80,
  },
}
var myPieChart_benef_foireHF = new Chart(ctx, benefHF_Piehart_config_foire);


document.getElementById('select_region_benef_foire').addEventListener('change',function(){
  var code_region= this.value;
  if (this.value!='National'){
    link=site_url+"index.php/site/getBeneficiaireTypeFoireRegion/"
    $.get(link+code_region,function(data){
      var type_foire_reg=[];
      var nb=[];
      $.each(JSON.parse(data),function(index, gotObj){ 
        //console.log(gotObj.type_formation);
        type_foire_reg.push(gotObj.type_foire);
        nb.push( parseInt (gotObj.count_a_ctompony));
      })
      bar_chart_foire_config.data.labels = type_foire_reg;
      bar_chart_foire_config.data.datasets[0].data = nb;
      myBarChartFoire.update();  
    })

    link=site_url+"index.php/site/getBeneficiaireParGenreFoireRegion/"
      $.get(link+code_region,function(data){
        var genre_benef_foire_=[];
        var nb=[];
        benefHF_Piehart_config_foire.data.labels = genre_benef_foire_;
        benefHF_Piehart_config_foire.data.datasets[0].data = nb;
        myPieChart_benef_foireHF.update();
        $.each(JSON.parse(data),function(index, gotObj){ 
          console.log(gotObj.genre);
          genre_benef_foire_.push(gotObj.genre);
          nb.push( parseInt (gotObj.count_a_ctompony));
        })
        console.log(JSON.parse(data));
        if (genre_benef_foire_[0]="Homme") benefHF_Piehart_config_foire.data.datasets.backgroundColor=['#4e73df','rgb(255, 99, 132)', '#1cc88a', '#36b9cc'];
        else benefHF_Piehart_config_foire.data.datasets.backgroundColor=['rgb(255, 99, 132)','#4e73df', '#1cc88a', '#36b9cc'];
        benefHF_Piehart_config_foire.data.labels = genre_benef_foire_;
        benefHF_Piehart_config_foire.data.datasets[0].data = nb;
        myPieChart_benef_foireHF.update();
      })
      
      
  }
  else{
    bar_chart_foire_config.data.labels = types_foire;
    bar_chart_foire_config.data.datasets[0].data = nb_benef_foire;
    myBarChartFoire.update();

    var genre_benef_=[];
    var nb=[];
    benefHF_Piehart_config_foire.data.labels = genre_benef_;
    benefHF_Piehart_config_foire.data.datasets[0].data = nb;
    myPieChart_benef_foireHF.update();
    if (genre_benef[0]="Homme") benefHF_Piehart_config_foire.data.datasets.backgroundColor=['#4e73df','rgb(255, 99, 132)', '#1cc88a', '#36b9cc'];
    else benefHF_Piehart_config_foire.data.datasets.backgroundColor=['rgb(255, 99, 132)','#4e73df', '#1cc88a', '#36b9cc'];
    benefHF_Piehart_config_foire.data.labels = genre_benef;
    benefHF_Piehart_config_foire.data.datasets[0].data = nb_genre_benef;
    myPieChart_benef_foireHF.update();
  }
});


