<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Registration;
use common\models\User;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CounterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $this->title = 'Counters';
// $this->params['breadcrumbs'][] = $this->title;
$mem_code= ArrayHelper::map(Registration::find()->where(['record_status'=>'1'])->all(), 'id', 'member_code');
$user= ArrayHelper::map(User::find()->all(), 'id', 'username');
?>

<?php 
         $gridColumns = [
            'investor_name',
                    //'member_code',
                    [
                        'attribute'=>'member_code',
                        'value' => function ($model) use($mem_code) {
                            if($mem_code){
                              return isset($model->member_code ) ? $mem_code[$model->member_code] : ' ';  
                          }else{
                            return ' ';
                          }
                        
            
                        },
                        'format' => 'raw',
                        'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'member_code',
                                'options' => ['prompt' => 'Select Member code ...'],
                                'pluginOptions' => ['allowClear' => true],
                                'data' => $mem_code,
                        ]),
                    ],
                    'date_of_payment',
                    //'rate_of_interest',
                    [
                        'attribute'=>'rate_of_interest',
                        'filter'=>'',
                    ],
                    //'invested_amount',
                    [
                        'attribute'=>'invested_amount',
                        'filter'=>'',
                    ],
                    //'paid_amount',
                    [
                        'attribute'=>'paid_amount',
                        'filter'=>'',
                    ],
                    //'status',
                    [
                        'attribute'=>'status',
                        'contentOptions' => function ($model) {
                            if($model->status == "PAID"){
                                return ['style' => 'color:green;font-weight:bold;background-color:#ccfcd2'];
                            }else{
                                 return ['style' => 'color:red;font-weight:bold;background-color:#ffe9e0'];
                            }

                        },
                        'label'=>'Payment Status',
                        'filter'=>'',
                    ],
                    // [
                    //     'attribute' => 'status',
                    //     'contentOptions' => function ($model) {
                    //         return ['style' => 'color:'
                    //             . ($model->status == 'PAID' ? 'green' : 'red')];
                    //             },
                    // ],
                    //'created_by',
                    [
                        'attribute'=>'created_by',
                        'value' => function ($model) use($user) {
                        return isset($model->created_by) ? $user[$model->created_by] : ' ';
                        },
                        'format' => 'raw',
                        'label' => 'Paid By',
                        'filter' => '',

                    ],

    ];

            
    ?>
<div class="counter-index">

    <div class="panel panel-default"  style="box-shadow: 4px 4px 7px grey">
        <div class="panel-heading">
            <b class="text-muted" style="font-size: 17px">Showing Lists Of Paid Investors</b>
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
                    //'member_code',
                    [
                        'attribute'=>'member_code',
                        'value' => function ($model) use($mem_code) {
                            if($mem_code){
                              return isset($model->member_code ) ? $mem_code[$model->member_code] : ' ';  
                          }else{
                            return ' ';
                          }
                        
            
                        },
                        'format' => 'raw',
                        'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'member_code',
                                'options' => ['prompt' => 'Select Member code ...'],
                                'pluginOptions' => ['allowClear' => true],
                                'data' => $mem_code,
                        ]),
                    ],
                    'date_of_payment',
                    //'rate_of_interest',
                    [
                        'attribute'=>'rate_of_interest',
                        'filter'=>'',
                    ],
                    //'invested_amount',
                    [
                        'attribute'=>'invested_amount',
                        'filter'=>'',
                    ],
                    //'paid_amount',
                    [
                        'attribute'=>'paid_amount',
                        'filter'=>'',
                    ],
                    //'status',
                    [
                        'attribute'=>'status',
                        'contentOptions' => function ($model) {
                            if($model->status == "PAID"){
                                return ['style' => 'color:green;font-weight:bold;background-color:#ccfcd2'];
                            }else{
                                 return ['style' => 'color:red;font-weight:bold;background-color:#ffe9e0'];
                            }

                        },
                        'label'=>'Payment Status',
                        'filter'=>'',
                    ],
                    // [
                    //     'attribute' => 'status',
                    //     'contentOptions' => function ($model) {
                    //         return ['style' => 'color:'
                    //             . ($model->status == 'PAID' ? 'green' : 'red')];
                    //             },
                    // ],
                    //'created_by',
                    [
                        'attribute'=>'created_by',
                        'value' => function ($model) use($user) {
                        return isset($model->created_by) ? $user[$model->created_by] : ' ';
                        },
                        'format' => 'raw',
                        'label' => 'Paid By',
                        'filter' => '',

                    ],
                    // 'created_date',
                    // 'updated_by',
                    // 'updated_date',
                    // 'record_status',

                    ['class' => 'yii\grid\ActionColumn',
                        'template' => '{update}',
                ],
                ],
            ]); ?>
        </div>
    </div>

</div>
