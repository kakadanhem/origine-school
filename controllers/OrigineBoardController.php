<?php

namespace app\controllers;

use Yii;
use app\models\AcademicYear;
use app\models\AcademicYearSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AcademicYearController implements the CRUD actions for AcademicYear model.
 */
class OrigineBoardController extends Controller
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
                        'actions' => ['index'],
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
     * Lists all AcademicYear models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}