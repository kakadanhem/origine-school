<?php
use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;

if (\Yii::$app->user->can('finance-staff')) {
    $item = [
        [
            'label' => '<i class="paperfont action pixel60 paper-money1"></i>' . 'Fee',
            'active' => in_array(\Yii::$app->controller->id,['fee']),
            'url' => 'index.php?r=finance/fee'],
        [
            'label' => '<i class="paperfont action pixel60 paper-moneybag"></i>' . 'Fee Category',
            'active' => in_array(\Yii::$app->controller->id,['fee-category']),
            'url' => 'index.php?r=finance/fee-category'],

        [
            'label' => '<i class="paperfont action pixel60 paper-money"></i>' . 'Enrollment Fee',
            'active' => in_array(\Yii::$app->controller->id,['enrollment-fee']),
            'url' => 'index.php?r=finance/enrollment-fee'],
        [
            'label' => '<i class="paperfont action pixel60 paper-invoice2"></i>' . 'Invoice',
            'active' => in_array(\Yii::$app->controller->id,['invoice']),
            'url' => 'index.php?r=finance/invoice'],
        [
            'label' => '<i class="paperfont action pixel60 paper-invoiceitem"></i>' . 'Invoice Items',
            'active' => in_array(\Yii::$app->controller->id,['invoice-item']),
            'url' => 'index.php?r=finance/invoice-item'],
        [
            'label' => '<i class="paperfont action pixel60 paper-payment"></i>' . 'Payment',
            'active' => in_array(\Yii::$app->controller->id,['invoice-payment']),
            'url' => 'index.php?r=finance/invoice-payment'],

        [
            'label' => '<i class="paperfont action pixel60 paper-discount"></i>' . 'Discount',
            'active' => in_array(\Yii::$app->controller->id,['discount']),
            'url' => 'index.php?r=finance/discount'],

        [
            'label' => '<i class="paperfont action pixel60 paper-voucher2"></i>' . 'Group Discount',
            'active' => in_array(\Yii::$app->controller->id,['discount-group']),
            'url' => 'index.php?r=finance/discount-group'],
    ];
}
else{
    $item = [
        [
            'label' => '<i class="paperfont action pixel60 paper-invoice2"></i>' . 'Invoice',
            'active' => in_array(\Yii::$app->controller->id,['invoice']),
            'url' => 'index.php?r=finance/invoice'],
        [
            'label' => '<i class="paperfont action pixel60 paper-invoiceitem"></i>' . 'Invoice Items',
            'active' => in_array(\Yii::$app->controller->id,['invoice-item']),
            'url' => 'index.php?r=finance/invoice-item'],
        [
            'label' => '<i class="paperfont action pixel60 paper-payment"></i>' . 'Payment',
            'active' => in_array(\Yii::$app->controller->id,['invoice-payment']),
            'url' => 'index.php?r=finance/invoice-payment'],
    ];
}
echo \kartik\nav\NavX::widget([
    'encodeLabels' => false,
    'options'=>['class'=>'action-button'],
    'items' => $item,
]);
?>
