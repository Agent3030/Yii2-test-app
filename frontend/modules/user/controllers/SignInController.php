<?php

namespace frontend\modules\user\controllers;

use common\models\User;

use frontend\modules\user\models\LoginForm;
use frontend\modules\user\models\SignupForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\modules\user\models\PasswordResetRequestForm;
use app\modules\user\models\ResetPasswordForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii;

/**
 * Default controller for the `user` module
 */
class SignInController extends Controller
{

    /**
     * controller access rules
     * allow signup login action to unregistred user
     * block access to signup & login action to register user
     * allow access to logout action to registered users
     */

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'signup', 'login'
                        ],
                        'allow' => true,
                        'roles' => ['?']
                    ],
                    [
                        'actions' => [
                            'signup', 'login'
                        ],
                        'allow' => false,
                        'roles' => ['@'],
                        'denyCallback' => function () {
                            return Yii::$app->controller->redirect(['/user/sign-in/login']);
                        }
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post']
                ]
            ]
        ];
    }

    /**
     * login action
     * @return Response
     *
     */
    public function actionLogin()
    {

        $model = new LoginForm();

        if ($model->load(\Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['/user/default/index', 'id'=>Yii::$app->user->id]);
        }

        return $this->render('login', [
            'model' => $model
        ]);

    }
    /**
     * logout action
     * @return Response
     */
    public function actionLogout()
    {
        \Yii::$app->user->logout();

        return $this->redirect('/site/index');
    }

    /**
     * signup action
     * @return string|Response
     */
    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(\Yii::$app->request->post())) {

            $user = $model->signup();

            if ($user) {

                    \Yii::$app->getUser()->login($user);


                return $this->goHome();
            }
        }

        return $this->render('signup', [
            'model' => $model
        ]);
    }

}
