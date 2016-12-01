<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace console\controllers;

use yii\console\Controller;
use common\models\User;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = \Yii::$app->authManager;


        $user = $auth->createRole(User::ROLE_USER);
        $auth->add($user);

        $moderator = $auth->createRole(User::ROLE_MODERATOR);
        $auth->add($moderator);
        $auth->addChild($moderator, $user);

        $admin = $auth->createRole(User::ROLE_ADMINISTRATOR);
        $auth->add($admin);
        $auth->addChild($admin, $moderator);

        $auth->assign($admin, 1);
        $auth->assign($moderator, 2);
        $auth->assign($user, 3);
    }
}
