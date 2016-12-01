<?php
use yii\helpers\Html;
/**
 * Payment success redirect view file
 */
?>
<h1 class="text-center">Download zip file</h1>
<div class = "row">
    <div class = "col-md-offset-5 col-md-2">

        <?=Html::a('Download file', ['/user/files/download', 'filename' => 'testfile.zip'], ['class' => 'btn btn-primary'])?>

    </div>
</div>

