<?php

namespace frontend\controllers;

use Yii;
use app\models\Amount;
use app\models\AmountSearch;
use app\models\Member;
use app\models\Registration;
use app\models\Investor;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
/**
 * AmountController implements the CRUD actions for Amount model.
 */
class InvestorController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Amount models.
     * @return mixed
     */
    public function actionIndex()
    {
        // $this->layout="test.php";
        $model = new investor();
        $arr = null;
        $registrations = ArrayHelper::map(Registration::find()->select('member_code,investor_name')->where(['record_status'=>1])->all(),
        'member_code','investor_name');
        if($model->load(Yii::$app->request->get())) {
            // die($model->investor_name);
            $investor_name= $registrations[$model->investor_name];
            $referred_names = [ 'Bob','Alice','Mike','Carol'];
            $referred_names = Registration::find()->select('investor_name')->where(['record_status'=>1,'referral_code'=>$model->investor_name])->asArray()->all();
            $arr = [];
            foreach($referred_names as $key => $value) {
                $arr[]= [$value["investor_name"], $investor_name,''];
            }
            // echo "<pre>";print_r($arr);echo "</pre>";die;
            $arr= json_encode($arr);
            // echo "&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&";
            // print_r($arr);die;

        }

        return $this->render('index', [
            'arr' => $arr,
            'model' => $model,
            'registrations' => $registrations
        ]);
    }



    public function actionInvestorsList($investor_name) {
        $investors = Registration::find()->select('investor_name,member_code')->andFilterWhere(['like','investor_name',$investor_name])->asArray()->all();
        return json_encode($investors);
    }

    public function actionMembersList($member_code) {
        if(!isset($member_code) || $member_code=="")
            return null; 
        $registrations = ArrayHelper::map(Registration::find()->select('member_code,investor_name')->where(['record_status'=>1])->all(),
        'member_code','investor_name');
        $investor = Registration::find()->select('member_code,investor_name,aadhaar,phone,address,referral_status,referral_code')->where(['member_code'=>$member_code,'record_status'=>1])->asArray()->all();
        if(empty($investor))
            return null;
        $investor_name= $registrations[$member_code];
        $referred_names = Registration::find()->select('investor_name')->where(['record_status'=>1,'referral_code'=>$member_code])->asArray()->all();
        $arr = [];
        foreach($referred_names as $key => $value) {
            $arr[]= [$value["investor_name"], $investor_name,''];
        }
        $obj []= [ 'investor'=>$investor ,'referred' =>$arr];
        // echo "<pre>";print_r($arr);echo "</pre>";die;
        $obj= json_encode($obj);
        return $obj;
    }
    /**
     * Displays a single Amount model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Amount model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Amount();

       if ($model->load(Yii::$app->request->post()) ) {
            
            $model->created_by = Yii::$app->user->id;
            if(!$model->save()){
                print_r($model->errors);die;
                Yii::$app->session->setFlash('danger', 'Failed to save amount value!');
                return $this->redirect(Yii::$app->request->referrer);
            }else{
                Yii::$app->session->setFlash('success', 'Amount value Successfully Added!');
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Amount model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Amount model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();
        $model=$this->findModel($id);
        $model->record_status='0';
        $model->save();


        return $this->redirect(['index']);

        //return $this->redirect(['index']);
    }

    /**
     * Finds the Amount model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Amount the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Amount::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
