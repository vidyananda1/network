<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Member */
/* @var $form yii\widgets\ActiveForm */

$roles = ['admin'=>'Admin'];
?>

<div class="member-form">
    <p class="text-right">
        <?= Html::a('Back', ['index'], ['class' => 'btn btn-danger']) ?>
    </p>
    <div class="panel " style="box-shadow: 4px 4px 7px #7682a3">
        <div class="panel-heading" style="text-align: center">
            <b class="text-muted">Create User</b>
        </div>
            <div class="panel-body" style="background-color: #f2f4f5">

                <?php $form = ActiveForm::begin([
                    'id' => 'user-form'
                ]); ?>

                <?= $form->field($model, 'mem_name')->textInput(['maxlength' => true])?>

                <?= $form->field($model, 'address')->textarea(['maxlength' => true]) ?>

                <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'username',['enableAjaxValidation'=>true]) ?>

                <?= $form->field($model, 'password')->textInput(['maxlength' => true,'type'=>'password']) ?>

                <?= $form->field($model, 'name')->dropDownList($roles,['prompt'=>"Select Role"]) ?>

                <div class="form-group text-center">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
    </div>
</div>
