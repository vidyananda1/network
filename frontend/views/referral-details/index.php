<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Registration;
use yii\helpers\ArrayHelper;
use kartik\export\ExportMenu;
use common\models\User;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ReferralDetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $this->title = 'Referral Details';
// $this->params['breadcrumbs'][] = $this->title;

$user= ArrayHelper::map(User::find()->all(), 'id', 'username');
?>
<div class="referral-details-index">
    <?php 
        $gridColumns = [
            
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
                    [
                        'attribute'=>'created_by',
                        'value' => function ($model) use($user) {
                        return isset($model->created_by) ? $user[$model->created_by] : ' ';
                        },
                        'format' => 'raw',
                        'label' => 'User',
                        'filter' => '',

                    ],

        ];

            
    ?>

    

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="panel panel-default" style="box-shadow: 4px 4px 7px grey">
        <div class="panel-heading">
            <b class="text-muted" style="font-size: 17px">Showing Investor's Referral Details</b>
            <p >
                <?php
                    echo ExportMenu::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => $gridColumns,
                    'exportConfig' => [
                        ExportMenu::FORMAT_PDF => false,
                        ExportMenu::FORMAT_HTML => false,
                        ExportMenu::FORMAT_TEXT => false,
                        //ExportMenu::FORMAT_EXCEL => false,
                    ],
                ])  
                ?>
            </p>
        </div>
        
            <div class="panel-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        // 'id',
                        // 'registration_id',
                        [
                            'attribute'=>'investor_member_code',
                            'label'=> "Investor's Member Code",
                        ],
                        'investor_name',
                        //'investor_member_code',
                       
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
                        [
                        'attribute'=>'created_by',
                        'value' => function ($model) use($user) {
                        return isset($model->created_by) ? $user[$model->created_by] : ' ';
                        },
                        'format' => 'raw',
                        'label' => 'User',
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
