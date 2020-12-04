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

    public function actionPrint($id)
    {
        $model = new Registration();
        $details = Registration::find()->where(["id"=>$id])->one();
        
        // if ($model->load(Yii::$app->request->post()) ) {
        //    // return $this->redirect(['view', 'id' => $model->id]);
        // }
        

        return $this->renderAjax('print', [
            'model' => $model,
            'details'=>$details
        ]);
    }
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
                         $act = Registration::find()->where(['id'=>$model->id])->andwhere(['record_status'=>'1'])->one();
                            $phone = $act->phone;
                            //die($phone);
                            if(!$phone){
                                $transaction->rollBack();
                                Yii::$app->session->setFlash('danger', 'Phone No. not found!!');
                                return $this->redirect(['index',]); 

                            }else{
                                $msg = $act->investor_name.',registration successful.Your Member-Code is '.$act->member_code;
                                $act->send_msg($act->phone, $msg);
                            } 
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
                            //$referral->referred_by = $chk->investor_name;
                            $referral->referral_code = $model->referral_code;
                            $referral->investor_name = $model->investor_name;
                            $referral->investor_member_code = $model->member_code;
                            $referral->created_by = Yii::$app->user->id;

                            
                        }
                        if($referral->save()){

                            $act = Registration::find()->where(['id'=>$model->id])->andwhere(['record_status'=>'1'])->one();
                            $phone = $act->phone;
                                //die($phone);
                            if(!$phone){
                                    $transaction->rollBack();
                                    Yii::$app->session->setFlash('danger', 'Phone No. not found!!');
                                    return $this->redirect(['index',]); 

                            }else{
                                $msg = 'Hello, Mr/Mrs'.$act->investor_name.',Registration successful.Your Member-Code is '.$act->member_code;
                                $act->send_msg($act->phone, $msg);
                            }

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
                        //$ref->referred_by = $regis->investor_name;
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
                        //$referral->referred_by = $nam->investor_name;
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

                    $chk = ReferralDetails::find()->asArray()->where(['registration_id'=>$id])->all();
                    // echo "<pre>";
                    // print_r($chk);echo "</pre>";die;
                    if($chk){
                        foreach ($chk as $key => $value) {
                             
                            $ref = ReferralDetails::find()->where(['id'=>$value['id']])->one();
                            $ref->record_status='0';
                            $ref->save();                         
                        }

                        
                    }else{
                        $transaction->commit();
                        Yii::$app->session->setFlash('success', 'Successfully deleted and no previous record in Referral Details !');
                        return $this->redirect(['index',]);   
                    }

                    $chk1 = Counter::find()->asArray()->where(['investor_id'=>$id])->all();
                    if($chk1){
                        foreach ($chk1 as $key => $value) {

                            $counter = Counter::find()->where(['id'=>$value['id']])->one();
                            $counter->record_status='0';
                            $counter->save();  
                            //$transaction->commit(); 

                        }
                        $transaction->commit();
                        Yii::$app->session->setFlash('success', 'All details Successfully Deleted !');
                        return $this->redirect(['index']);
                        
                    }else{
                        //print_r($model->errors);die;
                         $transaction->commit();
                        Yii::$app->session->setFlash('success', 'Successfully deleted ...No previous record in Payment Details and Referral Details !');
                        return $this->redirect(['index',]);  
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
