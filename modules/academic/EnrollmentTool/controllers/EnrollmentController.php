<?php

namespace app\modules\academic\EnrollmentTool\controllers;

use app\models\Appendix;
use app\models\EnrollmentPayment;
use app\models\EnrollmentSearch;
use app\models\Fee;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use Yii;
use app\models\Enrollment;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Default controller for the `enrollment-tool` module
 */
class EnrollmentController extends Controller
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
                        'actions' => ['fee-update','enrollment-list','index', 'view', 'create','create-payment', 'update', 'delete', 'pdf', 'save-as-new', 'add-enrollment-fee', 'add-enrollment-payment'],
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
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

        $app = new Appendix();
        $branch = $app->getAllBranches();

        $searchModel = new EnrollmentSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);



        $providerProgram = new \yii\data\ArrayDataProvider([

        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'branch' => $branch,
        ]);
    }

    /**
     * Displays a single Enrollment model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $completeStudentName = $model->student->forenameEn . ' ' . $model->student->surnameEn . ' ( ' .
            $model->student->surnameKh . ' ' . $model->student->forenameKh . ' )';

        $providerEnrollmentFee = new \yii\data\ArrayDataProvider([
            'allModels' => $model->enrollmentFees,
        ]);

        $invoice = new \yii\data\ArrayDataProvider([
            'allModels' => $model->invoices
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'invoice' => $invoice,
            'providerEnrollmentFee' => $providerEnrollmentFee,
            'studentName' => $completeStudentName,
        ]);
    }

    /**
     * Creates a new Enrollment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $query = Fee::find()->select(['fee.id as id', 'fee.description as description', 'feeCategory.description as category'])
            ->leftJoin('feeCategory', 'fee.feeCategory_id = feeCategory.id')
            ->asArray()
            ->all();
        $feesArray = ArrayHelper::map($query, 'id', 'description', 'category');

        $app = new Appendix();
        $branch = $app->getAllBranches();

        $model = new Enrollment();


        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'feesArray' => $feesArray,
                'branch' => $branch,
            ]);
        }
    }

    /**
 * Updates an existing Enrollment model.
 * If update is successful, the browser will be redirected to the 'view' page.
 * @param integer $id
 * @return mixed
 */
    public function actionUpdate($id)
    {
        $query = Fee::find()->select(['fee.id as id', 'fee.description as description', 'feeCategory.description as category'])
            ->leftJoin('feeCategory', 'fee.feeCategory_id = feeCategory.id')
            ->asArray()
            ->all();
        $feesArray = ArrayHelper::map($query, 'id', 'description', 'category');

        $app = new Appendix();
        $branch = $app->getAllBranches();

        if (Yii::$app->request->post('_asnew') == '1') {
            $model = new Enrollment();
        }else{
            $model = $this->findModel($id);
        }


        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'enrollCode' => $model->enrollCode,
                'feesArray' => $feesArray,
                'branch' => $branch,
            ]);
        }
    }

    /**
     * Updates an existing Enrollment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionFeeUpdate($id)
    {

         $model = $this->findModel($id);

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('updateFee', [
                'model' => $model,
                'enrollCode' => $model->enrollCode,
            ]);
        }
    }

    /**
     * Deletes an existing Enrollment model.
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
     * Export Enrollment information into PDF format.
     * @param integer $id
     * @return mixed
     */
    public function actionPdf($id) {
        $model = $this->findModel($id);
        $providerEnrollmentFee = new \yii\data\ArrayDataProvider([
            'allModels' => $model->enrollmentFees,
        ]);
        $providerEnrollmentPayment = new \yii\data\ArrayDataProvider([
            'allModels' => $model->enrollmentPayments,
        ]);

        $content = $this->renderAjax('_pdf', [
            'model' => $model,
            'providerEnrollmentFee' => $providerEnrollmentFee,
            'providerEnrollmentPayment' => $providerEnrollmentPayment,
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
     * Creates a new Enrollment model by another data,
     * so user don't need to input all field from scratch.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @param mixed $id
     * @return mixed
     */
    public function actionSaveAsNew($id) {
        $model = new Enrollment();

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
     * Finds the Enrollment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Enrollment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Enrollment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Action to load a tabular form grid
     * for EnrollmentFee
     * @author Yohanes Candrajaya <moo.tensai@gmail.com>
     * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
     *
     * @return mixed
     */
    public function actionAddEnrollmentFee()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('EnrollmentFee');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formEnrollmentFee', ['row' => $row]);
        } else {
            $row[] = [];
            return $this->renderAjax('_formEnrollmentFee', ['row' => $row]);
        }
    }


    public function actionEnrollmentList($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new Query();
            $query->select(["enrollment.id","CONCAT(CONCAT(grade.description, ' | ',CONCAT(student.surnameEn,' ', student.forenameEn)), ' | ', enrollment.enrollCode) AS text"])
                ->from('enrollment')
                ->leftJoin('student','student.id = enrollment.student_id')
                ->leftJoin('grade', 'grade.id = enrollment.grade_id')
                ->where(['like', 'student.forenameEn', $q])
                ->orWhere(['like', 'student.surnameEn', $q])
                ->orWhere(['like', 'grade.description', $q])
                ->orWhere(['like', 'enrollment.enrollCode', $q])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = [
                'id' => $id,
                'text' => Enrollment::find()->where(['id' => $id])->one()->student->fullname,
                ];
        }
        return $out;
    }

}
