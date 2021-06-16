<?php

namespace app\controllers;

use app\components\helper\Tree;
use app\models\form\DiagramStrukturOrganisasi;
use app\models\search\StrukturOrganisasiSearch;
use app\models\StrukturOrganisasi;
use rmrevin\yii\fontawesome\FAS;
use Yii;
use yii\db\StaleObjectException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * StrukturOrganisasiController implements the CRUD actions for StrukturOrganisasi model.
 */
class StrukturOrganisasiController extends Controller {
    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                    'delete-child-from-diagram' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all StrukturOrganisasi models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new StrukturOrganisasiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StrukturOrganisasi model.
     * @param integer $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id)
        ]);
    }

    /**
     * Creates a new StrukturOrganisasi model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new StrukturOrganisasi();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success',
                FAS::icon(FAS::_THUMBS_UP) . "
                StrukturOrganisasi : " . $model->nama . " berhasil ditambahkan. " . Html::a('Klik link berikut jika ingin melihat detailnya', ['view', 'id' => $model->id], ['class' => 'btn btn-link'])
            );
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing StrukturOrganisasi model.
     * If update is successful, the browser will be redirected to the 'index' page with pagination URL
     * @param integer $id
     * @param null $page
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $page = null) {

        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('info',
                FAS::icon(FAS::_THUMBS_UP) . "
                StrukturOrganisasi : " . $model->nama . " berhasil di update. " . Html::a('Klik link berikut jika ingin melihat detailnya', ['view', 'id' => $model->id], ['class' => 'btn btn-link'])
            );
            return $this->redirect(['index', 'page' => $page]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing StrukturOrganisasi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param null $page
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws StaleObjectException
     * @throws \Throwable
     */
    public function actionDelete($id, $page = null) {
        $model = $this->findModel($id);
        $oldLabel = $model->nama;

        $model->delete();

        Yii::$app->session->setFlash('danger', FAS::icon(FAS::_SAD_CRY) . " StrukturOrganisasi : " . $oldLabel . " successfully deleted.");
        return $this->redirect(['index', 'page' => $page]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionGenerateDiagram() {

        $request = Yii::$app->request;
        $model = new DiagramStrukturOrganisasi();

        if ($model->load($request->post()) && $model->validate()) {

            return $this->redirect(
                ['struktur-organisasi/index-diagram', 'parent_id' => $model->parent_id]
            );

        }

        return $this->render('_form_diagram', [
            'model' => $model
        ]);

    }

    /**
     * @param $parent_id
     * @return string
     * @throws \yii\db\Exception
     */
    public function actionIndexDiagram($parent_id) {

        $parent = StrukturOrganisasi::findOne([
            'id' => $parent_id
        ]);

        $nodes = Tree::buildTree(
            StrukturOrganisasi::generateTree($parent_id), $parent->parent_id
        );

        return $this->render("generate_diagram", [
            'nodes' => $nodes,
        ]);
    }

    /**
     * @param $root_id
     * @param $parent_id
     * @return string|\yii\web\Response
     */
    public function actionCreateChildFromDiagram($root_id, $parent_id) {

        $model = new StrukturOrganisasi();
        $parent = StrukturOrganisasi::findOne([
            'id' => $parent_id
        ]);

        $model->parent_id = $parent->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success',
                FAS::icon(FAS::_THUMBS_UP) . "
                StrukturOrganisasi : " . $model->nama . " berhasil ditambahkan. " . Html::a('Klik link berikut jika ingin melihat detailnya', ['view', 'id' => $model->id], ['class' => 'btn btn-link'])
            );

            return $this->redirect(
                ['struktur-organisasi/index-diagram', 'parent_id' => $root_id]
            );
        }

        return $this->render('create_child_from_diagram', [
            'model' => $model,
            'parent' => $parent
        ]);
    }

    /**
     * @param $root_id
     * @param $parent_id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdateChildFromDiagram($root_id, $parent_id) {

        $model = $this->findModel($parent_id);
        $parent = StrukturOrganisasi::findOne([
            'id' => $parent_id
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success',
                FAS::icon(FAS::_THUMBS_UP) . "
                StrukturOrganisasi : " . $model->nama . " berhasil diupdate. " . Html::a('Klik link berikut jika ingin melihat detailnya', ['view', 'id' => $model->id], ['class' => 'btn btn-link'])
            );

            return $this->redirect(['struktur-organisasi/index-diagram', 'parent_id' => $root_id]);
        }

        return $this->render('update_child_from_diagram', [
            'model' => $model,
            'parent' => $parent
        ]);
    }

    /**
     * @param $root_id
     * @param $parent_id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws StaleObjectException
     * @throws \Throwable
     */
    public function actionDeleteChildFromDiagram($root_id, $parent_id) {

        $model = $this->findModel($parent_id);
        $oldLabel = $model->nama;

        $model->delete();

        Yii::$app->session->setFlash('danger', FAS::icon(FAS::_SAD_CRY) . " StrukturOrganisasi : " . $oldLabel . " successfully deleted.");
        return $this->redirect(['struktur-organisasi/index-diagram', 'parent_id' => $root_id]);

    }

    public function actionHitungJumlahRecord($type = null) {
        $data = StrukturOrganisasi::find();

        switch ($type) :
            case StrukturOrganisasi::TIPE_GROUP:
                $data->where([
                    'tipe' => StrukturOrganisasi::TIPE_GROUP
                ]);
                break;
            case StrukturOrganisasi::TIPE_PERUSAHAAN:
                $data->where([
                    'tipe' => StrukturOrganisasi::TIPE_PERUSAHAAN
                ]);
                break;
            default:
                break;
        endswitch;

        $total = $data->asArray()->count();
        return $total . ' ' . $type;
    }

    /**
     * Mencari data Group Perusahaan
     * @return StrukturOrganisasi|array|null
     */
    public function actionFindGroup(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        return StrukturOrganisasi::find()->select('nama')->where([
            'tipe' => StrukturOrganisasi::TIPE_GROUP
        ])->one();
    }

    /**
     * Finds the StrukturOrganisasi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StrukturOrganisasi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = StrukturOrganisasi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
