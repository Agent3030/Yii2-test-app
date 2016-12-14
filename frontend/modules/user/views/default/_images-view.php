<?php
use yii\helpers\Html;
?>


<div class="col-md-4">
    <div class="thumbnail">
        <img src="<?=Html::encode($model->getImage())?>" alt="Image" class ="img img-responsive">
        <div class="caption">
            <div class="row text-center">
                <h4>Image #: <?=' '.Html::encode($model->id)?></h4>

                <div class="col-md-6 text-right">
                    <?=Html::a('Rotate left', ['/user/default/rotate-left', 'id' => $model->id],['class'=>'btn btn-primary'])?>
                </div>
                <div class="col-md-6 text-left">
                    <?=Html::a('Rotate right', ['/user/default/rotate-right', 'id' => $model->id],['class'=>'btn btn-primary'])?>
                </div>
            </div>
            <div class="row">

                <div class="col-md-12 text-center">
                    </br>
                    <?=Html::a('Delete', ['/user/default/delete', 'id' => $model->id],['class'=>'btn btn-danger'])?>
                </div>
            </div>



        </div>
    </div>
</div>

