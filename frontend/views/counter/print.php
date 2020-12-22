<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Member;
use common\models\User;



 //$name = ArrayHelper::map(Member::find()->all(),"user_id","mem_name");
// $itemNames = ArrayHelper::map(Items::find()->all(),"id","name");

// echo "<pre>"; print_r($orderDetails);echo "</pre>";
// echo "<pre>"; print_r($orderItems);echo "</pre>";

?>

<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<div class="row" style='position:relative'>
  <div class="col-md-12" style="text-align:center;">
    <div style="font-style:13px">Receipt</div>
    <div class="schoolname"><b>NK Groups</b></div>
    <div style="font-style:13px">New Checkon,Imphal</div>
    <div style="font-style:13px">Pin-795010,Manipur</div>
   
  </div>
  
 
  <div class="row" style="padding:0px 15px 15px 15px;">
    <div style="text-align:right;font-style:13px">Date: <?= date('d/m/Y') ?></div>
    <br>
    <table style="border:solid black 1px;width:100%;">
      <tr >
        <td colspan="4" style="background:gray;color:white">Paid interest amount of Ruppees (Rs) </td>
        <td colspan="2">Rs <?= $details->paid_amount ?></td>  
      </tr>
      <tr>
        <td colspan="3" style="background:gray;color:white">On account of </td>
        <td colspan="3"> <?= "Investment in NK Groups" ?></td>  
      </tr>
      <tr style="background:gray;color:white">
        <td colspan="3" >To</td>
        <td >Rate Of Interest</td>
        <td >Investment Amount</td>
        <td >Date of Payment</td>
      </tr>
      <tr >
        <td colspan="3" ><?= $details->investor_name ?></td>
        <td><?= $details->rate_of_interest ?> %</td> 
        <td>Rs <?= $details->invested_amount ?></td>
        <td><?= date('d-m-Y',strtotime($details->date_of_payment)) ?></td>
        
      </tr>
      
    </table>

   

    
  
    <div style="padding: 10px;background-color: gray;color: white">
      <span>Received By : <?php $user = Yii::$app->user->id; 
           $name= User::find()->where(['id'=>$user])->one() ;
            echo $name->username;

      ?></span>
    </div>
  </div>
</div>
  <br><br><br><br><br>

<div class="row" style='position:relative'>
  <div class="col-md-12" style="text-align:center;">
    <div style="font-style:13px">Receipt (Official Copy)</div>
    <div class="schoolname"><b>NK Groups</b></div>
    <div style="font-style:13px">New Checkon,Imphal</div>
    <div style="font-style:13px">Pin-795010,Manipur</div>
   
  </div>
  
 
  <div class="row" style="padding:0px 15px 15px 15px;">
    <div style="text-align:right;font-style:13px">Date: <?= date('d/m/Y') ?></div>
    <br>
    <table style="border:solid black 1px;width:100%;">
      <tr style="background:gray;color:white">
        <td colspan="4" style="background:gray;color:white">Paid interest amount of Ruppees (Rs) </td>
        <td colspan="2">Rs <?= $details->paid_amount ?></td>  
      </tr>
      <tr>
        <td colspan="3" style="background:gray;color:white">On account of </td>
        <td colspan="3"> <?= "Investment in NK Groups" ?></td>
      </tr>
      <tr style="background:gray;color:white">
        <td colspan="3" >To</td>
        <td >Rate of Interest</td>
        <td >Investment Amount</td>
        <td >Date of Payment</td>
      </tr>
      <tr >
        <td colspan="3" ><?= $details->investor_name ?></td>
        <td><?= $details->rate_of_interest ?> %</td> 
        <td>Rs <?= $details->invested_amount?></td>
        <td><?= date('d-m-Y',strtotime($details->date_of_payment)) ?></td>
        
      </tr>
      
    </table>

   

    
  
    <div style="padding: 10px;background-color: gray;color: white">
      <span>Received By : <?php $user = Yii::$app->user->id; 
           $name= User::find()->where(['id'=>$user])->one() ;
            echo $name->username;

      ?></span>
    </div>
  </div>
</div>


 

<style type="text/css">
.schoolname {
  font-size:24px;
}
body, body * {
  font-family: 'Open Sans', sans-serif;
}

/* _tables.scss:48 */
table {
  border-collapse: collapse;
  padding:15px 15px 15px 15px;
}

table, th, td {
  border: 1px solid black;
  padding: 5px;
}
img{
  z-index: 1000;
  height: 90px;
  position: absolute;
  left: 5%;
  top: 2%;
}
hr {
  border-style: dashed;
}
.noborder {
  border: none;
  width: 100%;
}
.noborder td {
  border: none;
  padding: 2px 4px;
}
/*.nobor  {
  border: none;
  width:100%;
  
}*/
.right {
  text-align: right;
}
.total {
  margin-right: 61px;
}
.total1 {
  margin-right: 63px;
}
</style>

<?php
$this->registerJs('window.print()');