<?php
use kartik\file\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Forex chart';
$js =<<<JS
$('#html_table').on('fileuploaded', function(event, data, previewId, index) {
    document.location = '/site/index';
});
$('#html_table').on('filebatchuploadcomplete', function(event, data, previewId, index) {
    document.location = '/site/index';
});
JS;
$this->registerJs($js,$this::POS_END);
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
