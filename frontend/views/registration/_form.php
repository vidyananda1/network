<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Registration */
/* @var $form yii\widgets\ActiveForm */
?>
<p class="text-right">
    <?= Html::a('Back', ['index'], ['class' => 'btn btn-danger']) ?>
</p>
<div class="panel " style="box-shadow: 4px 4px 7px #7682a3">
    <div class="panel-heading" style="text-align: center;font-size:18px;">
        <b class="text-muted" >Registration Entry</b>
    </div>
    <div class="panel-body" style="background-color: #f2f4f5">
        <div class="registration-form" style="padding: 20px;">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'investor_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'aadhaar')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'date')->textInput() ?>

            <?= $form->field($model, 'member_code')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'referral_status')->textInput() ?>

            <?= $form->field($model, 'referral_code')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'regis_amount')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'invest_amount')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'total')->textInput(['maxlength' => true]) ?>

            
            <div class="form-group text-center">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
