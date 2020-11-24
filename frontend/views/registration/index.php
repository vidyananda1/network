<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RegistrationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $this->title = 'Registrations';
// $this->params['breadcrumbs'][] = $this->title;
?>
<br><br><br>
<div class="registration-index">
    
    <div class="panel panel-default" style="box-shadow: 4px 4px 7px grey">
        <div class=" panel-heading">
            <b class="text-muted"> Showing Account Registration Details</b>
        </div>
            <div class="panel-body table-responsive">
            
                <p>
                    <?= Html::a('Create Registration', ['create'], ['class' => 'btn btn-primary']) ?>
                </p>

                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        //'id',
                        'investor_name',
                        'phone',
                        'address',
                        'aadhaar',
                        'date',
                        'member_code',
                        'referral_status',
                        'referral_code',
                        'regis_amount',
                        'invest_amount',
                        'total',
                        //'created_by',
                        //'created_date',
                        //'updated_by',
                        //'updated_date',
                        //'record_status',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>
    </div>
</div>
