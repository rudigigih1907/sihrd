<?php

use app\widgets\Table;
use mdm\admin\components\Helper;
use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap4\Tabs;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FormPerubahanDataKaryawan */

$this->title = $model->judul;
$this->params['breadcrumbs'][] = ['label' => 'Form Perubahan Data Karyawans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-perubahan-data-karyawan-view">

    <div class="card shadow">
        <div class="card-header p-3">
            <div class="d-flex justify-content-start">

                <div class="mr-auto">
                    <?= Html::a(FAS::icon(FAS::_ARROW_LEFT). ' Kembali', Yii::$app->request->referrer, ['class' => 'btn btn-secondary']) ?>
                </div>

                <div class="mx-1">
                    <?= Html::a(FAS::icon(FAS::_PLUS). ' Buat Lagi', ['create'], ['class' => 'btn btn-primary']) ?>
                </div>

                <div class="mr-1">
                    <?= Html::a(FAS::icon(FAS::_LIST). ' Index', ['index'], ['class' => 'btn btn-primary']) ?>
                </div>

                <div class="mr-1">
                    <?= Html::a(FAS::icon(FAS::_PEN). ' Update', ['update', 'id' => $model->id, 'page' => Yii::$app->request->getQueryParam('page', null)], ['class' => 'btn btn-primary']) ?>
                </div>

                <?php                 if(Helper::checkRoute('delete')) :
                echo Html::a(FAS::icon(FAS::_TRASH). ' Hapus', ['delete', 'id' => $model->id, 'page' => Yii::$app->request->getQueryParam('page', null)], [
                'class' => 'btn btn-danger',
                'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
                ],
                ]);
                endif;
                ?>
            </div>
        </div>

            

    <?php try { echo Tabs::widget([
                'encodeLabels' => false,
                'navType' => 'nav-tabs justify-content-start border-0',
                'tabContentOptions' => [
                    'class' => 'p-0'
                ],
                'items' => [
                    [
                        'active' => true,
                        'headerOptions' => [
                            'class' => 'pl-3'
                        ],
                        'label' => FAS::icon(FAS::_YIN_YANG) . ' Pengajuan',
                        'content' =>
                            DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                    'judul',
                                    'deskripsi_umum:ntext',
                                    'status',
                                    'aksi_yang_dilakukan:ntext',
                                ],
                            ]),

                    ],
                    [
                        'label' => 'Detail Pengajuan',
                        'content' =>

                            !empty($model->formPerubahanDataKaryawanDetails) ?
                                Table::widget([
                                    'data' => $model->formPerubahanDataKaryawanDetails,
                                    'skippedColumns' => [
                                        'form_perubahan_data_karyawan_id'
                                    ]
                                ])
                                :

                                Html::tag("p", 'Form Perubahan Data Karyawan Detail tidak tersedia', [
                                    'class' => 'text-warning font-weight-bold p-3'
                                ])
                            ,
                        ],
                    ],
                ]);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
    ?>

    </div>
</div>