<?php

use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UserFormPerubahanDataKaryawanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Form Perubahan Data Karyawan';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="form-perubahan-data-karyawan-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= Html::a(FAS::icon(FAS::_PLUS_CIRCLE) . ' Ajukan Perubahan', ['create'], [
        'class' => 'btn btn-primary mb-3'
    ]) ?>

    <?php echo yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'layout' =>
            '
                    <div class="d-flex justify-content-start flex-wrap">{items}</div>
                    <div class="d-flex justify-content-end">{pager}</div>
                 ',
        'itemView' => '_item',
        'itemOptions' => [
            'tag' => false
        ],
        'emptyText' => FAS::icon(FAS::_SMILE) . " Anda Belum pernah mengajukan perubahan data. ",
        'emptyTextOptions' => [
            'class' => 'font-weight-light'
        ]
    ]) ?>

</div>