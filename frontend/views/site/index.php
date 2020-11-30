<div class="container">
  <div id="invested_div" ></div>
  <div id="interests_div" ></div>
</div>
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
    title:"Invested amount",
    width: 200,
    height: 400,
    legend: { position: 'top' },
    bar: { groupWidth: '75%' },
    
  };


  var interests_options = {
    title:"Interests amount",
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
</style>