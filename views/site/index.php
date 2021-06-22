<?php

/* @var $this yii\web\View */

use app\widgets\InfoBox;
use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Url;

$this->title = Yii::$app->name;
$isGuest = Yii::$app->user->isGuest;
?>
    <div class="site-index">


        <?php if (!$isGuest) : ?>

            <div class="row mb-4">

                <?= InfoBox::widget([
                    'infoBoxText' => 'Loading ...',
                    'icon' => FAS::_ADDRESS_CARD,
                    'url' => Url::to(['/struktur-organisasi/hitung-jumlah-record', 'type' => app\models\StrukturOrganisasi::TIPE_PERUSAHAAN]),
                    'urlTo' => Url::to(['/struktur-organisasi/index'])
                ]) ?>

                <?= InfoBox::widget([
                    'infoBoxText' => 'Karyawan',
                    'icon' => FAS::_USERS,
                    'url' => Url::to(['/karyawan/hitung-jumlah-record', 'kriteria' => app\models\Karyawan::AKTIF]),
                    'urlTo' => Url::to(['/karyawan/index'])
                ]) ?>

            </div>

            <div class="row">
                <div class="col col-md-6 col-lg-4">
                    <?= \yii\helpers\Html::tag('pre', \yii\helpers\VarDumper::dumpAsString(\app\components\helpers\LiburHelper::statusLiburHariIni())) ?>
                </div>
                <div class="col col-md-6 col-lg-4">

                </div>
            </div>

        <?php else: ?>

            <div class="jumbotron">
                <h1>Welcome!</h1>
                <p class="lead">Kamu harus login dulu untuk masuk ke Sistem HRD.</p>
            </div>

        <?php endif ?>

    </div>
<?php
if (!$isGuest) :
    $group = Url::to(['struktur-organisasi/find-group']);
    $js = <<<JS
    jQuery(document).ready(function(){
        
        jQuery.post('$group', function(response){
            jQuery('.info-box:first .info-box-content .info-box-text').text(response.nama);
        });
        
        jQuery( ".info-box" ).each(function(key, item) {
            let url = jQuery(this).data('url');
            let infoBoxText = jQuery(this).find('.info-box-number');
            
            if(url){
                jQuery.post(url,function(response){
                    infoBoxText.text(response);
                });
            }
        });
    })
JS;
    $this->registerJs($js);
endif;