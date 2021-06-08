<?php

namespace app\modules\superadmin\controllers;

use backend\models\search\SessionSearch;
use backend\models\Session;
use rmrevin\yii\fontawesome\FAS;
use Throwable;
use Yii;
use yii\db\StaleObjectException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * SessionController implements the CRUD actions for Session model.
 */
class SessionController extends Controller {
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            [
                'class' => 'yii\filters\AjaxFilter',
                'except' => ['index'],
                // 'only' => ['create','update','view','delete',],
                // 'errorMessage' => "Metode tidak boleh diakses langsung, \n Timeout saat memanggil metode, \n Koneksi Internet Terputus / Lambat"
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                    'bulkdelete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Session models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new SessionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Session model.
     * @param string $id
     * @return mixed
     * @throws HttpException
     */
    public function actionView($id) {
        $request = Yii::$app->request;

        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'title' => "Session #" . $id,
            'content' => $this->renderAjax('view', [
                'model' => $this->findModel($id),
            ]),
            'footer' =>
                Html::button('Close', ['class' => 'btn btn-default mr-auto', 'data-dismiss' => "modal"])
        ];

    }

    /**
     * View Who's Online today.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws HttpException
     */
    public function actionViewOnlineToday() {


        $model = Session::findActiveAtLeast24HoursAgo();
        Yii::$app->response->format = Response::FORMAT_JSON;

        return [
            'title' => "Last 24 Hour",
            'content' => $this->renderAjax('view_online_today', [
                'model' => $model,
            ]),
            'footer' =>

                Html::button('Close', [
                    'class' => 'btn btn-secondary mr-auto',
                    'data-dismiss' => "modal"
                ]) .

                Html::a(FAS::icon(FAS::_TRASH_ALT).' Delete late 24 hours ago', ['session/delete-at-least24-hours-ago'], [
                        'class' => 'btn btn-danger float-right',
                        'role' => 'modal-remote',
                        'title' => 'Delete',
                        'data-confirm' => false,
                        'data-method' => false,// for overide yii data api
                        'data-request-method' => 'post',
                        'data-toggle' => 'tooltip',
                        'data-confirm-title' => 'Are you sure?',
                        'data-confirm-message' => 'Yakin akan menghapus semua data kecuali 24 jam terakhir ?'
                    ]
                )
        ];
    }

    /**
     * Delete an existing Session model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws HttpException
     * @throws NotFoundHttpException
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionDelete($id) {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'forceClose' => true,
            'forceReload' => '#crud-datatable-pjax'
        ];
    }

    /**
     * @return array
     */
    public function actionDeleteAtLeast24HoursAgo() {
        Session::deleteAll('last_write - 86400 < :now', [':now' => time()]);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'forceClose' => true,
            'forceReload' => '#crud-datatable-pjax'
        ];
    }

    /**
     * Delete multiple existing Session model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     * @throws HttpException
     * @throws NotFoundHttpException
     * @throws StaleObjectException
     * @throws Throwable
     */
    public function actionBulkdelete() {
        $request = Yii::$app->request;

        // Array or selected records primary keys
        $pks = explode(',', $request->post('pks'));

        foreach ($pks as $pk) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'forceClose' => true,
            'forceReload' => '#crud-datatable-pjax'
        ];
    }

    /**
     * Finds the Session model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Session the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Session::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
