<?php
use slavkovrn\googlechart\GoogleChartWidget;
$items = [];
foreach ($table as $item){
    $items[date('d.m.Y H:i:s',$item['time'])] = $item['profit'];
}
$data = [
    'Profit' => $items
];
$js =<<<JS
    $('#back').show();
JS;
$this->registerJs($js,$this::POS_END);
?>
<div class="site-index">
    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">
                <a id="back" href="/site/index" class="btn btn-primary" style="display:none">Загрзука файла</a>
                <?= GoogleChartWidget::widget([
                    'id' =>'forex_chart',
                    'title' => 'RoboForex (CY) Ltd.',
                    'style' => 'width:100%',
                    'data' => $data,
                ]) ?>
            </div>

            <div class="col-lg-12">
                <?= $html ?>
            </div>

        </div>

    </div>
</div>
