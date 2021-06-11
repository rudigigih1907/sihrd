<?php


namespace app\traits;


use app\models\User;
use Yii;
use yii\web\Response;

trait TraitFindUser {
    /**
     * @param null $q
     * @param null $id
     * @return array
     */
    public function actionFindUser($q = null, $id = null) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $data = User::find()
                ->select([
                    'id' => 'user.id',
                    'text' => 'user.username'
                ])
                ->where(['like', 'username', $q])
                ->orderBy('username')
                ->limit(100)
                ->asArray()
                ->all();

            $out['results'] = array_values($data);
        } elseif ($id > 0) {
            $out['results'] = [
                'id' => $id,
                'text' => User::find($id)->username
            ];
        }
        return $out;
    }
}