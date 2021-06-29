<?php


namespace app\modules\superadmin\controllers;


use app\models\MiminAdditionalModel;
use hscstudio\mimin\models\AuthAssignment;
use hscstudio\mimin\models\AuthItem;
use hscstudio\mimin\models\User;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class MiniUserController extends Controller {
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        $searchModel = new \app\models\search\UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionView($id) {
        $model = $this->findModel($id);

        $authAssignments = AuthAssignment::find()->where([
            'user_id' => $model->id,
        ])->column();

        $authItems = ArrayHelper::map(
            AuthItem::find()->where([
                'type' => 1,
            ])->asArray()->all(),
            'name', 'name');

        $authAssignment = new AuthAssignment([
            'user_id' => $model->id,
        ]);

        if (Yii::$app->request->post()) {
            $authAssignment->load(Yii::$app->request->post());

            // delete all role
            AuthAssignment::deleteAll(['user_id' => $model->id]);

            if (is_array($authAssignment->item_name)) {
                foreach ($authAssignment->item_name as $item) {
                    if (!in_array($item, $authAssignments)) {
                        $authAssignment2 = new AuthAssignment([
                            'user_id' => $model->id,
                        ]);
                        $authAssignment2->item_name = $item;
                        $authAssignment2->created_at = time();
                        $authAssignment2->save();

                        $authAssignments = AuthAssignment::find()->where([
                            'user_id' => $model->id,
                        ])->column();
                    }
                }
            }

            Yii::$app->session->setFlash('success', 'Role berhasil di update');
            return $this->redirect(['index']);

        }

        $authAssignment->item_name = $authAssignments;
        return $this->render('view', [
            'model' => $model,
            'authAssignment' => $authAssignment,
            'authItems' => $authItems,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws \yii\base\Exception
     */
    public function actionCreate() {

        $request = Yii::$app->request;
        $model = new User();
        $additionalModel = new MiminAdditionalModel();

        if ($model->load($request->post()) && $additionalModel->load($request->post())) {

            $password = $additionalModel->generate_password ?
                $additionalModel->generate_password : '123456';

            $model->setPassword($password);
            $model->status = $model->status == 1 ? 10 : 0;
            $model->auth_key = Yii::$app->security->generateRandomString();

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'User berhasil dibuat dengan password ' . $password);
            } else {
                Yii::$app->session->setFlash('error', 'User gagal dibuat');
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'additionalModel' => $additionalModel,
            ]);
        }
    }

    /**
     * @return \yii\web\Response
     * @throws \yii\base\Exception
     */
    public function actionBatchCreate() {

        ini_set('max_execution_time', 10000000);
        $connection = User::getDb();
        $q = $connection->createCommand("
            SELECT 
                CONCAT(nomor_induk_karyawan , '-',DATE_FORMAT(tanggal_lahir, '%d%m%Y')) AS username,
                :hash as password_hash,
                10 as status,
                :auth_key as auth_key,
                'user@email.co.id' as email,
                id as karyawan_id,
                UNIX_TIMESTAMP(NOW()) AS created_at,
                UNIX_TIMESTAMP(NOW()) AS updated_at
            FROM karyawan
        ", [
            ':hash' => Yii::$app->security->generatePasswordHash('123456'),
            ':auth_key' => Yii::$app->security->generateRandomString()
        ])->queryAll();

        $transaction = $connection->beginTransaction();
        try {
            $connection->createCommand()
                ->batchInsert('user', [
                    'username',
                    'password_hash',
                    'status',
                    'auth_key',
                    'email',
                    'karyawan_id',
                    'created_at',
                    'updated_at',
                ], $q)
                ->execute();

            //.... other SQL executions
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
        Yii::$app->session->setFlash('success', 'User: ' . count($q));

        return $this->redirect(['/mini-user']);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     * @throws \yii\base\Exception
     */
    public function actionUpdate($id) {

        $model = \app\models\User::findOne($id);
        $additionalModel = new MiminAdditionalModel([
            'karyawan' => $model->karyawan_id
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (!empty($model->new_password)) {
                $model->setPassword($model->new_password);
            }
            $model->status = $model->status == 1 ? 10 : 0;

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'User berhasil diupdate dengan Password : ' . $model->new_password);
            } else {
                Yii::$app->session->setFlash('error', 'User gagal diupdate');
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $model->status = $model->status == 10 ? 1 : 0;
            return $this->render('update', [
                'model' => $model,
                'additionalModel' => $additionalModel,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        $authAssignments = AuthAssignment::find()->where([
            'user_id' => $model->id,
        ])->all();
        foreach ($authAssignments as $authAssignment) {
            $authAssignment->delete();
        }

        Yii::$app->session->setFlash('success', 'Delete success');
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}