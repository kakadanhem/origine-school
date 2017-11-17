<?php

namespace app\models;

use Yii;
use \app\models\base\InvoicePayment as BaseInvoicePayment;

/**
 * This is the model class for table "invoicepayment".
 */
class InvoicePayment extends BaseInvoicePayment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['invoice_id','paymentMethod_id', 'amount'], 'required'],
            [['invoice_id','paymentMethod_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['invoice_id','amount'], 'checkRequireAmount'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['code'], 'string', 'max' => 20],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }

    public function checkRequireAmount($attribute, $params, $validator){
        $amount = Yii::$app->formatter->asDecimal($this->amount,2);

        if(is_numeric($this->amount)){
            if($this->isNewRecord){
                $requireAmount = Yii::$app->formatter->asDecimal(Invoice::findOne($this->invoice_id)->finalAmountAfterDiscount - Invoice::findOne($this->invoice_id)->paidAmount, 2);
                if($amount > $requireAmount){
                    $this->addError($attribute, Yii::t('app', $amount . ' Amount receive is exceeded require amount ' . $requireAmount));
                }
            }
            else{
                $requireAmount = Invoice::findOne($this->invoice_id)->finalAmountAfterDiscount - Invoice::findOne($this->invoice_id)->paidAmount
                    + InvoicePayment::findOne($this->id)->amount;
                if($this->amount > $requireAmount){
                    $this->addError($attribute, Yii::t('app', 'Amount receive is exceeded require amount 2' ));
                }
            }
        }
        else{
            $this->addError($attribute, Yii::t('app', $this->amount .' is not a number.'));
        }
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if($this->isNewRecord){

            // SETTING PAYMENT CODE //
            $setting = Setting::findOne(['code' => 'PRE-PAY-CODE']);
            $parameter = '';

            if($setting->parameter1 != NULL){
                $parameter = $setting->analyzeParameter($setting->parameter1, $this->invoice->enrollment->branch);
            }
            if($setting->parameter2 != NULL){
                $parameter .= $setting->analyzeParameter($setting->parameter2,  $this->invoice->enrollment->branch);
            }
            if($setting->parameter3 != NULL){
                $parameter .= $setting->analyzeParameter($setting->parameter3,  $this->invoice->enrollment->branch);
            }
            if($setting->parameter4 != NULL){
                $parameter4 = $setting->analyzeParameter($setting->parameter4);
            }else{
                $parameter4 = 5;
            }

            $year = date('Y');

            if( strpos( $parameter, $year ) == true ) {
                $number = Student::find()->where(['like', 'code', $year])->count() + 1;
            }
            else{
                $number = Student::find()->count() + 1;
            }
            $this->code = $parameter . sprintf('%0' . $parameter4 . 'd',$number);
            // END SETTING PAYMEN CODE //
        }
        else{

        }

        return true;
    }

    public function afterSave($insert, $changedAttributes)
    {
        // GET PAYMENT THAT HAVE MAID FOR SPECIFIC INVOICE //
        $paidAmount = 0.0;
        parent::afterSave($insert, $changedAttributes);

        $paidAmount = $this->invoice->paidAmount;

        // SET INVOICE PAYMENT STATUS //
        if(($this->amount == $this->invoice->totalAmountAfterDiscount) || ($paidAmount == $this->invoice->totalAmountAfterDiscount )){
            $invoice = $this->invoice;
            $invoice->status_id = 17; // INVOICE IS PAID
            $invoice->save();
            $receipt = new Receipt();
            $receipt->link('invoice', $this->invoice);
        }
        else{
            $invoice = $this->invoice;
            $invoice->status_id = 18;
            $invoice->save();
        }

        // COUNT INVOICE PAYMENT STATUS TO SEE IF ALL INVOICE ARE PAID //
        $countAll = Invoice::find()->where([
            'enrollment_id' => $this->invoice->enrollment_id])->count();

        $countPartial = Invoice::find()->where([
            'enrollment_id' => $this->invoice->enrollment_id,
            'status_id' => '18'])->count();

        $countUnpaid = Invoice::find()->where([
                'enrollment_id' => $this->invoice->enrollment_id,
                'status_id' => '19'])->count();
        $enrollment = $this->invoice->enrollment;

        if($countAll > 0){
            if($countPartial == 0 && $countUnpaid == 0){
                $enrollment->paymentStatus_id = 17;
            }
            elseif($countPartial != 0){
                $enrollment->paymentStatus_id = 18;
            }
            else{

            }
            $enrollment->save();
        }
        else{}



    }
}
