<?php
// _list_item.php
use app\models\FormPerubahanDataKaryawan;
use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;

/* @var $model app\models\FormPerubahanDataKaryawan */

$this->registerCss(".card{width: 18rem; min-height: 18rem; height: 18rem}");
switch ($model->status):

    case FormPerubahanDataKaryawan::STATUS_PENDING:
        $badge = "badge-warning text-light";
        break;
    case FormPerubahanDataKaryawan::STATUS_SEDANG_DIKERJAKAN:
        $badge = "badge-info text-light";
        break;
    case FormPerubahanDataKaryawan::STATUS_SELESAI:
        $badge = "badge-success text-light";
        break;
    default :
        $badge = '';
        break;

endswitch;

?>
<div class="card shadow mr-3 mb-3">

    <div class="card-body">
        <h5 class="card-title text-bold">

            <span><?= $model->nomor_referensi ?> </span>

        </h5>

        <p class="card-text">
            <?php echo $model->judul ?>
        </p>
        <p class="card-text small">
            <?php echo yii\helpers\StringHelper::truncate($model->deskripsi_umum, 200) ?>
            <span class=" small badge <?= $badge ?>"><?php echo $model->status ?></span>
        </p>
    </div>

    <div class="card-footer">
        <div class="d-flex ">
            <div class="flex-grow-1 ">
                <?php echo Html::a(FAS::icon(FAS::_PRINT), ['print-pdf', 'id' => $model->id], [
                    'class' => 'text-success',
                    'target' => '_blank'
                ]) ?>
            </div>
            <div>
                <?php echo Html::a(FAS::icon(FAS::_EYE), ['view', 'id' => $model->id], []) ?>
            </div>
            <div>
                <?php echo Html::a(FAS::icon(FAS::_PEN), ['update', 'id' => $model->id], [
                    'class' => 'ml-3',
                ]) ?>
            </div>
            <div><?php echo Html::a(FAS::icon(FAS::_TRASH), ['delete', 'id' => $model->id], [
                    'class' => 'ml-3 text-danger',
                    'data' => [
                        'confirm' => 'Anda akan menghapus pengajuan ini ?',
                        'method' => 'post'
                    ]
                ]) ?></div>
        </div>
    </div>

</div>