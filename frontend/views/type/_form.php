<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Type */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="type-form">
	<br><br><br>
	<div class="raw">
		
		<div class="col-md-12">
			<p class="text-right">
				<?= Html::a('Back', ['index'], ['class' => 'btn btn-danger']) ?>
			</p>
			<div class="panel panel-primary" style="box-shadow: 4px 4px 7px #7682a3">
				<div class="panel-heading">
					<b>Create Referral-Types</b>
				</div>
					<div class="panel-body">
			
							    <?php $form = ActiveForm::begin(); ?>

							    <?= $form->field($model, 'type_name')->textInput(['maxlength' => true])->label('Referral-type name'); ?>

							    <div class="form-group text-center">
							        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
							    </div>

							    <?php ActiveForm::end(); ?>
					</div>
			</div>
		</div>
	</div>
</div>
