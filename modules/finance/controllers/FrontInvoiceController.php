<?php

namespace app\modules\finance\controllers;

use app\models\base\Appendix;
use app\models\base\Enrollment;
use app\models\FrontInvoice;
use app\models\FrontInvoiceSearch;
use app\models\Grade;
use Yii;
use app\models\Invoice;
use app\models\InvoiceSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InvoiceController implements the CRUD actions for Invoice model.
 */
class FrontInvoiceController extends Controller
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
                        'actions' => ['index', 'view','nearly-due', 'create','create-specific', 'update', 'delete','test-pdf', 'pdf', 'save-as-new', 'add-invoiceitem', 'add-invoicepayment'],
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
     * Lists all Invoice models.
     * @return mixed
     */
    public function actionIndex()
    {
        $appen = new Appendix();
        $searchModel = new FrontInvoiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $query = Grade::find()->select(['grade.id as id', 'grade.description as description', 'program.description as category'])
            ->leftJoin('program', 'grade.program_id = program.id')
            ->asArray()
            ->all();

        $gradeArray = ArrayHelper::map($query, 'id', 'description', 'category');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'paymentStatus' => $appen->getPaymentStatus(),
            'grades' => $gradeArray,
        ]);
    }

    /**
     * Displays a single Invoice model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerInvoiceitem = new \yii\data\ArrayDataProvider([
            'allModels' => $model->invoiceitems,
        ]);
        $providerInvoicepayment = new \yii\data\ArrayDataProvider([
            'allModels' => $model->invoicepayments,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerInvoiceitem' => $providerInvoiceitem,
            'providerInvoicepayment' => $providerInvoicepayment,
        ]);
    }

    /**
     * Displays a single Invoice model.
     * @param integer $id
     * @return mixed
     */
    public function actionTestPdf($id)
    {
        $model = $this->findModel($id);
        $providerInvoiceitem = new \yii\data\ArrayDataProvider([
            'allModels' => $model->invoiceitems,
        ]);
        $providerInvoicepayment = new \yii\data\ArrayDataProvider([
            'allModels' => $model->invoicepayments,
        ]);
        return $this->render('_pdf', [
            'model' => $this->findModel($id),
            'providerInvoiceitem' => $providerInvoiceitem,
            'providerInvoicepayment' => $providerInvoicepayment,
        ]);
    }
    /**
     * Creates a new Invoice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $count = 0;
        $appen = new Appendix();
        $model = new FrontInvoice();

        $count = FrontInvoice::find()->count();
        $count = $count + 1;

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'paymentStatus' => $appen->getPaymentStatus(),
                'invoiceNumber' => 'INV' . sprintf('%07d',$count),
            ]);
        }
    }

    /**
     * Creates a new Invoice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateSpecific($eid)
    {
        $appen = new Appendix();
        $model = new FrontInvoice();

        $enroll = Enrollment::findOne($eid);

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create-specific', [
                'model' => $model,
                'is_amount' => '0',
                'paymentStatus' => $appen->getPaymentStatus(),
                'enroll' => $enroll,
            ]);
        }
    }

    /**
     * Updates an existing Invoice model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $appen = new Appendix();
        if (Yii::$app->request->post('_asnew') == '1') {
            $model = new FrontInvoice();
        }else{
            $model = $this->findModel($id);
        }

        $count = FrontInvoice::find()->count();
        $count += $count + 1;

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'discountTypes' => $appen->getDiscountTypes(),
                'paymentStatus' => $appen->getPaymentStatus(),
                'invoiceNumber' => $model->invoiceNo,
            ]);
        }
    }

    /**
     * Deletes an existing Invoice model.
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
     * Export Invoice information into PDF format.
     * @param integer $id
     * @return mixed
     */
    public function actionPdf($id) {
        $model = $this->findModel($id);
        $providerInvoiceitem = new \yii\data\ArrayDataProvider([
            'allModels' => $model->invoiceitems,
        ]);
        $providerInvoicepayment = new \yii\data\ArrayDataProvider([
            'allModels' => $model->invoicepayments,
        ]);

        $content = $this->renderAjax('_pdf', [
            'model' => $model,
            'providerInvoiceitem' => $providerInvoiceitem,
            'providerInvoicepayment' => $providerInvoicepayment,
        ]);

        $pdf = new \kartik\mpdf\Pdf([
            'mode' => \kartik\mpdf\Pdf::MODE_CORE,
            'format' => \kartik\mpdf\Pdf::FORMAT_A4,
            'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT,
            'destination' => \kartik\mpdf\Pdf::DEST_BROWSER,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '.kv-heading-1{font-size:18px} .invoice-logo{width: 30%;float: right;} .invoice-title{float:left; margin-top:20px; font-size: 18px;}',
            'options' => ['title' => \Yii::$app->name],
            'methods' => [
                'SetHeader' => [\Yii::$app->name],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);

        return $pdf->render();
    }

    /**
    * Creates a new Invoice model by another data,
    * so user don't need to input all field from scratch.
    * If creation is successful, the browser will be redirected to the 'view' page.
    *
    * @param mixed $id
    * @return mixed
    */
    public function actionSaveAsNew($id) {
        $model = new FrontInvoice();

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
     * Finds the Invoice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FrontInvoice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FrontInvoice::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for Invoiceitem
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddInvoiceitem()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('Invoiceitem');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formInvoiceitem', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for Invoicepayment
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddInvoicepayment()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('Invoicepayment');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formInvoicepayment', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }

    public function actionNearlyDue(){
        $nearlyDues = FrontInvoice::find()->andWhere('dueDate' > new \yii\db\Expression('NOW()'))->all();
        foreach($nearlyDues as $nearlyDue){
            echo $nearlyDue->invoiceNo;
        }
    }
}
