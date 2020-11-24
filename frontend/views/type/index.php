<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $this->title = 'Types';
// $this->params['breadcrumbs'][] = $this->title;
?>
<br><br><br>
<div class="type-index">
<div class="panel panel-default"  style="box-shadow: 4px 4px 7px grey">
    <div class="panel-heading">
        <b class="text-muted">Referral Types </b>
    </div>
    <div class="panel-body">
    <p>
        <?= Html::a('Create Referral-Type', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'type_name',
            // 'created_by',
            // 'created_date',
            // 'record_status',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}'],
        ],
    ]); ?>
</div>
</div>
</div>
