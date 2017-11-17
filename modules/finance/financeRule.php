<?php
namespace app\modules\finance;

use yii\rbac\Rule;
/**
 * finance module definition class
 */
class financeRule extends Rule
{
    /**
     * @inheritdoc
     */
    public function execute($user, $item, $params)
    {
        return isset($params['post']) ? $params['post']->createdBy == $user : false;
    }
}
