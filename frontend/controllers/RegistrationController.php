<?php

namespace frontend\controllers;

use Yii;
use app\models\Registration;
use app\models\RegistrationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ReferralDetails;
use app\models\Counter;

/**
 * RegistrationController implements the CRUD actions for Registration model.
 */
class RegistrationController extends Controller
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
     * Lists all Registration models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RegistrationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['record_status'=>'1']);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Registration model.
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
     * Creates a new Registration model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
public function actionCreate()
{
    $model = new Registration();  

       if ($model->load(Yii::$app->request->post()) ) {
            $model->investor_name = strtoupper($model->investor_name);
            $member_code = "NK".$this->randomNoGenerator(4);
            $model->member_code = $member_code;
            $model->created_by = Yii::$app->user->id;

            $transaction = Yii::$app->db->beginTransaction();
        try { 
            if(!$model->save()){
                //print_r($model->errors);die;
                Yii::$app->session->setFlash('danger', 'Failed to registered Investor!');
                return $this->redirect(Yii::$app->request->referrer);
            }else{
               
                    if($model->referral_status == 'SELF'){
                        $transaction->commit();
                        Yii::$app->session->setFlash('success', 'Successfully Registered with referral status Self!');
                        return $this->redirect(['index']);
                }else{
                        $chk = Registration::find()->where(['member_code'=>$model->referral_code])->andwhere(['record_status'=>'1'])->one();
                        if(!$chk){
                            $transaction->rollBack();
                            Yii::$app->session->setFlash('danger', 'Failed to Register,Member Code not found!');
                            return $this->redirect(['index',]);
                        }else{
                            $referral = new ReferralDetails();
                            $referral->registration_id = $model->id;
                            $referral->referred_by = $chk->investor_name;
                            $referral->referral_code = $model->referral_code;
                            $referral->investor_name = $model->investor_name;
                            $referral->investor_member_code = $model->member_code;
                            $referral->created_by = Yii::$app->user->id;

                            
                        }
                        if($referral->save()){
                                $transaction->commit();
                                Yii::$app->session->setFlash('success', 'Successfully Registered!');
                                return $this->redirect(['index']);
                            }
                            $transaction->rollBack();
                            Yii::$app->session->setFlash('danger', 'Failed to Register in ReferralDetails!');
                            return $this->redirect(['index',]);       
                    }
                    
                    }
                    
                }
                catch (Exception $e) {
                          $transaction->rollBack();
                        }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function randomNoGenerator($digits) {
        return rand(pow(10, $digits-1), pow(10, $digits)-1);
    }

    /**
     * Updates an existing Registration model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
public function actionUpdate($id)
    {
    $model = $this->findModel($id);

       
    if ($model->load(Yii::$app->request->post()) ) {
            $model->investor_name = strtoupper($model->investor_name);
            $model->updated_by = Yii::$app->user->id;
            $model->updated_date = date("Y-m-d h:i:sa");
            $transaction = Yii::$app->db->beginTransaction();

        try {
                if(!$model->save()){
                    //print_r($model->errors);die;
                    Yii::$app->session->setFlash('danger', 'Failed to update registered Investor!');
                    return $this->redirect(Yii::$app->request->referrer);
            }else{
               
                $chk = ReferralDetails::find()->where(['registration_id'=>$id])->andwhere(['record_status'=>'1'])->one();
                
                if(!$chk){
                    if($model->referral_status == 'SELF'){
                        $transaction->commit();
                        Yii::$app->session->setFlash('success', 'Successfully update with no Referral Details!');
                        return $this->redirect(['index']);
                    }else{
                        $ref= new ReferralDetails();
                        $ref->registration_id = $id;
                        $regis = Registration::find()->where(['member_code'=>$model->referral_code])->andwhere(['record_status'=>'1'])->one();
                        //die($regis->investor_name);
                        $ref->referred_by = $regis->investor_name;
                        $ref->investor_name = $model->investor_name;
                        $ref->referral_code = $model->referral_code;
                        $ref->investor_member_code = $model->member_code;
                        $ref->created_by = Yii::$app->user->id;
                        if($ref->save()){
                                $transaction->commit();
                                Yii::$app->session->setFlash('success', 'Successfully Updated and change referral status from Self to Referral !');
                                return $this->redirect(['index']);
                            }
                            //print_r($model->errors);die;
                            $transaction->rollBack();
                            Yii::$app->session->setFlash('danger', 'Failed to Update and change referral status from Self to Referral !');
                            return $this->redirect(['index',]);
                    }
                     

                    
                }else{
                    if($model->referral_status == 'SELF'){
                        $member =  ReferralDetails::find()->where(['registration_id'=>$id])->andwhere(['record_status'=>'1'])->one();
                        $member->record_status = '0';

                        if(!$member->save()){
                            $transaction->rollBack();
                            Yii::$app->session->setFlash('danger', 'Failed to update and change referral status from Referral to Self !');
                            return $this->redirect(['index']);
                        }else{
                            $model->referral_code = Null;
                            if(!$model->save()){
                                $transaction->rollBack();
                                Yii::$app->session->setFlash('danger', 'Failed to update and change referral status from Referral to Self as referal code cannot be null !');
                                return $this->redirect(['index']);  
                            }

                            $transaction->commit();
                            Yii::$app->session->setFlash('success', 'Successfully Updated and change referral status from Referral to Self !');
                            return $this->redirect(['index']);    
                        }
                        
                    }else{   
                        $referral = ReferralDetails::find()->where(['registration_id'=>$id])->andwhere(['record_status'=>'1'])->one();
                        $referral->registration_id = $model->id;
                        $nam = Registration::find()->where(['member_code'=>$model->referral_code])->andwhere(['record_status'=>'1'])->one();
                        $referral->referred_by = $nam->investor_name;
                        $referral->investor_name = $model->investor_name;
                        $referral->referral_code = $model->referral_code;

                        } 
                        if($referral->save()){
                                $transaction->commit();
                                Yii::$app->session->setFlash('success', 'Successfully Updated !');
                                return $this->redirect(['index']);
                            }
                            $transaction->rollBack();
                            Yii::$app->session->setFlash('danger', 'Failed to Update in ReferralDetails!');
                            return $this->redirect(['index',]);         
                    }
                    
                }
                    
            }
            catch (Exception $e) {
                      $transaction->rollBack();
                    }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
}

    /**
     * Deletes an existing Registration model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        // $this->findModel($id)->delete();
        // return $this->redirect(['index']);
        $model=$this->findModel($id);
        $model->record_status='0';

        $transaction = Yii::$app->db->beginTransaction();
        try {
        
                if(!$model->save()){
                    Yii::$app->session->setFlash('danger', 'Unable to delete Investor in Registration Details!');
                    return $this->redirect(Yii::$app->request->referrer);
                }else{

                   
                    $refer = ReferralDetails::find()->where(['registration_id'=>$id])->andwhere(['record_status'=>'1'])->one();
                    $refer->record_status='0';

                    
                    

                    if(!$refer->save()){

                        $transaction->rollBack();
                        Yii::$app->session->setFlash('danger', 'Unable to delete Investor in ReferralDetails!');
                        return $this->redirect(Yii::$app->request->referrer);
                    }else{

                        $payment = Counter::find()->asArray()->where(['investor_id'=>$id])->andwhere(['record_status'=>'1'])->all();
                        foreach ($payment as $key => $value) {
                            $counter = Counter::find()->where(['investor_id'=>$id])->andwhere(['record_status'=>'1'])->one();
                            $counter->record_status='0';

                            if(!$counter->save()){

                                $transaction->rollBack();
                                Yii::$app->session->setFlash('danger', 'Unable to delete Investor in Payment Table!');

                            }

                        }
                        $transaction->commit();
                        Yii::$app->session->setFlash('success', 'All details of the Investor Deleted  !');
                        return $this->redirect(['index']);    
                    }
                        

                }
            }
            catch (Exception $e) {
                      $transaction->rollBack();
                    }


        return $this->redirect(['index']);
    }

    public function actionAmount($amt,$reg_amt)
    {
        $total= $amt+$reg_amt;
        if($total){
            return $total;
        }else{
            return 0;
        }
    }

    /**
     * Finds the Registration model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Registration the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Registration::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
