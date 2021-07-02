<?php

namespace app\controllers;

use app\models\FormPerubahanDataKaryawan;
use app\models\FormPerubahanDataKaryawanDetail;
use app\models\search\UserFormPerubahanDataKaryawanSearch;
use app\models\Tabular;
use Exception;
use rmrevin\yii\fontawesome\FAR;
use rmrevin\yii\fontawesome\FAS;
use Throwable;
use Yii;
use yii\db\StaleObjectException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

/**
 * UserFormPerubahanDataKaryawanController implements the CRUD actions for FormPerubahanDataKaryawan model.
 */
class UserFormPerubahanDataKaryawanController extends Controller {
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @param FormPerubahanDataKaryawan $model
     * @return bool
     */
    private function checkApakahSudahDitindakLanjutiOlehAdminSistem(FormPerubahanDataKaryawan $model) {
        return $model->status != FormPerubahanDataKaryawan::STATUS_PENDING;
    }

    /**
     * Lists all FormPerubahanDataKaryawan models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new UserFormPerubahanDataKaryawanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FormPerubahanDataKaryawan model.
     * @param integer $id
     * @param null $page
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionView($id, $page = null) {

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);

    }

    /**
     * Creates a new FormPerubahanDataKaryawan model.
     * @return mixed
     */
    public function actionCreate() {

        $request = Yii::$app->request;
        $model = new FormPerubahanDataKaryawan();
        $modelsDetail = [new FormPerubahanDataKaryawanDetail()];

        if ($model->load($request->post())) {

            $modelsDetail = Tabular::createMultiple(FormPerubahanDataKaryawanDetail::class);
            Tabular::loadMultiple($modelsDetail, $request->post());

            //validate models
            $isValid = $model->validate();
            $isValid = Tabular::validateMultiple($modelsDetail) && $isValid;

            if ($isValid) {
                $transaction = FormPerubahanDataKaryawan::getDb()->beginTransaction();
                try {

                    if ($flag = $model->save(false)) {
                        foreach ($modelsDetail as $i => $detail) :
                            if ($flag === false) {
                                break;
                            }
                            $detail->form_perubahan_data_karyawan_id = $model->id;
                            if (!($flag = $detail->save(false))) {
                                break;
                            }
                        endforeach;
                    }

                    if ($flag) {
                        $transaction->commit();
                        $status = ['code' => 1, 'message' => 'Commit'];
                    } else {
                        $transaction->rollBack();
                        $status = ['code' => 0, 'message' => 'Roll Back'];
                    }

                } catch (Exception $e) {
                    $transaction->rollBack();
                    $status = ['code' => 0, 'message' => 'Roll Back ' . $e->getMessage(),];
                }

                if ($status['code']) {
                    Yii::$app->session->setFlash('success',
                        FAS::icon(FAS::_THUMBS_UP) . "
                        Form Perubahan Data Karyawan : " . $model->judul . " berhasil ditambahkan. " . Html::a('Klik link berikut jika ingin melihat detailnya', ['view', 'id' => $model->id], ['class' => 'btn btn-link'])
                    );
                    return $this->redirect(['index']);
                }

                Yii::$app->session->setFlash('danger', FAS::icon(FAS::_SAD_CRY) . " Form Perubahan Data Karyawan is failed to insert. Info: " . $status['message']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelsDetail' => empty($modelsDetail) ? [new FormPerubahanDataKaryawanDetail()] : $modelsDetail,
        ]);

    }

    /**
     * Updates an existing FormPerubahanDataKaryawan model.
     * If update is successful, the browser will be redirected to the 'index' page with pagination URL
     * @param integer $id
     * @param null $page
     * @return mixed
     * @throws HttpException
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id, $page = null) {

        $request = Yii::$app->request;
        $model = $this->findModel($id);

        if ($this->checkApakahSudahDitindakLanjutiOlehAdminSistem($model)) {
            Yii::$app->session->setFlash('warning',
                FAR::icon(FAR::_GRIN_WINK) . ' Pengajuan sedang diproses oleh Admin Sistem. Data tidak boleh dirubah lagi.');
            return $this->redirect(['index']);
        }

        $modelsDetail = !empty($model->formPerubahanDataKaryawanDetails) ? $model->formPerubahanDataKaryawanDetails : [new FormPerubahanDataKaryawanDetail()];

        if ($model->load($request->post())) {

            $oldDetailsID = ArrayHelper::map($modelsDetail, 'id', 'id'); # GET ALL ID

            $modelsDetail = Tabular::createMultiple(FormPerubahanDataKaryawanDetail::class, $modelsDetail); # Re-create models, Return as array.

            Tabular::loadMultiple($modelsDetail, $request->post()); # Load Post Request into it.
            $deletedDetailsID = array_diff($oldDetailsID, array_filter(ArrayHelper::map($modelsDetail, 'id', 'id'))); # Search ID that will be deleted

            $isValid = $model->validate(); # validate model 1
            $isValid = Tabular::validateMultiple($modelsDetail) && $isValid; # validate multiple model

            if ($isValid) {
                $transaction = FormPerubahanDataKaryawan::getDb()->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (!empty($deletedDetailsID)) {
                            FormPerubahanDataKaryawanDetail::deleteAll(['id' => $deletedDetailsID]);
                        }
                        foreach ($modelsDetail as $i => $detail) :
                            if ($flag === false) {
                                break;
                            }
                            $detail->form_perubahan_data_karyawan_id = $model->id;
                            if (!($flag = $detail->save(false))) {
                                break;
                            }
                        endforeach;
                    }

                    if ($flag) {
                        $transaction->commit();
                        $status = ['code' => 1, 'message' => 'Commit'];
                    } else {
                        $transaction->rollBack();
                        $status = ['code' => 0, 'message' => 'Roll Back'];
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                    $status = ['code' => 0, 'message' => 'Roll Back ' . $e->getMessage(),];
                }

                if ($status['code']) {
                    Yii::$app->session->setFlash('info',
                        FAS::icon(FAS::_THUMBS_UP) . "
                            FormPerubahanDataKaryawan : " . $model->judul . " berhasil di update. " . Html::a('Klik link berikut jika ingin melihat detailnya', ['view', 'id' => $model->id, 'page' => $page], ['class' => 'btn btn-link'])
                    );
                    return $this->redirect(['index', 'page' => $page]);
                }

                Yii::$app->session->setFlash('danger', FAS::icon(FAS::_SAD_CRY) . " FormPerubahanDataKaryawan is failed to updated. Info: " . $status['message']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelsDetail' => $modelsDetail
        ]);
    }

    /**
     * Delete an existing FormPerubahanDataKaryawan model.
     * @param integer $id
     * @param null $page
     * @return mixed
     * @throws NotFoundHttpException
     * @throws StaleObjectException
     * @throws Throwable
     */
    public function actionDelete($id, $page = null) {

        $model = $this->findModel($id);

        if ($this->checkApakahSudahDitindakLanjutiOlehAdminSistem($model)) {
            Yii::$app->session->setFlash('warning',
                FAR::icon(FAR::_GRIN_WINK) . ' Pengajuan sedang diproses oleh Admin Sistem. Data tidak boleh dirubah lagi.');
            return $this->redirect(['index']);
        }

        $oldLabel = $model->judul;
        $model->delete();

        Yii::$app->session->setFlash('danger', FAS::icon(FAS::_SAD_CRY) . " Form Perubahan Data Karyawan : " . $oldLabel . " successfully deleted.");
        return $this->redirect(['index', 'page' => $page]);
    }

    /**
     * @param $id
     * @return string
     * @throws HttpException
     * @throws NotFoundHttpException
     */
    public function actionPrintPdf($id) {

        $model = $this->findModel($id);
        if ($model) {

            $pdf = Yii::$app->pdfDenganHeaderDariAplikasi;
            $pdf->filename = 'Pengajuan ' . $model->nomor_referensi . '.pdf';
            $pdf->content = $this->renderPartial('_pdf', [
                'model' => $model,
            ]);
            return $pdf->render();
        }
        throw new HttpException(400, 'Data Is Not Found ... !!!');
    }

    /**
     * Finds the FormPerubahanDataKaryawan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FormPerubahanDataKaryawan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = FormPerubahanDataKaryawan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
