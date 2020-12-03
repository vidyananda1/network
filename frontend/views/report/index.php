<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use app\models\Items;
use app\models\Category;
use app\models\OrderDetail;
use yii\helpers\ArrayHelper;
use kartik\export\ExportMenu;
use app\models\Customer;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DateRangePicker;

$this->title = 'Reports';
?>

<div class="headings">Investments</div>
    

<table style="border:solid black 1px;width:100%;">
    <tr>
        <th>Investor Name</th>
        <th>Member code</th>
        <th>Referral code</th>
        <th>Invested Amount</th>
        <th>Date</th>
    </tr>

<?php
foreach($investments as $key=>$value) { 
?>
<tr>
    <td><?=$value["investor_name"]?></td>
    <td><?=$value["member_code"]?></td>
    <td><?=isset($value["referral_code"]) ? $value["referral_code"] : "" ?></td>
    <td><?=$value["total"]?></td>
    <td><?= date('d-m-Y',strtotime($value["date"]))?></td>
</tr>
<?php } ?>
<tr><td class="sub-header" colspan="2">Total Invested(in Rs.)</td><td colspan="3" class="sub-header"><?=$sumInvestments?></td></tr>
</table>
<br><br><br>
<div class="headings">Payments</div>
<table style="border:solid black 1px;width:100%;">
<tr>
        <th>Investor Name</th>
        <th>Member Code</th>
        <th>Rate of interest(in %)</th>
        <th>Paid Amount</th>
        <th>Date</th>
        
    </tr>
<?php

foreach($payments as $key=>$value) { 
?>
<tr>
    <td><?=$value["investor_name"]?></td>
    <td><?=$value["member_code"]?></td>
    <td><?=$value["rate_of_interest"]?></td>
    <td><?=$value["paid_amount"]?></td>
    <td><?= date('d-m-Y',strtotime($value["date_of_payment"]))?></td>
</tr>


<?php } ?>
<tr><td class="sub-header" colspan="2">Total Payments(in Rs.)</td><td colspan="3" class="sub-header"><?=$sumPayments?></td></tr>

</table>

<br>

<div class="headings">Total (Investments-Payments): Rs<span style="margin-left: 10px;"><?=$sumInvestments-$sumPayments ?></span></div>

<style >
    table,th,td {
        border: 1px solid;
        font-family: 'Open Sans';
        text-align: center;
    }
    .headings{
        font-size: 1.5em;
        font-family: 'Open Sans';
        /* margin-left: 50px; */
    }
    .sub-header{
        text-align: center;
        /* font-weight:bold */
    }
@media print {
  header,footer { 
    display: none; 
  }
}



</style>
<?php
//  $url = Url::to(["index"]);
$this->registerJs('
console.log("1");
window.print();
');