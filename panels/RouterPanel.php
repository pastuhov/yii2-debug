<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\debug\panels;

use Yii;
use yii\debug\models\Router;
use yii\debug\Panel;
use yii\log\Logger;

/**
 * @author Dmitriy Bashkarev <dmitriy@bashkarev.com>
 * @since 2.0.8
 */
class RouterPanel extends Panel
{

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'Router';
    }

    /**
     * @inheritdoc
     */
    public function getDetail()
    {
        return Yii::$app->view->render('panels/router/detail', ['model' => new Router($this->data)]);
    }

    /**
     * @inheritdoc
     */
    public function save()
    {
        $target = $this->module->logTarget;
        return [
            'messages' => $target->filterMessages($target->messages, Logger::LEVEL_PROFILE | Logger::LEVEL_TRACE, ['yii\web\UrlManager::parseRequest', 'yii\web\UrlRule::parseRequest'])
        ];
    }

}
