<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use common\models\Event;
use common\models\EventAlbum;
use frontend\forms\EventSearch;

class ToeatController extends _UserController {

    public function actionIndex() {
        $searchModel = new EventSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

    public function actionCreate() {
        $model = new Event();

        if (Yii::$app->request->isPost) {
            if ($this->commonCreate($model)) {
                return $this->redirect(Url::to(['index']));
            } else {
                $this->flashError($model);
            }
        }
        return $this->render('create', ['model' => $model, 'album' => '']);
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if ($model->c_user_id == Yii::$app->user->id) {
            if (Yii::$app->request->isPost) {
                if ($this->commonCreate($model)) {
                    return $this->redirect(Url::to(['index']));
                } else {
                    $this->flashError($model);
                }
            }
            $album = EventAlbum::getColumn('c_path', ['c_user_id' => Yii::$app->user->id, 'c_event_id' => $id]);
            return $this->render('update', ['model' => $model, 'album' => implode(',', $album)]);
        } else {
            $this->flashError('无权限操作');
            return $this->redirect(Url::to(['index']));
        }
    }

    public function actionDelete($id) {
        if (Yii::$app->request->isPost) {
            if ($this->commonUpdateField(Event::className(), ['c_status' => Event::STATUS_NO], ['c_id' => $id, 'c_user_id' => Yii::$app->user->id])) {
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
    }

    protected function findModel($id) {
        if (($model = Event::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
