
<?php

use yii\grid\GridView;
use yii\helpers\Url;
?>

<div class="container">

  <?php
  echo $this->render('_search', [
    'model' =>$model,
    'registrations' => $registrations
    ]) ?>

  <?php 
    $dataProvider = new \yii\data\ArrayDataProvider();
    echo GridView::widget([
      'dataProvider' => $dataProvider,
      'filterModel' => null,
      'columns' =>[
        // [
        //   'class' => 'yii\grid\SerialColumn'
        // ],
        'investor_name',
        'phone',
        'address',
        'aadhaar',
        'member_code',
        'referral_status',
        'referral_code'
      ],
      'tableOptions' => [
        'id'=>'investor_tbl',
        'class' => ['table table-striped table-bordered tblSpace']
        ]
    ]); ?>

    <div id="chart_div"></div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


<style>
.container {
  display: grid;
  grid-template-rows: auto 1fr auto;
  align-content: space-between;
  /* justify-content: space-evenly; */
}

table.google-visualization-orgchart-table { 
     border-collapse: separate !important; 
    
}
 table {
    display: block;
    overflow-x: auto;
    white-space: nowrap;
 }
 .tblSpace {
  border-spacing: 10%;
 }
 #loader {
   display: none;
 }
 </style>
<?php 
  $membersUrl = Url::to(['members-list']);
  $this->registerJs('
    console.log("next");
    const member_code = $("#investor-member_code");
    const chartDiv = $("#chart_div");
    var arr= null;
    var chartData = null;
    var table = $("#investor_tbl tbody");
    
    $(document).on("click","#search",function(){
      $("#loader").show();
      var membersUrl = `'.$membersUrl.'&member_code=${member_code.val()}`;
      if(member_code.val()==""){
        alert("Please enter member code");
        $("#loader").hide();
        return false;
      }
      event.preventDefault();
      console.log(membersUrl);
      table.empty();
      chartDiv.empty();
      $.get(membersUrl,function(data){
        // console.log(data);
        if(data.length==0) {
          table.append("No results found.");
          return false;
        }
        console.log(data);
        arr = JSON.parse(data);
        console.log(arr[0]["investor"]);
        arr[0]["investor"].forEach(function(items,index){
          table.append(`
          <tr>
            <td>${items.investor_name}</td>
            <td>${items.phone}</td>
            <td>${items.address}</td>
            <td>${items.aadhaar}</td>
            <td>${items.member_code}</td>
            <td>${items.referral_status}</td>
            <td>${items.referral_code}</td>
          </tr>
          `);
        });
        // console.log(arr[0]["referred"]);
        chartData =  arr[0]["referred"];
        
        google.charts.load("current", {packages:["orgchart"]});
        google.charts.setOnLoadCallback(drawChart);
      }).done(function(){
        $("#loader").hide();

      });
    });

    function drawChart() {
      var data = new google.visualization.DataTable();
      data.addColumn("string", "Name");
      data.addColumn("string", "Manager");
      data.addColumn("string","ToolTip");

      // For each orgchart box, provide the name, manager, and tooltip to show.
      console.log(chartData);
      data.addRows(chartData);
      var chart = new google.visualization.OrgChart(document.getElementById("chart_div"));
      // Draw the chart, setting the allowHtml option to true for the tooltips.
      chart.draw(data, {"allowHtml":true});
    }

  ');


?>