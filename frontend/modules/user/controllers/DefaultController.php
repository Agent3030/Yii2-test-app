<?php

namespace frontend\modules\user\controllers;


use common\models\Images;
use common\models\User;
use yii\helpers\VarDumper;
use yii\imagine\Image;
use yii\base\Exception;
use yii\data\ActiveDataProvider;

use yii\web\UploadedFile;
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

    public function actionIndex(int $id = null)
    {
        $model = new Images();
        //create image
        if($model->load(\Yii::$app->request->post())){
            $model->user_id = $id;
            $image = UploadedFile::getInstance($model, 'image');
            if(isset($image)) {
                $name = $image->name;
                $url = "img";
                $model->image_path = $url.DIRECTORY_SEPARATOR.$name;
            }



            if(isset($model->image_path)) {
                $image->saveAs($model->image_path);
            }
            if($model->save(false)){
                return $this->refresh();
            } else {
                throw new Exception('Image not saved');
            }
        }
        //output and edit images

        $query = Images::find()
            ->where(['user_id'=>$id])
            ->andWhere(['status'=>Images::IMAGE_ACTIVE]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $this->render('index', [
            'model' => $model,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionRotateLeft(int $id = null)
    {

        $image = Images::findOne($id);

        $path = \Yii::getAlias('@webroot').$image->getImage();

        Image::getImagine()
            ->open($path)
            ->rotate(-90)
            ->save($path);
        return $this->redirect('index');

    }
    public function actionRotateRight(int $id = null)
    {

        $image = Images::findOne($id);

        $path = \Yii::getAlias('@webroot').$image->getImage();

        Image::getImagine()
            ->open($path)
            ->rotate(-90)
            ->save($path);
        return $this->redirect('index');

    }
    public function actionDelete(int $id = null)
    {

        $image = Images::findOne($id);
        $path = \Yii::getAlias('@webroot').$image->getImage();
        if($image){
            $image->delete();

        }

        if(file_exists($path)) {
            unlink($path);
        }




        return $this->redirect('index');

    }

}
