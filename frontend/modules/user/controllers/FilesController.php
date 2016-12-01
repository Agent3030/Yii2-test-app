<?php

namespace frontend\modules\user\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * File download controller
 */
class FilesController extends Controller
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
     * @var
     * path to file
     */
    public $path;
    /**
     * init path for download
     */
    public function init()
    {
        $this->path = \Yii::$app->basePath . '/web/files/';
    }

    /**
     * @return
     * action for file download
     */

    public function actionDownload(string $filename)
    {

        return  \Yii::$app->response->sendFile($this->path . $filename);
    }
}
