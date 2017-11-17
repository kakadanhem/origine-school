<?php

namespace app\commands;

use app\models\Invoice;
use yii\console\Controller;

/**
 * BranchController implements the CRUD actions for Branch model.
 */
class CheckInvoiceController extends Controller
{
    /**
     * Lists all Branch models.
     * @return mixed
     */
    public function actionIndex()
    {
        echo "What the fuck";
    }

    public function actionNearlyDue() {
        echo "Near due invoice is checked";
        $nearlyDues = Invoice::find()->andWhere('dueDate' > new \yii\db\Expression('NOW()'))->all();
        foreach($nearlyDues as $nearlyDue){
            echo $nearlyDue->invoiceNo;
        }
    }
}
