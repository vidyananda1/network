

<div class="row">
  <div class="col-md-6">
<div class="card" style="height: 440px;">
  <div class="card-header" style="background-color: #cfaded">
      <div class="row">
          <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
            Invested amount
          </div>
      </div>
  </div>
  <div class="card-body">
      <div id="invested_div" ></div>
  </div>
</div>
</div>
<div class="col-md-6">
<div class="card" style="height: 440px;">
  <div class="card-header" style="background-color: #cfaded">
      <div class="row">
          <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
            Interests amount
          </div>
      </div>
  </div>
  <div class="card-body">
    <div id="interests_div" ></div>
  </div>
</div>
</div>
</div>
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
    height: 400,
    legend: { position: 'top' },
    bar: { groupWidth: '75%' },
    
  };


  var interests_options = {
    // title:"",
    width: 200,
    height: 400,
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
  .container{
    display: flex;
    justify-content: space-around;
  }

  .card {
    margin-top: 12px;
    border: thin solid #ccc;
    border-radius: 4px;
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