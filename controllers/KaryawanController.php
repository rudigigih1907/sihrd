<?php

namespace app\controllers;

use app\models\AlamatKaryawan;
use app\models\form\ReportExportDataUntukMesinAbsensi;
use app\models\Karyawan;
use app\models\KaryawanStrukturOrganisasi;
use app\models\search\KaryawanSearch;
use app\models\Tabular;
use Exception;
use rmrevin\yii\fontawesome\FAS;
use Throwable;
use Yii;
use yii\bootstrap4\ActiveForm;
use yii\data\ArrayDataProvider;
use yii\db\StaleObjectException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii2tech\spreadsheet\Spreadsheet;

/**
 * KaryawanController implements the CRUD actions for Karyawan model.
 */
class KaryawanController extends Controller {
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
     * Lists all Karyawan models.
     * @return mixed
     */
    public function actionIndex(){
       $searchModel = new KaryawanSearch();
       $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

       return $this->render('index', [
           'searchModel' => $searchModel,
           'dataProvider' => $dataProvider,
       ]);
   }

    /**
     * Displays a single Karyawan model.
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
     * Creates a new Karyawan model.
     * @return mixed
     */
    public function actionCreate(){

        $request = Yii::$app->request;
        $model = new Karyawan();
        $modelsDetail = [ new AlamatKaryawan() ];

        if($model->load($request->post())){

            $modelsDetail = Tabular::createMultiple(AlamatKaryawan::class);
            Tabular::loadMultiple($modelsDetail, $request->post());

            //validate models
            $isValid = $model->validate();
            $isValid = Tabular::validateMultiple($modelsDetail) && $isValid;

            if($isValid){
                $transaction = Karyawan::getDb()->beginTransaction();
                try{

                    if ($flag = $model->save(false)) {
                        foreach ($modelsDetail as $i => $detail) :
                            if ($flag === false) {break;}
                            $detail->karyawan_id = $model->id;
                            if (!($flag = $detail->save(false))) {break;}
                        endforeach;
                    }

                    if ($flag) {
                        $transaction->commit();
                        $status = ['code' => 1,'message' => 'Commit'];
                    } else {
                        $transaction->rollBack();
                        $status = ['code' => 0,'message' => 'Roll Back'];
                    }

                }catch (Exception $e){
                    $transaction->rollBack();
                    $status = ['code' => 0,'message' => 'Roll Back ' . $e->getMessage(),];
                }

                if($status['code']){
                    Yii::$app->session->setFlash('success',
                        FAS::icon(FAS::_THUMBS_UP) .  "
                        Karyawan : " . $model->nama . " berhasil ditambahkan. ". Html::a('Klik link berikut jika ingin melihat detailnya', ['view', 'id' => $model->id], [ 'class' => 'btn btn-link'])
                    );
                    return $this->redirect(['index']);
                }

                Yii::$app->session->setFlash('danger', FAS::icon(FAS::_SAD_CRY) . " Karyawan is failed to insert. Info: ". $status['message']);
            }
        }

        return $this->render( 'create', [
            'model' => $model,
            'modelsDetail' => empty($modelsDetail) ? [ new AlamatKaryawan() ] : $modelsDetail,
        ]);

    }

    /**
     * Updates an existing Karyawan model.
     * If update is successful, the browser will be redirected to the 'index' page with pagination URL
     * @param integer $id
     * @param null $page
     * @return mixed
     * @throws HttpException
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id, $page = null){

        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $modelsDetail = !empty($model->alamatKaryawans) ? $model->alamatKaryawans : [new AlamatKaryawan()];

        if($model->load($request->post())){

            $oldDetailsID = ArrayHelper::map($modelsDetail, 'id', 'id'); # GET ALL ID

            $modelsDetail = Tabular::createMultiple(AlamatKaryawan::class, $modelsDetail); # Re-create models, Return as array.

            Tabular::loadMultiple($modelsDetail, $request->post()); # Load Post Request into it.
            $deletedDetailsID = array_diff($oldDetailsID,array_filter( ArrayHelper::map($modelsDetail, 'id', 'id'))); # Search ID that will be deleted

            $isValid = $model->validate(); # validate model 1
            $isValid = Tabular::validateMultiple($modelsDetail) && $isValid; # validate multiple model

            if($isValid){
                $transaction = Karyawan::getDb()->beginTransaction();
                try{
                    if ($flag = $model->save(false)) {
                        if (!empty($deletedDetailsID)) {
                            AlamatKaryawan::deleteAll(['id' => $deletedDetailsID]);
                        }
                        foreach ($modelsDetail as $i => $detail) :
                            if ($flag === false) {
                                break;
                            }
                            $detail->karyawan_id = $model->id;
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
                        $status = ['code' => 0,'message' => 'Roll Back'];
                    }
                }catch (Exception $e){
                    $transaction->rollBack();
                    $status = ['code' => 0,'message' => 'Roll Back ' . $e->getMessage(),];
                }

                if($status['code']){
                    Yii::$app->session->setFlash('info',
                            FAS::icon(FAS::_THUMBS_UP) .  "
                            Karyawan : " . $model->nama . " berhasil di update. ". Html::a('Klik link berikut jika ingin melihat detailnya', ['view', 'id' => $model->id], [ 'class' => 'btn btn-link'])
                    );
                    return $this->redirect(['index', 'page' => $page]);
                }

                Yii::$app->session->setFlash('danger', FAS::icon(FAS::_SAD_CRY) . " Karyawan is failed to updated. Info: ". $status['message']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelsDetail' => $modelsDetail
        ]);
    }

    /**
     * Delete an existing Karyawan model.
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

        Yii::$app->session->setFlash('danger', FAS::icon(FAS::_SAD_CRY) . " Karyawan : " . $oldLabel . " successfully deleted.");
        return $this->redirect(['index', 'page' => $page]);
    }

    /**
     * Manage Jabatan yang diberikan kepada Karyawan
     * @param $id
     * @param null $page
     * @return array|string|Response
     * @throws NotFoundHttpException
     */
    public function actionManageJabatan($id, $page = null) {

        $request = Yii::$app->request;
        $model = $this->findModel($id);

        $models = empty($model->karyawanStrukturOrganisasis) ?
            [new KaryawanStrukturOrganisasi()] :
            $model->karyawanStrukturOrganisasis;

        if ($request->isPost && $request->post('ajax') !== null) {

            $oldTransactionIds = ArrayHelper::map($models, 'id', 'id');
            $models = Tabular::createMultiple(KaryawanStrukturOrganisasi::class, $models);
            Tabular::loadMultiple($models, $request->post());

            $deletedID = array_filter(array_diff($oldTransactionIds,
                    array_filter(ArrayHelper::map($models, 'id', 'id')))
            );

            if (Tabular::validateMultiple($models)) {

                $transaction = Yii::$app->db->beginTransaction();

                try{
                    $flag = true;
                    if(!empty($deletedID)){
                        $number  = KaryawanStrukturOrganisasi::deleteAll(['id' => $deletedID]);
                        if($number <= 0){
                            $flag = false;
                        }
                    }

                    foreach ($models as $single) {
                        $flag = $single->save(false) && $flag;

                        if ($flag === false) {
                            break;
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                    }else{
                        $transaction->rollBack();
                    }
                }catch (\yii\db\Exception $e) {
                    $transaction->rollBack();
                }

                return $this->redirect(['karyawan/view', 'id' => $id]);
            }

            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validateMultiple($models);
        }

        return $this->render('_form_manage_jabatan', [
            'model' => $model,
            'models' => $models,
        ]);

    }

    /**
     * Menghitung jumlah record berdasarkan konstanta pada class Karyawan
     * @param string $kriteria Karyawan::SEMUA; Karyawan::AKTIF; Karyawan::TIDAK_AKTIF
     * @return string
     */
    public function actionHitungJumlahRecord($kriteria = Karyawan::SEMUA) {
        $data = Karyawan::find();

        switch ($kriteria):


            case Karyawan::TIDAK_AKTIF:
                $data->where([
                    "IS NOT", 'tanggal_berhenti_bekerja', NULL
                ]);
                break;

            case Karyawan::AKTIF:
                $data->where([
                    "IS", 'tanggal_berhenti_bekerja', NULL
                ]);
                break;

            default :
                break;
        endswitch;

        $total = $data->asArray()->count();
        return $total . ' ' . $kriteria;
    }

    /**
     * Form export data untuk mesin absensi,
     * GET  : Form
     * POST : Form + Result
     * @param null $page
     * @return string
     */
    public function actionFindDataUntukMesinAbsensi($page = null) {

        $model = new ReportExportDataUntukMesinAbsensi();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $data = Karyawan::findAllDenganStatusKeaktifannya($model->statusAktif);

            return $this->render('_result_report_export_data_untuk_mesin_absensi', [
                'data' => $data,
                'statusAktif' => $model->statusAktif
            ]);
        }
        return $this->render("_form_report_export_data_untuk_mesin_absensi", [
            'model' => $model,
            'page' => $page
        ]);
    }

    /**
     * @param $statusAktif
     * @return Response
     * @throws HttpException
     */
    public function actionExportDataUntukMesinAbsensiBerupaFileExcel($statusAktif) {
        $data = Karyawan::findDataUntukMesinAbsensi($statusAktif);
        $error = null;
        if ($data):
            try {
                $exporter = new Spreadsheet([
                    'dataProvider' => new ArrayDataProvider([
                        'models' => $data,
                    ]),
                    'columns' => [
                        [
                            'attribute' => 'pin',
                            'label' => 'PIN',
                            'contentOptions' => [
                                'numberFormat' =>[
                                    'formatCode' => '@' // Failed
                                ]
                            ],
                           /* 'value' => function($data){
                                return  (int) filter_var($data['pin'], FILTER_SANITIZE_NUMBER_INT);
                                // return implode("", preg_match_all('!\d+!', $data['pin'], $matches));
                            }*/
                        ],
                        [
                            'attribute' => 'nip',
                            'label' => 'NIP'
                        ],
                        'nama',
                        'alias',
                        [
                            'attribute' => 'nomor_telepon',
                            'label' => 'Nomor Telp'
                        ],
                        'tempat_lahir',
                        'tanggal_lahir',
                        [
                            'attribute' => 'pembagian1',
                            'label' => 'Pembagian 1'
                        ],
                        [
                            'attribute' => 'pembagian2',
                            'label' => 'Pembagian 2'
                        ],
                        [
                            'attribute' => 'pembagian3',
                            'label' => 'Pembagian 3'
                        ],
                        [
                            'attribute' => 'jadwal_kerja',
                            'label' => 'Jadwal'
                        ],
                        'password',
                        [
                            'attribute' => 'rfid',
                            'label' => 'RFID'
                        ],
                        'privilege',
                        [
                            'attribute' => 'tanggal_mulai_bekerja',
                            'label' => 'Tgl Mulai Kerja'
                        ],

                    ],
                ]);
                return $exporter->send("Import Absensi" . time() . '.xls');
            } catch (NotFoundHttpException $e) {
                $error = $e->getMessage();
            }
        endif;

        throw new HttpException(400, $error);
    }


    /**
     * Finds the Karyawan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Karyawan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Karyawan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
