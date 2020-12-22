<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AmountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $this->title = 'Amounts';
//$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="amount-index">

    <div class="panel panel-default" style="box-shadow: 4px 4px 7px grey">
    <div class="panel-heading ">
        <b class="text-muted">Create Amount Value</b>
    </div>
    <div class="panel-body table-responsive">
        
    

    <p>
        <?= Html::a('Create Amount', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped '],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'value',
            [
                'attribute'=>'value',
                'label'=>'Amount Value (in Rs)'
            ],
            // 'created_by',
            // 'created_date',
            // 'record_status',

            ['class' => 'yii\grid\ActionColumn',
                'template'=> '{update} '],
        ],
    ]); ?>

</div>
</div>
</div>
