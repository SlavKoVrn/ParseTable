<?php
use kartik\file\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Forex chart';
?>
<div class="site-index">
    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">
                <?= FileInput::widget([
                    'name' => 'html_table',
                    'options' => [
                        'id' => 'html_table',
                        'multiple' => false,
                    ],
                    'pluginOptions' => [
                        'uploadUrl'=>Url::to('/site/upload'),
                        'browseOnZoneClick'=>true,
                        'uploadAsync'=> false,
                        'allowedFileExtensions'=>['html','htm']
                    ],
                ]) ?>
            </div>
            <div class="col-lg-12">
                <h1>Не забудьте нажать кнопку "Загрузить"</h1>
            </div>
        </div>

    </div>
</div>
