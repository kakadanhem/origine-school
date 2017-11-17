<?php

namespace app\modules\academic\EnrollmentTool\controllers;

use app\models\Fee;
use app\models\FeeCategory;
use Yii;
use app\models\EnrollmentFee;
use app\models\EnrollmentFeeSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EnrollmentFeeController implements the CRUD actions for EnrollmentFee model.
 */
class FeeController extends Controller
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
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'pdf', 'save-as-new'],
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
     * Lists all EnrollmentFee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EnrollmentFeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        $query = Fee::find()->select(['fee.id as id', 'fee.description as description', 'feeCategory.description as category'])
            ->leftJoin('feeCategory', 'fee.feeCategory_id = feeCategory.id')
            ->asArray()
            ->all();
        $feesArray = ArrayHelper::map($query, 'id', 'description', 'category');



        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'feeData' => $feesArray,
        ]);
    }

    /**
     * Displays a single EnrollmentFee model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new EnrollmentFee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EnrollmentFee();

        $query = Fee::find()->select(['fee.id as id', 'fee.description as description', 'feeCategory.description as category'])
            ->leftJoin('feeCategory', 'fee.feeCategory_id = feeCategory.id')
            ->asArray()
            ->all();
        $feesArray = ArrayHelper::map($query, 'id', 'description', 'category');

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'feeData' => $feesArray,
            ]);
        }
    }

    /**
     * Updates an existing EnrollmentFee model.
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
        if (Yii::$app->request->post('_asnew') == '1') {
            $model = new EnrollmentFee();
        }else{
            $model = $this->findModel($id);
        }

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'feeData' => $feesArray,
            ]);
        }
    }

    /**
     * Deletes an existing EnrollmentFee model.
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
     * Export EnrollmentFee information into PDF format.
     * @param integer $id
     * @return mixed
     */
    public function actionPdf($id) {
        $model = $this->findModel($id);

        $content = $this->renderAjax('_pdf', [
            'model' => $model,
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
    * Creates a new EnrollmentFee model by another data,
    * so user don't need to input all field from scratch.
    * If creation is successful, the browser will be redirected to the 'view' page.
    *
    * @param mixed $id
    * @return mixed
    */
    public function actionSaveAsNew($id) {
        $model = new EnrollmentFee();

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
     * Finds the EnrollmentFee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EnrollmentFee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EnrollmentFee::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
