<?php

namespace app\modules\academic\EnrollmentTool;

/**
 * enrollment-tool module definition class
 */
class EnrollmentTool extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\academic\EnrollmentTool\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();
    }

    public function registerTranslations()
    {
        \Yii::$app->i18n->translations['modules/enrollment-tool/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@app/modules/admin/EnrollmentTool/messages',
            'fileMap' => [
                'modules/enrollment-tool/enrollment' => 'enrollment.php',
                'modules/enrollment-tool/payment' => 'payment.php',
            ],
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return \Yii::t('modules/enrollment-tool/' . $category, $message, $params, $language);

    }
}
