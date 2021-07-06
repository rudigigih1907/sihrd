<?php

/* @var $this yii\web\View */

use app\components\helpers\LiburHelper;
use app\widgets\InfoBox;
use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\VarDumper;

$this->title = Yii::$app->name;
$isGuest = Yii::$app->user->isGuest;
?>
    <div class="site-index">


        <?php if (!$isGuest) : ?>


            <?php
                $user= Yii::$app->user;
                if (
                        $user->can('super-admin') ||
                        $user->can('manager') ||
                        $user->can('staff') ||
                        $user->can('direksi')
                ): ?>
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

                <?php else: ?>
                    <div class="jumbotron shadow">
                        <h1>Selamat Datang!</h1>
                        <p class="lead">Pastikan biodata Anda sudah sesuai, Akses pada menu <span
                                    class="font-weight-bold"> Data Pribadi >> Profile Anda </span></p>

                    </div>
                <?php endif; ?>


            <div class="row">
                <div class="col col-md-6 col-lg-4">
                    <?php Html::tag('pre', VarDumper::dumpAsString(LiburHelper::statusLiburHariIni())) ?>
                </div>
                <div class="col col-md-6 col-lg-4">

                </div>
            </div>

        <?php else: ?>

            <div class="jumbotron shadow">
                <h1>Selamat Datang!</h1>
                <p class="lead">Kamu harus login dulu untuk masuk ke Sistem HRD.</p>
                <p>
                    <?= Html::a(FAS::icon(FAS::_SIGN_IN_ALT) . " Login", ['site/login'], [
                        'class' => 'btn btn-lg btn-primary'
                    ]) ?>
                </p>
            </div>

        <?php endif ?>

    </div>

<?php
Modal::begin([
    'id' => 'modal-warning',
    'title' => FAS::icon(FAS::_BULLHORN) . ' Pesan Peringatan Dari Sistem',
    'titleOptions' => [
      'class' => 'text-danger'
    ],
    'footer' =>
        Html::a(FAS::icon(FAS::_LINK) .' Ganti Password', ['site/change-password'], [
            'class' => 'btn btn-primary'
        ])
]);

echo Html::tag('p',
    "Password Masih Default 123456.<br/>Mohon Diganti, Supaya Data Kamu tetap aman.");


Modal::end();
?>

<?php
if (!$isGuest && Yii::$app->user->can('super-admin')) :

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


$defaultPassword = Yii::$app->session->get('_defaultPassword');
$js2 = <<<JS
jQuery(document).ready(function(){
    
    if(parseInt("$defaultPassword") === 1){
        jQuery('#modal-warning').modal('show');
    }
    
});
JS;
$this->registerJs($js2);
