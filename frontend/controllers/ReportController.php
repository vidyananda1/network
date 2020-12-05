<?php

namespace frontend\controllers;

use app\models\Registration;
use app\models\Counter;
use app\models\Report;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * TaxController implements the CRUD actions for Tax model.
 */
class ReportController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['*'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        // 'actions' => ['index','create','update','view'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
     
        $model = new Report();
       
        $startDate = '';
        $endDate = '';
        if($model->load(Yii::$app->request->queryParams)) {
            $startDate = $model->start_date;
            $endDate  = $model->end_date;
            $investments = Registration::find()->select('registration.date,invest_amount as total,investor_name,member_code,referral_code')->asArray()->where(['between','date(registration.date)',$startDate,$endDate])->groupBy('registration.date,registration.member_code')->all();

            $sumInvestments = Registration::find()->select('SUM(invest_amount) as total')->asArray()->where(['between','date(date)',$startDate,$endDate])->all();

            $payments = Counter::find()->leftJoin('registration','registration.id=counter.member_code')->select('registration.investor_name as investor_name, registration.member_code as member_code, date_of_payment, rate_of_interest, invested_amount, paid_amount,rate_of_interest')->asArray()->where(['between','date(date_of_payment)',$startDate,$endDate])->andWhere(['counter.record_status'=>1])->all();

            $sumPayments = Counter::find()->select('SUM(paid_amount) as total')->asArray()->where(['between','date(date_of_payment)',$startDate,$endDate])->andWhere(['record_status'=>1])->all();
            
            // print_r($payments);die;
            return $this->render('index', [
                // 'searchModel' => $searchModel,
                // 'dataProvider' => $dataProvider,
                'investments' => $investments,
                'payments'=>$payments,
                'sumInvestments' => $sumInvestments[0]['total'],
                'sumPayments' => $sumPayments[0]['total'],
                'model' => $model,
            ]);
        }
        return $this->render('_form',['model'=>$model]);
       
    }

}
