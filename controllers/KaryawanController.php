<?php

namespace app\controllers;

use app\models\AlamatKaryawan;
use app\models\form\ReportExportDataUntukMesinAbsensi;
use app\models\Karyawan;
use app\models\KaryawanPtkp;
use app\models\KaryawanStrukturOrganisasi;
use app\models\search\KaryawanSearch;
use app\models\Tabular;
use Exception;
use rmrevin\yii\fontawesome\FAS;
use Throwable;
use Yii;
use yii\base\Model;
use yii\bootstrap4\ActiveForm;
use yii\data\ArrayDataProvider;
use yii\db\StaleObjectException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\VarDumper;
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

        // VALIDASI VIA AJAX
        if ($request->isPost && $request->post('ajax') !== null) {

            $models = Tabular::createMultiple(KaryawanStrukturOrganisasi::class, $models);
            Tabular::loadMultiple($models, $request->post());

            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validateMultiple($models);
        }

        // LULUS VALIDASI AJAX, LAKUKAN VALIDASI DI BACKEND
        if ($request->isPost && $request->post('ajax') == null) {

            // Validasi Manual untuk mengecek jenis jabatan
            $countJenisJabatan = array_count_values(
                array_column($request->post('KaryawanStrukturOrganisasi'), 'jenis_jabatan')
            );

            $errors = [];
            if ((!array_key_exists(KaryawanStrukturOrganisasi::JENIS_JABATAN_UTAMA, $countJenisJabatan))) {
                $errors[] = 'Minimal ada satu jabatan utama yang harus dimiliki seorang karyawan';
            }
            if (array_key_exists(KaryawanStrukturOrganisasi::JENIS_JABATAN_UTAMA, $countJenisJabatan)) {
                if ($countJenisJabatan[KaryawanStrukturOrganisasi::JENIS_JABATAN_UTAMA] > 1) {
                    $errors[] = 'Hanya ada satu jabatan utama yang diperbolehkan seorang karyawan';
                }
            }

            $oldTransactionIds = ArrayHelper::map($models, 'id', 'id');

            $models = Tabular::createMultiple(KaryawanStrukturOrganisasi::class, $models);
            Tabular::loadMultiple($models, $request->post());

            if (empty($errors)) {

                $deletedID = array_filter(array_diff($oldTransactionIds,
                    array_filter(ArrayHelper::map($models, 'id', 'id'))));

                $transaction = Yii::$app->db->beginTransaction();

                try {
                    $flag = true;
                    if (!empty($deletedID)) {
                        $number = KaryawanStrukturOrganisasi::deleteAll(['id' => $deletedID]);
                        if ($number <= 0) {
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
                        Yii::$app->session->setFlash('info', FAS::icon(FAS::_THUMBS_UP) . " Jabatan : " . $model->nama . " berhasil di update. ");
                    } else {
                        $transaction->rollBack();
                    }
                } catch (\yii\db\Exception $e) {
                    $transaction->rollBack();
                }

                return $this->redirect(['karyawan/view', 'id' => $id]);
            }

            // Tampilkan error message, karena ada record yang duplikat
            Yii::$app->session->setFlash('error', "Beberapa rule masih belum sesuai. " .
                Html::ul($errors, ['item' => function ($item, $index) {return Html::tag('li', $item, []);}])
            );
        }

        return $this->render('_form_manage_jabatan', [
            'model' => $model,
            'models' => $models,
        ]);
    }

    /**
     * Manage PTKP karyawan
     * @param $id
     * @param null $page
     * @return array|string|Response
     * @throws NotFoundHttpException
     */
    public function actionManagePtkp($id, $page = null) {

        $request = Yii::$app->request;
        $model = $this->findModel($id);

        $models = empty($model->karyawanPtkps) ?
            [new KaryawanPtkp()] :
            $model->karyawanPtkps;

        if ($request->isPost && $request->post('ajax') !== null) {

            $data = $request->post('KaryawanPtkp', []);
            foreach (array_keys($data) as $index) {
                $models[$index] = new KaryawanPtkp();
            }
            Model::loadMultiple($models, $request->post());
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validateMultiple($models);
        }

        if ($request->isPost && $request->post('ajax') === null) {

            $oldTransactionIds = ArrayHelper::map($models, 'id', 'id');
            $models = Tabular::createMultiple(KaryawanPtkp::class, $models);

            Tabular::loadMultiple($models, $request->post());
            $deletedID = array_filter(array_diff($oldTransactionIds,
                    array_filter(ArrayHelper::map($models, 'id', 'id'))));

            $transaction = Yii::$app->db->beginTransaction();
            try{
                $flag = true;
                if(!empty($deletedID)){
                    $number  = KaryawanPtkp::deleteAll(['id' => $deletedID]);
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
                    Yii::$app->session->setFlash('info', FAS::icon(FAS::_THUMBS_UP) .  " PTKP : " . $model->nama . " berhasil di update. ");

                }else{
                    $transaction->rollBack();
                }
            }catch (\yii\db\Exception $e) {
                $transaction->rollBack();
            }
            return $this->redirect(['karyawan/view', 'id' => $id]);
        }

        return $this->render('_form_manage_ptkp', [
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
     * Form export data untuk mesin kehadiran-di-mesin-absensi,
     * GET  : Form
     * POST : Form + Result
     * @param null $page
     * @return string
     */
    public function actionFindDataUntukMesinAbsensi($page = null) {

        $model = new ReportExportDataUntukMesinAbsensi();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $data = Karyawan::findDataUntukMesinAbsensi($model->statusAktif);
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
     * Export data berupa file excel untuk dimasukkan ke dalam mesin absen
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
                                    'formatCode' => '@'
                                ]
                            ],
                            // 'value' => function($data){
                                // return   preg_replace("/(?![.=$'€%-])\p{P}/u", "", $data['pin']);
                                // return  (int) filter_var($data['pin'], FILTER_SANITIZE_NUMBER_INT);
                                // return implode("", preg_match_all('!\d+!', $data['pin'], $matches));
                            // }
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
                return $exporter->send("Import KehadiranDiMesinAbsensi" . time() . '.xls');
            } catch (NotFoundHttpException $e) {
                $error = $e->getMessage();
            }
        endif;

        throw new HttpException(400, $error);
    }

    /**
     * @param $id
     * @param null $page
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionUploadPhotoIdentintasDiri($id, $page = null) {
        $model = $this->findModel($id);
        return $this->render('_form_upload_foto_identitas_diri', [
            'model' => $model
        ]);
    }


    /**
     * @param null $page
     * @return array|void
     */
    public function actionHandleUploadPhotoIdentintasDiri($page = null) {

        if (empty($_FILES['file_data'])) {
            echo Json::encode(['error', 'No files found for upload']);
            return;
        }
        $files = $_FILES['file_data'];
        $request = Yii::$app->request;
        $filename = 'tresnamuda/sihrd/karyawan/' . $request->post('nik') . '-'. $request->post('nama') . '/' .
            'photo-profile.'. pathinfo($files['name'], PATHINFO_EXTENSION);

        $storage = Yii::$app->spaces;
        $storage->commands()
            ->upload($filename, $files['tmp_name'])
            ->execute();

        $model = $this->findModel($request->post('id'));
        $model->photo_identitas_diri = $storage->getUrl($filename);
        $model->save(false);

        // Return as JSON
        Yii::$app->response->format = Response::FORMAT_JSON;
        return empty($files["error"])
            ? ['success', $files]
            : ['error', 'Error While uploading image, contact the system administrator' . $files["error"]];
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
