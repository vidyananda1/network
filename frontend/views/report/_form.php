<?php
use dosamigos\datepicker\DateRangePicker;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$this->title = "Reports";
?>
<?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
]); ?>
        <?= $form->field($model, 'start_date')->widget(DateRangePicker::className(), [
            'attributeTo' => 'end_date', 
            // 'language' => 'ru',
            'labelTo' => 'to',
        //    'size' => 'lg',
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-d',
                'todayHighlight' => true,
            ]
        ])->label('Select Date Range');?>                        
        <button type="submit" id="btnSearch" class="btn btn-success" formtarget="_blank">Submit</button>
        <?= Html::a('Reset', ['index'], ['class' => 'btn btn-primary','size'=>'sm', 'header'=>'Create Tax']) ?>
    <?php ActiveForm::end(); ?>