<?php

namespace app\modules\people\controllers;

use yii\web\Controller;

/**
 * Default controller for the `people` module
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
