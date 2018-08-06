var js_estudiante = function(){
    var modalEstudianteSubmit = function(id){
        var url="view/core/php/tutor/modalSemanal.php?e="+id;
        window.open(url,'popup','width=1150,height=850')
    }

    var handleJsonChart = function(){
        var chart = AmCharts.makeChart("chartdiv", {
          "type": "serial",
          "theme": "none",
          "marginRight": 70,
          "dataProvider": [{
            "country": "ETA 01",
            "visits": 70,
            "color": "#0D8ECF"
          },{
            "country": "ETA 02",
            "visits": 50,
            "color": "#04D215"
          },{
            "country": "ETA 03",
            "visits": 40,
            "color": "#FF6600"
          },{
            "country": "ETA 03",
            "visits": 44,
            "color": "#FF6600"
          },{
            "country": "ETA 03",
            "visits": 34,
            "color": "#FF6600"
          },{
            "country": "ETA 03",
            "visits":45,
            "color": "#FF6600"
          }],
          "valueAxes": [{
            "axisAlpha": 0,
            "position": "left",
            "title": ""
          }],
          "startDuration": 1,
          "graphs": [{
            "balloonText": "<b>[[value]]%</b>",
            "fillColorsField": "color",
            "fillAlphas": 0.9,
            "lineAlpha": 0.2,
            "type": "column",
            "valueField": "visits"
          }],
          "chartCursor": {
            "categoryBalloonEnabled": false,
            "cursorAlpha": 0,
            "zoomable": false
          },
          "categoryField": "country",
          "categoryAxis": {
            "gridPosition": "start",
            "labelRotation": 45
          },
          "export": {
            "enabled": false
          }
        });
    }

    return{
        init: function(){
            handleJsonChart()
        },
        modalEstudianteSubmit: function(id){
            modalEstudianteSubmit(id)
        }
    }
}();

$(document).ready(function(){
    js_estudiante.init()
})