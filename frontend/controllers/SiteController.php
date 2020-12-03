<?php
namespace frontend\controllers;

use app\models\Counter;
use app\models\Registration;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\LoginForm;
use frontend\models\SignupForm;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $data_invested = Registration::find()->where(['record_status'=>1])->select('sum(invest_amount) as total,month(date) as month')->groupBy('month (date)')->asArray()->all();
        $data_interest = Counter::find()->where(['record_status'=>1])->select('sum(paid_amount) as total,month(date_of_payment) as month')->groupBy('month (date_of_payment)')->asArray()->all();
        $invested =$this->formatData($data_invested);
        $interests =$this->formatData($data_interest);
        // echo "<pre>";print_r($invested);echo "<pre>";
        // echo "<pre>";print_r($interest);echo "<pre>";die;
        return $this->render('index',[
            'invested'=>json_encode($invested),
            'interests'=>json_encode($interests)
            ]);
    }

    public function formatData($data){
        $formatted_data = [];
        foreach($data as $key => $value) {
            $dateObj   = \DateTime::createFromFormat('!m', $value["month"]);
            $monthName = $dateObj->format('F'); // March
            $total = floatval($value["total"]);
            $formatted_data[] =  [$monthName,$total];
        }
        return $formatted_data;
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }
}
