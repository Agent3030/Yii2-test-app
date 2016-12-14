<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/**
 * Image gallery view file
 */
$this->title = 'Image Gallery';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1 class="text-center">Download zip file</h1>
<div class = "row">
    <div class = "col-md-12">
        <h1><?=$this->title?></h1>

        <div class = "row">
            <div class="col-md-12">
                <h2>Upload Image</h2>
                <?php $form = ActiveForm::begin([
                    'options'=>['enctype'=>'multipart/form-data']
                ]); ?>

                              <?php echo $form->field($model, 'image')->widget(
                    \kartik\file\FileInput::classname(),[
                    'options' => ['accept' => 'image/*',
                        'id'=>'media-block-image'],

                    'pluginOptions'=>[
                        'allowedFileExtensions'=>[
                            'jpg','gif','png','svg'
                        ],

                        'initialPreviewAsData'=>true,
                        'overwriteInitial'=>true,
                    ]
                ]) ?>



                <?= $form->field($model, 'status')->dropDownList([
                    '2' => 'Active',
                    '1' => 'Not active',
                ]) ?>


                <div class="form-group">
                    <?= Html::submitButton('Upload Image', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
            <div class="col-md-12">
                <h2>Gallery</h2>
                <div class = "row">
                <?= \yii\widgets\ListView::widget([
                        'dataProvider' => $dataProvider,
                        'pager' => [

                            'prevPageLabel' => '<span class="glyphicon glyphicon-chevron-left"></span>',
                            'nextPageLabel' => '<span class="glyphicon glyphicon-chevron-right"></span>',
                        ],
                        'summary' => false,
                        'itemView' => '_images-view',
                ])
                ?>
                </div>
            </div>
        </div>

    </div>
</div>

