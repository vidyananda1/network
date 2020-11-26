<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CounterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $this->title = 'Counters';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="counter-index">

    <div class="panel panel-default"  style="box-shadow: 4px 4px 7px grey">
        <div class="panel-heading">
            <b class="text-muted">Showing Lists Of Paid Investors</b>
        </div>
        <div class="panel-body table-responsive">

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <p>
                <?= Html::a(' Pay Interest ', ['create'], ['class' => 'btn btn-md btn-warning']) ?>
            </p>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    'investor_name',
                    'member_code',
                    'date_of_payment',
                    'rate_of_interest',
                    'invested_amount',
                    'paid_amount',
                    'status',
                    'created_by',
                    // 'created_date',
                    // 'updated_by',
                    // 'updated_date',
                    // 'record_status',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>

</div>
