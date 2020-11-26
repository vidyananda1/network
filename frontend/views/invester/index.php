<div id="chart_div"></div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


<style>
 table.google-visualization-orgchart-table { 
     border-collapse: separate !important; 
    
}
 table {
    display: block;
    overflow-x: auto;
    white-space: nowrap;
 }
 </style>
<?php 
$this->registerJs('
var arr = '.$arr.';
console.log(arr);
google.charts.load("current", {packages:["orgchart"]});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
  var data = new google.visualization.DataTable();
  data.addColumn("string", "Name");
  data.addColumn("string", "Manager");
  data.addColumn("string","ToolTip");

  // For each orgchart box, provide the name, manager, and tooltip to show.
  data.addRows(arr);
  var chart = new google.visualization.OrgChart(document.getElementById("chart_div"));
  // Draw the chart, setting the allowHtml option to true for the tooltips.
  chart.draw(data, {"allowHtml":true});
}
')
?>