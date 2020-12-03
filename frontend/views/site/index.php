<<<<<<< HEAD
<?php
use app\models\Registration;
use app\models\Member;
use app\models\Counter;
 

//use app\models\Counterno;

$this->title = '';

$reg = Registration::find()->where(['record_status'=>'1'])->count();
$mem = Member::find()->where(['record_status'=>'1'])->count();
$invested_amount = Registration::find()->where(['record_status'=>'1'])->sum('invest_amount');
$amount_paid = Counter::find()->where(['record_status'=>'1'])->sum('paid_amount');

?>


<div class="row ">
    <div class="col-lg-3 col-xs-3 " >
          <!-- small box -->
          <div class="small-box shadow" style="background: linear-gradient(to bottom, #33ccff 0%, #48628c 100%); ">
            <div class="inner">
             

              <h4 style="font-size: 15px;"><b>Total Investors</b></h4>
            </div> 
            <div class="inner">
              <div><h4 style="font-size: 15px"><b><?= $reg ?></b></h4></div>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            
                <a href="index.php?r=registration/index" class="small-box-footer" style="border-radius: 5px">ADD +<i class="fa fa-arrow-circle-right"></i></a> 
=======
<div class="row">
  <div class="col-md-6">
<div class="card" >
  <div class="card-header" style="background-color: #cfaded">
      <div class="row">
          <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
            Invested amount
>>>>>>> bf28c45962851444b0f54ad8d0e7d5136ec173ae
          </div>
    </div>
    <div class="col-lg-3 col-xs-3">
          <!-- small box -->
          <div class="small-box shadow" style="background: linear-gradient(to bottom, #99ff99 -6%, #13852e 106%)">
            <div class="inner">
             

              <h4 style="font-size: 15px"><b>Total Users</b></h4>
            </div>
            <div class="inner">
              <div><h4 style="font-size: 15px"><b><?= $mem ?></b></h4></div>
            </div>
            <div class="icon">
              <i class="fa fa-user-plus"></i>
            </div>
            
                <a href="index.php?r=member/index" class="small-box-footer" style="border-radius: 5px">ADD +<i class="fa fa-arrow-circle-right"></i></a> 
          </div>
    </div>
    <div class="col-lg-3 col-xs-3">
          <!-- small box -->
          <div class="small-box shadow" style="background: linear-gradient(to bottom, #ff9966 -7%, #cf2204 135%)">
            <div class="inner">
             

              <h4 style="font-size: 15px"><b>Invested Amount</b></h4>
            </div>
            <div class="inner">
              <div><h4 style="font-size: 15px"><b>Rs <?= $invested_amount ?></b></h4></div>
            </div>
            <div class="icon">
              <i class="fa fa-money"></i>
            </div>
            
                <a href="index.php?r=registration/index" class="small-box-footer" style="border-radius: 5px">ADD +<i class="fa fa-arrow-circle-right"></i></a> 
          </div>
    </div>
    <div class="col-lg-3 col-xs-3">
          <!-- small box -->
          <div class="small-box shadow" style="background: linear-gradient(to bottom, #fffa75 -7%, #bfb30b 135%)">
            <div class="inner">
             

              <h4 style="font-size: 15px"><b>Interest Amount</b></h4>
              
            </div>
            <div class="inner">
              <div><h4 style="font-size: 15px"><b>Rs <?= $amount_paid ?></b></h4></div>
            </div>
            
            <div class="icon">
              <i class="fa fa-money"></i>
            </div>
            
                <a href="index.php?r=counter/index" class="small-box-footer" style="border-radius: 5px">ADD +<i class="fa fa-arrow-circle-right"></i></a> 
          </div>
    </div>
  </div>
<div>&emsp;</div>
<div class="row">
<div class="col-md-6 ">
  <div class="card shadow " >
    <div class="card-header" style="background: linear-gradient(to bottom, #d3aaf2 -7%, #7106c2 135%)">
        <div class="row">
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
              <h4 style="font-size: 15px"><b>Invested Amount</b></h4>
            </div>
        </div>
    </div>
    <div class="card-body" style="margin-bottom: 10px;">
        <div id="invested_div" ></div>
    </div>
  </div>
</div>
<div class="col-md-6">
<div class="card shadow" >
  <div class="card-header"style="background: linear-gradient(to bottom, #d3aaf2 -7%, #7106c2 135%)">
      <div class="row">
          <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
            <h4 style="font-size: 15px"><b>Interest Amount</b></h4>
          </div>
      </div>
  </div>
  <div class="card-body">
    <div id="interests_div" ></div>
  </div>
</div>
</div>
</div>

<style type="text/css">
    .shadow {
              
              box-shadow: 3px 3px 4px  grey;
              border-radius: 5px;
            }
    .background{
                opacity: 0.2;
                background: linear-gradient(to right, #99ccff 12%, #3366cc 114%);
                position: fixed; 
                margin-left: -10%;
                margin-top:-5%;
                margin-right: -3%;
                width: 150%; 
                height: 100%;

            }

  </style>
  <!-- <div id="invested_div" ></div> -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawBasic);
function drawBasic() {
  var columns=[];
  columns.push(["Month","Amount"]);
  var invested = <?= $invested ?>;
  var interests = <?= $interests ?>;
  invested = columns.concat(invested);
  interests = columns.concat(interests);
  var invested = google.visualization.arrayToDataTable(invested);
  var interests = google.visualization.arrayToDataTable(interests);

  var options = {
    // title:"",
    width: 200,
    height: 330,
    legend: { position: 'top' },
    bar: { groupWidth: '75%' },
    
  };


  var interests_options = {
    // title:"",
    width: 200,
    height: 330,
    legend: { position: 'top' },
    bar: { groupWidth: '75%' },
    
  };
  

  var chartInterests = new google.visualization.ColumnChart(
  document.getElementById('interests_div'));
  
  var chartInvested = new google.visualization.ColumnChart(
  document.getElementById('invested_div'));


  chartInterests.draw(interests,interests_options);
  
  chartInvested.draw(invested,options);
} 
</script>
<style>
  .card {
    margin-top: 12px;
    border: thin solid #ccc;
    border-radius: 4px;
    height: 410px;
}
.card-body, .card-header, .card-footer {
    padding: 12px;
}
.card-label {
    text-transform: uppercase;
    font-size: 12px;
    font-family: 'IBM Plex Sans', sans-serif;
    min-height: 34px;
}
.card-value {
    font-size: 36px;
}
.card-summary {
    font-size: 10px;
    padding-left: 8px;
}
.card-header {
    border-bottom: thin solid #ccc;
}
.card-footer {
    border-top: thin solid #ccc;
}

</style>