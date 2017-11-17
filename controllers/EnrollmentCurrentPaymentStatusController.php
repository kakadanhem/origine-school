<?php

namespace app\controllers;

use Yii;
use app\models\EnrollmentCurrentPaymentStatus;
use app\models\EnrollmentCurrentPaymentStatusSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EnrollmentCurrentPaymentStatusController implements the CRUD actions for EnrollmentCurrentPaymentStatus model.
 */
class EnrollmentCurrentPaymentStatusController extends Controller
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
        ];
    }

    /**
     * Lists all EnrollmentCurrentPaymentStatus models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EnrollmentCurrentPaymentStatusSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EnrollmentCurrentPaymentStatus model.
     * @param integer $id
     * @param integer $enrollment_id
     * @param integer $status_id
     * @return mixed
     */
    public function actionView($id, $enrollment_id, $status_id)
    {
        $model = $this->findModel($id, $enrollment_id, $status_id);
        return $this->render('view', [
            'model' => $this->findModel($id, $enrollment_id, $status_id),
        ]);
    }

    /**
     * Creates a new EnrollmentCurrentPaymentStatus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EnrollmentCurrentPaymentStatus();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id, 'enrollment_id' => $model->enrollment_id, 'status_id' => $model->status_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing EnrollmentCurrentPaymentStatus model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $enrollment_id
     * @param integer $status_id
     * @return mixed
     */
    public function actionUpdate($id, $enrollment_id, $status_id)
    {
        $model = $this->findModel($id, $enrollment_id, $status_id);

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id, 'enrollment_id' => $model->enrollment_id, 'status_id' => $model->status_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing EnrollmentCurrentPaymentStatus model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $enrollment_id
     * @param integer $status_id
     * @return mixed
     */
    public function actionDelete($id, $enrollment_id, $status_id)
    {
        $this->findModel($id, $enrollment_id, $status_id)->deleteWithRelated();

        return $this->redirect(['index']);
    }

    
    /**
     * Finds the EnrollmentCurrentPaymentStatus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $enrollment_id
     * @param integer $status_id
     * @return EnrollmentCurrentPaymentStatus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $enrollment_id, $status_id)
    {
        if (($model = EnrollmentCurrentPaymentStatus::findOne(['id' => $id, 'enrollment_id' => $enrollment_id, 'status_id' => $status_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
