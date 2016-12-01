<?php

namespace frontend\modules\user\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * Controller for payment operation
 */
class PaymentController extends Controller
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
     * Renders the index with payment button
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @return \yii\web\Response
     * got post response from paypal when payment success
     * disable csrf validation for paypal post
     */

    public function actionSuccsess()
    {
        $this->enableCsrfValidation= false;

        return $this->redirect('/user/default/index');

   }
    /**
     * @return \yii\web\Response
     * got post response from paypal when payment cancel
     * disable csrf validation for paypal post
     */

    public function actionCancel()
    {
        $this->enableCsrfValidation= false;

        return $this->redirect('/site/index');
    }

}
