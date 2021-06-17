<?php

namespace app\controllers;

use app\models\JadwalKerja;
use app\models\JadwalKerjaDetail;
use app\models\search\JadwalKerjaSearch;
use app\models\Tabular;
use Exception;
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
 * JadwalKerjaController implements the CRUD actions for JadwalKerja model.
 */
class JadwalKerjaController extends Controller {
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
     * Lists all JadwalKerja models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new JadwalKerjaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JadwalKerja model.
     * @param integer $id
     * @return mixed
     * @throws HttpException
     */
    public function actionView($id) {

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);

    }

    /**
     * Creates a new JadwalKerja model.
     * @return mixed
     */
    public function actionCreate() {

        $request = Yii::$app->request;
        $model = new JadwalKerja();
        $modelsDetail = [new JadwalKerjaDetail()];

        if ($model->load($request->post())) {

            $modelsDetail = Tabular::createMultiple(JadwalKerjaDetail::class);
            Tabular::loadMultiple($modelsDetail, $request->post());

            //validate models
            $isValid = $model->validate();
            $isValid = Tabular::validateMultiple($modelsDetail) && $isValid;

            if ($isValid) {
                $transaction = JadwalKerja::getDb()->beginTransaction();
                try {

                    if ($flag = $model->save(false)) {
                        foreach ($modelsDetail as $i => $detail) :
                            if ($flag === false) {
                                break;
                            }
                            $detail->jadwal_kerja_id = $model->id;
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
                        JadwalKerja : " . $model->nama . " berhasil ditambahkan. " . Html::a('Klik link berikut jika ingin melihat detailnya', ['view', 'id' => $model->id], ['class' => 'btn btn-link'])
                    );
                    return $this->redirect(['index']);
                }

                Yii::$app->session->setFlash('danger', FAS::icon(FAS::_SAD_CRY) . " JadwalKerja is failed to insert. Info: " . $status['message']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelsDetail' => empty($modelsDetail) ? [new JadwalKerjaDetail()] : $modelsDetail,
        ]);

    }

    /**
     * Updates an existing JadwalKerja model.
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
        $modelsDetail = !empty($model->jadwalKerjaDetails) ? $model->jadwalKerjaDetails : [new JadwalKerjaDetail()];

        if ($model->load($request->post())) {

            $oldDetailsID = ArrayHelper::map($modelsDetail, 'id', 'id'); # GET ALL ID

            $modelsDetail = Tabular::createMultiple(JadwalKerjaDetail::class, $modelsDetail); # Re-create models, Return as array.

            Tabular::loadMultiple($modelsDetail, $request->post()); # Load Post Request into it.
            $deletedDetailsID = array_diff($oldDetailsID, array_filter(ArrayHelper::map($modelsDetail, 'id', 'id'))); # Search ID that will be deleted

            $isValid = $model->validate(); # validate model 1
            $isValid = Tabular::validateMultiple($modelsDetail) && $isValid; # validate multiple model

            if ($isValid) {
                $transaction = JadwalKerja::getDb()->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (!empty($deletedDetailsID)) {
                            JadwalKerjaDetail::deleteAll(['id' => $deletedDetailsID]);
                        }
                        foreach ($modelsDetail as $i => $detail) :
                            if ($flag === false) {
                                break;
                            }
                            $detail->jadwal_kerja_id = $model->id;
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
                            JadwalKerja : " . $model->nama . " berhasil di update. " . Html::a('Klik link berikut jika ingin melihat detailnya', ['view', 'id' => $model->id], ['class' => 'btn btn-link'])
                    );
                    return $this->redirect(['index', 'page' => $page]);
                }

                Yii::$app->session->setFlash('danger', FAS::icon(FAS::_SAD_CRY) . " JadwalKerja is failed to updated. Info: " . $status['message']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelsDetail' => $modelsDetail
        ]);
    }

    /**
     * Delete an existing JadwalKerja model.
     * @param integer $id
     * @return mixed
     * @throws HttpException
     * @throws NotFoundHttpException
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionDelete($id, $page = null) {

        $model = $this->findModel($id);
        $oldLabel = $model->nama;

        $model->delete();

        Yii::$app->session->setFlash('danger', FAS::icon(FAS::_SAD_CRY) . " Jadwal Kerja : " . $oldLabel . " successfully deleted.");
        return $this->redirect(['index', 'page' => $page]);
    }

    /**
     * Clone an existing JadwalKerja model.
     * If update is successful, the browser will be redirected to the 'index' page with pagination URL
     * @param integer $id
     * @param null $page
     * @return mixed
     * @throws HttpException
     * @throws NotFoundHttpException
     */
    public function actionClone($id, $page = null) {

        $request = Yii::$app->request;

        $toBeCloneModel = $this->findModel($id);
        $toBeCloneModelsDetail = !empty($toBeCloneModel->jadwalKerjaDetails)
            ? $toBeCloneModel->jadwalKerjaDetails
            : [new JadwalKerjaDetail()];

        $model = new JadwalKerja();
        $model->isNewRecord = true;

        $modelsDetail = array_map(function ($element) {
            return new JadwalKerjaDetail([
                'attributes' => $element->attributes,
                'isNewRecord' => true
            ]);
        }, $toBeCloneModelsDetail);

        if ($model->load($request->post())) {

            $modelsDetail = Tabular::createMultiple(JadwalKerjaDetail::class);
            Tabular::loadMultiple($modelsDetail, $request->post());

            //validate models
            $isValid = $model->validate();
            $isValid = Tabular::validateMultiple($modelsDetail) && $isValid;

            if ($isValid) {

                $transaction = JadwalKerja::getDb()->beginTransaction();
                try {

                    if ($flag = $model->save(false)) {
                        foreach ($modelsDetail as $i => $detail) :
                            if ($flag === false) {
                                break;
                            }
                            $detail->jadwal_kerja_id = $model->id;
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
                        Jadwal Kerja : " . $toBeCloneModel->nama . " berhasil di clone menjadi " . $model->nama . " " . Html::a('Klik link berikut jika ingin melihat detailnya', ['view', 'id' => $model->id], ['class' => 'btn btn-link'])
                    );
                    return $this->redirect(['index']);
                }

                Yii::$app->session->setFlash('danger', FAS::icon(FAS::_SAD_CRY) . " Jadwal Kerja is failed to insert. Info: " . $status['message']);
            }
        }

        return $this->render('clone', [
            'model' => $model,
            'modelsDetail' => $modelsDetail,
            'toBeCloneModel' => $toBeCloneModel
        ]);
    }

    /**
     * Finds the JadwalKerja model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return JadwalKerja the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = JadwalKerja::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
