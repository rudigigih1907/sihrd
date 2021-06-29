<?php


namespace app\controllers;


use app\models\Karyawan;
use Yii;
use yii\web\Controller;

class ProfileController extends Controller {

    public function actionIndex(){

        if(!Yii::$app->user->identity->karyawan->id){
            Yii::$app->session->setFlash('warning', Yii::$app->user->identity->username . " tidak mempunyai relasi dengan data karyawan");
            return $this->redirect(['site/index']);
        }

        $model = Karyawan::find()->where([
            'id' => Yii::$app->user->identity->karyawan->id
        ])->one();

        return $this->render('index',[
            'model' => $model
        ]);
    }

}