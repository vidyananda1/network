<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Registration;
use app\models\Amount;
use yii\helpers\Url;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Counter */
/* @var $form yii\widgets\ActiveForm */
$code = ArrayHelper::map(Registration::find()->all(), 'id', 'member_code');
$amount = ArrayHelper::map(Amount::find()->all(), 'value', 'value');
?>

<div class="counter-form">
    
    <p class="text-right">
        <?= Html::a('Back', ['index'], ['class' => 'btn btn-danger']) ?>
    </p>   
    <div class="panel panel-default" style="box-shadow: 4px 4px 7px #7682a3">
        <div class="panel-heading">
            <b class="text-muted">
                Payment Details Entry
            </b>
        </div>
        <div class="panel-body" style="background-color: #f7f9fc;">
            <?php $form = ActiveForm::begin(); ?>
            <div class="row">
                <div class="col-md-4"> 
                   <?= $form->field($model, 'member_code')->widget(Select2::classname(), [
                                'data' => $code,
                                'language' => 'de',
                                'options' => ['placeholder' => '------- Select Member-Code -------'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])->label('Member Code'); 

                    ?>
                </div>
                <div class="col-md-4">
                   <?= $form->field($model, 'investor_name')->textInput(['maxlength' => true,'readonly'=>true]) ?>  
                </div>
                
                <div class="col-md-4">
                     <?= $form->field($model, 'date_of_payment')->widget(
                        DatePicker::className(), [
                            // inline too, not bad
                             'inline' => false, 
                             
                             'options' => ['placeholder' => '---- Select Date ----','class'=> 'date'],

                             // modify template for custom rendering
                            //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                                'clientOptions' => [
                                'autoclose' => true,
                                'todayHighlight' => true,
                                'format' => 'yyyy-mm-dd',     


                            ]
                    ])->label('Date of payment');?>
                </div>
                
            </div>
            <br><hr><br>
            <div class="row">
                <div class="col-md-6">
                   <?= $form->field($model, 'rate_of_interest')->textInput(['maxlength' => true])->label('Rate of interest (%)'); ?>
                </div>
                <div class="col-md-6">
                   <?= $form->field($model, 'invested_amount')->dropdownList($amount,['prompt'=>'------- Select Invested Amount -------'])->label('Invested Amount (Rs)'); ?> 
                </div>
                
                
                
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'paid_amount')->textInput(['maxlength' => true])->label('To be Paid (Rs)') ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'status')->dropDownList([ 'PENDING' => 'PENDING', 'PAID' => 'PAID', ], ['prompt' => '----- Select Payment Status -----'])->label('Payement Status') ?>
                </div> 
            </div>
            <br>
            <div class="form-group text-center">
                <?= Html::submitButton('Save', ['class' => 'btn btn-lg btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<?php
$name = Url::to(["name"]);
$this->registerJs('
    $(document).on("change", "#counter-member_code",   function () {
    var code = $("#counter-member_code").val();
    var url = "'.$name.'";
    $.post(url+"&id="+code, function(data) {
                if(!data)
                {
                  alert("Name not found !!");
                } 
                else{
                   $("#counter-investor_name").val(data); 
                }
            });
  });

  $("#counter-rate_of_interest").change(function() {  
        updateTotal();
    });

    $("#counter-invested_amount").change(function() {  
        updateTotal();
    });

    var updateTotal = function () {
      var input1 = $("#counter-rate_of_interest").val();
      var input2 = $("#counter-invested_amount").val();
      if(input1==""){
        input1 = 0;
      }else{
        input1=parseInt($("#counter-rate_of_interest").val());
      }
      if(input2==""){
        input2 = 0;
      }else{
        input2 = parseInt($("#counter-invested_amount").val());
      }

      $("#counter-paid_amount").val((input1/100)*input2 );
    };

') ?>