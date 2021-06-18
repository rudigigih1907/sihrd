<?php

namespace app\controllers;

use Yii;
use app\models\JadwalKerja;

use app\models\search\JadwalKerjaSearch;

use app\models\JadwalKerjaDetail;

use app\models\JadwalKerjaDetailDetail;

use app\models\Tabular;

use Throwable;
use yii\base\InvalidConfigException;
use yii\db\StaleObjectException;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use rmrevin\yii\fontawesome\FAS;

/**
 * JadwalKerjaController implements the CRUD actions for JadwalKerja model.
 */
class JadwalKerjaController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
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
    public function actionIndex()
    {
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
    public function actionView($id){
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new JadwalKerja model.
     * @return mixed
     * @throws HttpException
     * @throws InvalidConfigException
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new JadwalKerja();
        $modelsDetail = [ new JadwalKerjaDetail() ];
        $modelsDetailDetail =[[new JadwalKerjaDetailDetail()]];

        if($model->load($request->post())){

            $modelsDetail = Tabular::createMultiple(JadwalKerjaDetail::class);
            Tabular::loadMultiple($modelsDetail, $request->post());

            //validate models
            $isValid = $model->validate();
            $isValid = Tabular::validateMultiple($modelsDetail) && $isValid;

            if (isset($_POST['JadwalKerjaDetailDetail'][0][0])) {
                foreach ($_POST['JadwalKerjaDetailDetail'] as $i => $jadwalKerjaDetailDetails) {
                    foreach ($jadwalKerjaDetailDetails as $j => $jadwalKerjaDetailDetail) {
                        $data['JadwalKerjaDetailDetail'] = $jadwalKerjaDetailDetail;
                        $modelJadwalKerjaDetailDetail = new JadwalKerjaDetailDetail();
                        $modelJadwalKerjaDetailDetail->load($data);
                        $modelsDetailDetail[$i][$j] = $modelJadwalKerjaDetailDetail;
                        $isValid = $modelJadwalKerjaDetailDetail->validate() && $isValid;
                    }
                }
            }

            if($isValid){

                $transaction = JadwalKerja::getDb()->beginTransaction();

                try{
                    $status = [];
                    if ($flag = $model->save(false)) {
                        foreach ($modelsDetail as $i => $detail) :

                            if ($flag === false) {
                                break;
                            }

                            $detail->jadwal_kerja_id = $model->id;
                            if (!($flag = $detail->save(false))) {
                                break;
                            }

                            if (isset($modelsDetailDetail[$i]) && is_array($modelsDetailDetail[$i])) {
                                foreach ($modelsDetailDetail[$i] as $j => $modelDetailDetail) {
                                    $modelDetailDetail->jadwal_kerja_detail_id = $detail->id;
                                    if (!($flag = $modelDetailDetail->save(false))) {
                                        break;
                                    }
                                }
                            }

                        endforeach;
                    }

                    if ($flag) {
                        $transaction->commit();
                        $status = [
                            'code' => 1,
                            'message' => 'Commit'
                        ];
                    } else {
                        $transaction->rollBack();
                        $status = [
                            'code' => 0,
                            'message' => 'Roll Back'
                        ];
                    }
                }catch (\Exception $e){
                    $transaction->rollBack();
                    $status = [
                        'code' => 0,
                        'message' => 'Roll Back ' . $e->getMessage(),
                    ];
                }

                if($status['code']){
                    Yii::$app->session->setFlash('success',
                        FAS::icon(FAS::_THUMBS_UP) .  "
                        JadwalKerja : " . $model->nama . " berhasil ditambahkan. ". Html::a('Klik link berikut jika ingin melihat detailnya', ['view', 'id' => $model->id], [ 'class' => 'btn btn-link'])
                    );
                    return $this->redirect(['index']);
                }

                Yii::$app->session->setFlash('danger', FAS::icon(FAS::_SAD_CRY) . " JadwalKerja is failed to insert. Info: ". $status['message']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelsDetail' => empty($modelsDetail) ? [ new JadwalKerjaDetail() ] : $modelsDetail,
            'modelsDetailDetail' => empty($modelsDetailDetail) ? [[new JadwalKerjaDetailDetail()]] : $modelsDetailDetail,
        ]);
    }

    /**
     * Updates an existing JadwalKerja model.
     * Only for ajax request will return json object
     * @param integer $id
     * @param null $page
     * @return mixed
     * @throws HttpException
     * @throws NotFoundHttpException
     * @throws InvalidConfigException
     */
    public function actionUpdate($id, $page = null){
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $modelsDetail = !empty($model->jadwalKerjaDetails) ?
            $model->jadwalKerjaDetails :
            [new JadwalKerjaDetail()];

        $modelsDetailDetail =[];
        $oldDetailDetails = [];

        if (!empty($modelsDetail)) {

            foreach ($modelsDetail as $i => $modelDetail) {
                $jadwalKerjaDetailDetails = $modelDetail->jadwalKerjaDetailDetails;
                $modelsDetailDetail[$i] = $jadwalKerjaDetailDetails;
                $oldDetailDetails = ArrayHelper::merge(ArrayHelper::index($jadwalKerjaDetailDetails, 'id'), $oldDetailDetails);
            }
        }

        if($model->load($request->post())){

            // reset
            $modelsDetailDetail = [];

            // GET OLD IDs
            $oldDetailsID = ArrayHelper::map($modelsDetail, 'id', 'id');

            $modelsDetail=Tabular::createMultiple(JadwalKerjaDetail::class, $modelsDetail);
            Tabular::loadMultiple($modelsDetail, $request->post());

            $deletedDetailsID = array_diff($oldDetailsID,array_filter(
                    ArrayHelper::map($modelsDetail, 'id', 'id')
                )
            );

            //validate models
            $isValid = $model->validate();
            $isValid = Tabular::validateMultiple($modelsDetail) && $isValid;


            $detailDetailIDs = [];
            if (isset($_POST['JadwalKerjaDetailDetail'][0][0])) {
                foreach ($_POST['JadwalKerjaDetailDetail'] as $i => $jadwalKerjaDetailDetails) {

                    $detailDetailIDs = ArrayHelper::merge($detailDetailIDs, array_filter(ArrayHelper::getColumn($jadwalKerjaDetailDetails, 'id')));

                    foreach ($jadwalKerjaDetailDetails as $j => $jadwalKerjaDetailDetail) {
                        $data['JadwalKerjaDetailDetail'] = $jadwalKerjaDetailDetail;

                        // Difference with actionCreate Here
                        $modelJadwalKerjaDetailDetail =
                            (isset($jadwalKerjaDetailDetail['id']) && isset($oldDetailDetails[$jadwalKerjaDetailDetail['id']]))
                            ? $oldDetailDetails[$jadwalKerjaDetailDetail['id']]
                            : new JadwalKerjaDetailDetail();

                        $modelJadwalKerjaDetailDetail->load($data);
                        $modelsDetailDetail[$i][$j] = $modelJadwalKerjaDetailDetail;
                        $isValid = $modelJadwalKerjaDetailDetail->validate() && $isValid;
                    }
                }
            }


            $oldDetailDetailsIDs = ArrayHelper::getColumn($oldDetailDetails, 'id');
            $deletedDetailDetailsIDs = array_diff($oldDetailDetailsIDs, $detailDetailIDs);

            if($isValid){

                $transaction = JadwalKerja::getDb()->beginTransaction();

                try{

                    if ($flag = $model->save(false)) {

                        if (!empty($deletedDetailDetailsIDs)) {
                            JadwalKerjaDetailDetail::deleteAll(['id' => $deletedDetailDetailsIDs]);
                        }

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

                            if (isset($modelsDetailDetail[$i]) && is_array($modelsDetailDetail[$i])) {
                                foreach ($modelsDetailDetail[$i] as $j => $modelDetailDetail) {
                                    $modelDetailDetail->jadwal_kerja_detail_id = $detail->id;
                                    if (!($flag = $modelDetailDetail->save(false))) {
                                        break;
                                    }
                                }
                            }

                        endforeach;
                    }

                    if ($flag) {
                        $transaction->commit();
                        $status = [
                            'code' => 1,
                            'message' => 'Commit'
                        ];
                    } else {
                        $transaction->rollBack();
                        $status = [
                            'code' => 0,
                            'message' => 'Roll Back'
                        ];
                    }
                }catch (\Exception $e){
                    $transaction->rollBack();
                    $status = [
                        'code' => 0,
                        'message' => 'Roll Back ' . $e->getMessage(),
                    ];
                }

                if($status['code']){
                    Yii::$app->session->setFlash('success',
                        FAS::icon(FAS::_THUMBS_UP) .  "
                        JadwalKerja : " . $model->nama . " berhasil di update. ". Html::a('Klik link berikut jika ingin melihat detailnya', ['view', 'id' => $model->id, 'page' => $page], [ 'class' => 'btn btn-link'])
                    );
                    return $this->redirect(['index']);
                }

                Yii::$app->session->setFlash('danger', FAS::icon(FAS::_SAD_CRY) . " JadwalKerja is failed to insert. Info: ". $status['message']);
            }else{
                return $this->render('update', [
                    'model' => $model,
                    'modelsDetail' => $modelsDetail,
                    'modelsDetailDetail' => $modelsDetailDetail,
                ]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelsDetail' => $modelsDetail,
            'modelsDetailDetail' => $modelsDetailDetail,
        ]);
    }

    /**
     * Delete an existing JadwalKerja model.
     * Only for ajax request will return json object
     * @param integer $id
     * @return mixed
     * @throws HttpException
     * @throws NotFoundHttpException
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionDelete($id, $page = null){
        $model = $this->findModel($id);
        $oldLabel =  $model->nama;

        $model->delete();

        Yii::$app->session->setFlash('danger', FAS::icon(FAS::_SAD_CRY) . " JadwalKerja : " . $oldLabel. " successfully deleted.");
        return $this->redirect(['index', 'page' => $page]);
    }

    public function actionClone($id, $page = null) {

        $request = Yii::$app->request;

        $toBeCloneModel = $this->findModel($id);
        $toBeCloneModelsDetail = !empty($toBeCloneModel->jadwalKerjaDetails) ?
            $toBeCloneModel->jadwalKerjaDetails :
            [new JadwalKerjaDetail()];

        $modelsDetailDetail = [];
        $oldDetailDetails = [];

        if (!empty($toBeCloneModelsDetail)) {
            foreach ($toBeCloneModelsDetail as $i => $toBeCloneModelDetail) {
                $jadwalKerjaDetailDetails = array_map(function($element){
                    return new JadwalKerjaDetailDetail([
                        'attributes' => $element->attributes,
                        'isNewRecord' => true
                    ]);
                }, $toBeCloneModelDetail->jadwalKerjaDetailDetails);
                $modelsDetailDetail[$i] = $jadwalKerjaDetailDetails;
                $oldDetailDetails = ArrayHelper::merge(ArrayHelper::index($jadwalKerjaDetailDetails, 'id'), $oldDetailDetails);
            }
        }


        $model = new JadwalKerja([
            'nama' => null,
            'mulai_tanggal' => $toBeCloneModel->mulai_tanggal,
            'status' => $toBeCloneModel->status,
            'keterangan' => "Clone"
        ]);
         $model->isNewRecord = true;

        $modelsDetail = array_map(function($element){
            return new JadwalKerjaDetail([
                'jadwal_kerja_hari_id' => $element->jadwal_kerja_hari_id,
                'libur' => $element->libur,
                'isNewRecord' => true,
            ]);
        }, $toBeCloneModelsDetail);

        if($model->load($request->post())){

            $modelsDetail = Tabular::createMultiple(JadwalKerjaDetail::class);
            Tabular::loadMultiple($modelsDetail, $request->post());

            //validate models
            $isValid = $model->validate();
            $isValid = Tabular::validateMultiple($modelsDetail) && $isValid;

            if (isset($_POST['JadwalKerjaDetailDetail'][0][0])) {
                foreach ($_POST['JadwalKerjaDetailDetail'] as $i => $jadwalKerjaDetailDetails) {
                    foreach ($jadwalKerjaDetailDetails as $j => $jadwalKerjaDetailDetail) {
                        $data['JadwalKerjaDetailDetail'] = $jadwalKerjaDetailDetail;
                        $modelJadwalKerjaDetailDetail = new JadwalKerjaDetailDetail();
                        $modelJadwalKerjaDetailDetail->load($data);
                        $modelsDetailDetail[$i][$j] = $modelJadwalKerjaDetailDetail;
                        $isValid = $modelJadwalKerjaDetailDetail->validate() && $isValid;
                    }
                }
            }

            if($isValid){

                $transaction = JadwalKerja::getDb()->beginTransaction();

                try{
                    $status = [];
                    if ($flag = $model->save(false)) {
                        foreach ($modelsDetail as $i => $detail) :

                            if ($flag === false) {
                                break;
                            }

                            $detail->jadwal_kerja_id = $model->id;
                            if (!($flag = $detail->save(false))) {
                                break;
                            }

                            if (isset($modelsDetailDetail[$i]) && is_array($modelsDetailDetail[$i])) {
                                foreach ($modelsDetailDetail[$i] as $j => $modelDetailDetail) {
                                    $modelDetailDetail->jadwal_kerja_detail_id = $detail->id;
                                    if (!($flag = $modelDetailDetail->save(false))) {
                                        break;
                                    }
                                }
                            }

                        endforeach;
                    }

                    if ($flag) {
                        $transaction->commit();
                        $status = [
                            'code' => 1,
                            'message' => 'Commit'
                        ];
                    } else {
                        $transaction->rollBack();
                        $status = [
                            'code' => 0,
                            'message' => 'Roll Back'
                        ];
                    }
                }catch (\Exception $e){
                    $transaction->rollBack();
                    $status = [
                        'code' => 0,
                        'message' => 'Roll Back ' . $e->getMessage(),
                    ];
                }

                if($status['code']){
                    Yii::$app->session->setFlash('success',
                        FAS::icon(FAS::_THUMBS_UP) .  "
                        JadwalKerja : " . $model->nama . " hasil dari clone ". $toBeCloneModel->nama. "  berhasil dibuat. ". Html::a('Klik link berikut jika ingin melihat detailnya', ['view', 'id' => $model->id , 'page' => $page], [ 'class' => 'btn btn-link'])
                    );
                    return $this->redirect(['index']);
                }

                Yii::$app->session->setFlash('danger', FAS::icon(FAS::_SAD_CRY) . " JadwalKerja is failed to insert. Info: ". $status['message']);
            }
        }


        return $this->render('clone', [
            'model' => $model,
            'modelsDetail' => $modelsDetail,
            'modelsDetailDetail' => $modelsDetailDetail,
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
    protected function findModel($id){
        if (($model = JadwalKerja::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
