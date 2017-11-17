<?php

namespace app\controllers;

use Yii;
use app\models\Appendix;
use app\models\AppendixSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AppendixController implements the CRUD actions for Appendix model.
 */
class AppendixController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'pdf', 'save-as-new', 'add-enrollment', 'add-enrollmentfee', 'add-enrollmentpayment', 'add-guardian', 'add-schedule', 'add-staff', 'add-student', 'add-teacher'],
                        'roles' => ['@']
                    ],
                    [
                        'allow' => false
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all Appendix models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AppendixSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Appendix model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerEnrollment = new \yii\data\ArrayDataProvider([
            'allModels' => $model->enrollments,
        ]);
        $providerEnrollmentfee = new \yii\data\ArrayDataProvider([
            'allModels' => $model->enrollmentfees,
        ]);

        $providerGuardian = new \yii\data\ArrayDataProvider([
            'allModels' => $model->guardians,
        ]);
        $providerSchedule = new \yii\data\ArrayDataProvider([
            'allModels' => $model->schedules,
        ]);
        $providerStaff = new \yii\data\ArrayDataProvider([
            'allModels' => $model->staff,
        ]);
        $providerStudent = new \yii\data\ArrayDataProvider([
            'allModels' => $model->students,
        ]);
        $providerTeacher = new \yii\data\ArrayDataProvider([
            'allModels' => $model->teachers,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerEnrollment' => $providerEnrollment,
            'providerEnrollmentfee' => $providerEnrollmentfee,
            'providerGuardian' => $providerGuardian,
            'providerSchedule' => $providerSchedule,
            'providerStaff' => $providerStaff,
            'providerStudent' => $providerStudent,
            'providerTeacher' => $providerTeacher,
        ]);
    }

    /**
     * Creates a new Appendix model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Appendix();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Appendix model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->request->post('_asnew') == '1') {
            $model = new Appendix();
        }else{
            $model = $this->findModel($id);
        }

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Appendix model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->deleteWithRelated();

        return $this->redirect(['index']);
    }
    
    /**
     * 
     * Export Appendix information into PDF format.
     * @param integer $id
     * @return mixed
     */
    public function actionPdf($id) {
        $model = $this->findModel($id);
        $providerEnrollment = new \yii\data\ArrayDataProvider([
            'allModels' => $model->enrollments,
        ]);
        $providerEnrollmentfee = new \yii\data\ArrayDataProvider([
            'allModels' => $model->enrollmentfees,
        ]);
        $providerGuardian = new \yii\data\ArrayDataProvider([
            'allModels' => $model->guardians,
        ]);
        $providerSchedule = new \yii\data\ArrayDataProvider([
            'allModels' => $model->schedules,
        ]);
        $providerStaff = new \yii\data\ArrayDataProvider([
            'allModels' => $model->staff,
        ]);
        $providerStudent = new \yii\data\ArrayDataProvider([
            'allModels' => $model->students,
        ]);
        $providerTeacher = new \yii\data\ArrayDataProvider([
            'allModels' => $model->teachers,
        ]);

        $content = $this->renderAjax('_pdf', [
            'model' => $model,
            'providerEnrollment' => $providerEnrollment,
            'providerEnrollmentfee' => $providerEnrollmentfee,
            'providerGuardian' => $providerGuardian,
            'providerSchedule' => $providerSchedule,
            'providerStaff' => $providerStaff,
            'providerStudent' => $providerStudent,
            'providerTeacher' => $providerTeacher,
        ]);

        $pdf = new \kartik\mpdf\Pdf([
            'mode' => \kartik\mpdf\Pdf::MODE_CORE,
            'format' => \kartik\mpdf\Pdf::FORMAT_A4,
            'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT,
            'destination' => \kartik\mpdf\Pdf::DEST_BROWSER,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '.kv-heading-1{font-size:18px}',
            'options' => ['title' => \Yii::$app->name],
            'methods' => [
                'SetHeader' => [\Yii::$app->name],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);

        return $pdf->render();
    }

    /**
    * Creates a new Appendix model by another data,
    * so user don't need to input all field from scratch.
    * If creation is successful, the browser will be redirected to the 'view' page.
    *
    * @param mixed $id
    * @return mixed
    */
    public function actionSaveAsNew($id) {
        $model = new Appendix();

        if (Yii::$app->request->post('_asnew') != '1') {
            $model = $this->findModel($id);
        }
    
        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('saveAsNew', [
                'model' => $model,
            ]);
        }
    }
    
    /**
     * Finds the Appendix model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Appendix the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Appendix::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for Enrollment
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddEnrollment()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('Enrollment');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formEnrollment', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for Enrollmentfee
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddEnrollmentfee()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('Enrollmentfee');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formEnrollmentfee', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for Enrollmentpayment
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddEnrollmentpayment()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('Enrollmentpayment');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formEnrollmentpayment', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for Guardian
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddGuardian()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('Guardian');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formGuardian', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for Schedule
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddSchedule()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('Schedule');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formSchedule', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for Staff
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddStaff()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('Staff');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formStaff', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for Student
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddStudent()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('Student');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formStudent', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for Teacher
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddTeacher()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('Teacher');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formTeacher', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
