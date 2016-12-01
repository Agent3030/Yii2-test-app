<?php

namespace frontend\modules\user\controllers;


use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * Default controller for the `user` module
 */
class DefaultController extends Controller
{
    /**
     * access control for controller. Allow access only for registered users
     */

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }

    /**
     * Renders the index with download button
     */

    public function actionIndex()
    {
        return $this->render('index');
    }

}
