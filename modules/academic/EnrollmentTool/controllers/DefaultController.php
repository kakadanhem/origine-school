<?php

namespace app\modules\academic\EnrollmentTool\controllers;

use app\models\EnrollmentSearch;
use yii\web\Controller;

/**
 * Default controller for the `enrollment-tool` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

        return $this->render('index');
    }
}
