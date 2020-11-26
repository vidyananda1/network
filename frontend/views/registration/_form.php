<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use app\models\Type;
use app\models\Amount;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Registration */
/* @var $form yii\widgets\ActiveForm */
$type= ArrayHelper::map(Type::find()->all(), 'type_name', 'type_name');
$amt= ArrayHelper::map(Amount::find()->all(), 'value', 'value');
?>


<div class="registration-form" >

<?php $form = ActiveForm::begin(); ?>
<p class="text-right">
    <?= Html::a('Back', ['index'], ['class' => 'btn btn-danger']) ?>
</p>
<div class="panel panel-default" style="box-shadow: 4px 4px 7px #7682a3">
    <div class="panel-heading">
        <b class="text-muted">Registration Entry</b>
    </div>
    <div class="panel-body" style="background-color: #f7f9fc;">
    <div class="row">
        <div class="col-md-4 col-xs-4">
           <?= $form->field($model, 'investor_name')->textInput(['maxlength' => true]) ?> 
        </div>
        <div class="col-md-4 col-xs-4">
           <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4 col-xs-4">
           <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?> 
        </div>
         
    </div>
    <br><hr><br>
    <div class="row">
        <div class="col-md-6 col-xs-6">
           <?= $form->field($model, 'aadhaar')->textInput(['maxlength' => true]) ?> 
        </div>
        <div class="col-md-6 col-xs-6">
           <?= $form->field($model, 'date')->widget(
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
                    ])->label('Select Date');?>
        </div>
         
    </div>
     <div class="row">
        <div class="col-md-6 col-xs-6">
           <?= $form->field($model, 'referral_status')->dropdownList($type,['prompt'=>'------- Select Referral-Type -------'])->label('Referral Status'); ?>
        </div>
        <div class="col-md-6 col-xs-6">
            <div id="code">
                <?= $form->field($model, 'referral_code')->textInput(['maxlength' => true]) ?>
            </div> 
        </div>  
         
    </div>
    <br><hr><br>
    <div class="row">
        <div class="col-md-4 col-xs-4">
           <?= $form->field($model, 'regis_amount')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4 col-xs-4">
           <?= $form->field($model, 'invest_amount')->dropdownList($amt,['prompt'=>'------- Select Amount -------'])->label('Investment Amount'); ?>
        </div>
        <div class="col-md-4 col-xs-4">
          <?= $form->field($model, 'total')->textInput(['maxlength' => true,'readonly'=> true]) ?> 
        </div>
         
    </div>
    
    <div class="form-group text-center " >
        <?= Html::submitButton('Save', ['class' => 'btn btn-lg btn-success']) ?>
    </div>
</div> 
</div>

    
    <?php ActiveForm::end(); ?>
</div>

<?php
    $this->registerJs('
    $("#registration-invest_amount").change(function() {  
        updateTotal();
    });

    $("#registration-regis_amount").change(function() {  
        updateTotal();
    });

    var updateTotal = function () {
      var input1 = $("#registration-invest_amount").val();
      var input2 = $("#registration-regis_amount").val();
      if(input1==""){
        input1 = 0;
      }else{
        input1=parseInt($("#registration-invest_amount").val());
      }
      if(input2==""){
        input2 = 0;
      }else{
        input2 = parseInt($("#registration-regis_amount").val());
      }

      $("#registration-total").val(input1 + input2);
    };

  

   $(document).ready(function(){
   $("#registration-referral_status").change(function(){
    //alert(this.value);
    if(this.value=="SELF"){
            $("#code").hide();
            
        }
        else{
            $("#code").show();
        }
    
    });
    });
    ')
?>
