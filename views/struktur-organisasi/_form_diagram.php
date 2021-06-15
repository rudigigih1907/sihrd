<?php


/* @var $this View */
/* @var $model DiagramStrukturOrganisasi */

use app\models\form\DiagramStrukturOrganisasi;
use app\models\StrukturOrganisasi;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;
use yii\web\View;

$this->title = 'Generate Diagram Struktur Organisasi';
$this->params['breadcrumbs'][] = ['label' => 'Struktur Organisasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>

<div class="struktur-organisasi-form">
    <div class="card shadow">

        <?php $form = ActiveForm::begin([
            'type' => ActiveForm::TYPE_HORIZONTAL,
            'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
        ]); ?>


        <div class="card-body">
            <?= $form->field($model, 'parent_id')
                ->textInput([
                    'autofocus' => 'autofocus'
                ])->widget(Select2::class, [
                    'data' => StrukturOrganisasi::mapIDToNamaDenganKode()
                ])
            ->hint("Pilih Parent / Node Yang Paling Atas")
            ?>
        </div>


        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <?= Html::a(FAS::icon(FAS::_WINDOW_CLOSE) . ' Tutup', ['index'], ['class' => 'btn btn-secondary']) ?>
                <?= Html::submitButton(FAS::icon(FAS::_SEARCH) . ' Cari', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
