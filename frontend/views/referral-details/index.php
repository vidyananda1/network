<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Registration;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ReferralDetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $this->title = 'Referral Details';
// $this->params['breadcrumbs'][] = $this->title;


?>
<div class="referral-details-index">

    

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="panel panel-default" style="box-shadow: 4px 4px 7px grey">
        <div class="panel-heading">
            <b class="text-muted">Showing Investor's Referral Details</b>
        </div>
        
            <div class="panel-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        // 'id',
                        // 'registration_id',
                        
                        'investor_name',
                        //'investor_member_code',
                        [
                            'attribute'=>'investor_member_code',
                            'label'=> "Investor's Member Code",
                        ],
                        'referral_code',
                        [
                            'attribute'=>'registration_id',
                            'value' => function ($model)  {
                                
                                $find = Registration::find()->where(['id'=>$model->registration_id])->andWhere(['record_status'=>'1'])->one();
                                $name = Registration::find()->where(['member_code'=>$model->referral_code])->andWhere(['record_status'=>'1'])->one();

                                return isset($name) ? $name->investor_name : ' ';
                            },
                                'format' => 'raw',
                                'label' => 'Referred By',
                                'filter' => '',
                        ],
                        //'created_by',
                        //'created_date',
                        //'record_status',

                        // ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>
    </div>

</div>
