@extends('nav')
@section('content')
<!DOCTYPE html>
<html>
<head>

<div class="container">
    
    <div class="d-flex justify-content-center">
    <div style= "text-align: center" class="col-md-6">
    <span>Buscador de categorias con número de tareas asignadas por fechas</span>
    <br>
    <br>
    <label for="fecha_inicio">Fecha inicio:</label>

        <input type="date"    name="fecha_inicio" id="fecha_inicio"    />
        
        <br>
    <br>
        <label for="fecha_fin">Fecha fin:</label>

<input type="date" name="fecha_fin" id="fecha_fin" />
<br>
<br>

<input class="btn btn-info" type="button" name="valida" id="valida" onClick="validar()" value='Buscar'/>
     
      </div>
        </div>
  </div>


<div id="chart_div"></div>
<div id="regions_div" ></div>
<div id="piechart_div" ></div>
<div id="bar_div" ></div>
 
</head>
<body>
 
</body>
</html>

<script src="https://www.google.com/jsapi"></script>
<script>
  /*
$(document).ready(function () 
{
url='/chartjs/fetch_data'; // API URL
ajax_data('GET',url, function(data)
{
charts(data,"ColumnChart"); // Column Charts
charts(data,"PieChart"); // Pie Charts
charts(data,"BarChart"); // Bar Charts

});
});

function ajax_data(type, url, success)
{
$.ajax({
type:type,
url:url,
dataType:"json",
cache:false,
timeout:20000,
beforeSend :function(data) { },
success:function(data){
success.call(this, data);
},
error:function(data){
alert("Error In Connecting");
}
});
}
*/
function charts(data,ChartType)
{
var c=ChartType;
var jsonData=data;
google.load("visualization", "1", {packages:["corechart"], callback: drawVisualization});
function drawVisualization() 
{
var data = new google.visualization.DataTable();
data.addColumn('string', 'Nombre');
data.addColumn('number', 'Numero de tareas');
$.each(jsonData, function(i,jsonData)
{
var value=jsonData.numero_tareas;
var name=jsonData.nombre;
data.addRows([ [name, value]]);
});

var options = {
title : "Tareas por categoria",
animation:{ 
duration: 3000, 
easing: 'out', 
startup: true
},
colorAxis: {colors: ['#54C492', '#cc0000']},
datalessRegionColor: '#dedede',
defaultColor: '#dedede'
};

var chart;
if(c=="ColumnChart") // Column Charts
chart=new google.visualization.ColumnChart(document.getElementById('chart_div'));
else if(c=="PieChart") // Pie Charts
chart=new google.visualization.PieChart(document.getElementById('piechart_div'));
else if(c=="BarChart") // Bar Charts
chart=new google.visualization.BarChart(document.getElementById('bar_div'));
else if(c=="GeoChart") // Geo Charts
chart=new google.visualization.GeoChart(document.getElementById('regions_div'));

chart.draw(data, options);
}
}



function validar(){

var fecha_inicio=document.getElementById('fecha_inicio').value;
var fecha_fin=document.getElementById('fecha_fin').value;
if (fecha_inicio=='' && fecha_fin=='')
{
  alert("Por favor especifique fechas de inicio y fin para buscar")
}

if (fecha_inicio=='' && fecha_fin!='')
{
  alert("Por favor especifique fecha de inicio ")
  document.getElementById('fecha_inicio').focus()
}

if (fecha_inicio!='' && fecha_fin=='')
{
  alert("Por favor especifique fecha de fin ")
  document.getElementById('fecha_fin').focus()
}

if (fecha_inicio!='' && fecha_fin!='')
{
   if(fecha_inicio>fecha_fin){
     alert("Fecha inicio mayor a la de fin coloquela en una fecha inferior a la de fin")
     document.getElementById('fecha_inicio').focus()
   }else{
     fetch_data(fecha_inicio,fecha_fin);
   }

}


function fetch_data(fecha_inicio,fecha_fin)
 {
  $.ajax({
   url:"/chartjs/fetch_data_parameters?fecha_inicio="+fecha_inicio+"&fecha_fin="+fecha_fin,
   success:function(data)
   {
    charts(data,"ColumnChart"); // Column Charts
charts(data,"PieChart"); // Pie Charts
charts(data,"BarChart"); // Bar Charts

   }
  })
 }


}

</script>
@endsection