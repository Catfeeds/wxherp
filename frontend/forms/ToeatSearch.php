<?php

namespace frontend\forms;

use Yii;
use yii\data\ActiveDataProvider;
use common\models\Event;

class ToeatSearch extends Event {

    public $pagesize = 10;
    public $keyword;
    public $status;
    public $type;

    public function rules() {
        return [
            ['keyword', 'filter', 'filter' => 'trim'],
            [['pagesize', 'status', 'type'], 'integer'],
        ];
    }

    public function search($params) {
        $query = Event::find()->where(['c_user_id' => Yii::$app->user->id]);
        $provider_params = [
            'query' => $query,
            'sort' => ['defaultOrder' => [ 'c_id' => SORT_DESC]],
            'pagination' => ['pageSize' => $this->pagesize],
        ];

        if ($this->load($params) && $this->validate()) {
            if ($this->keyword) {
                $query->andWhere([
                    'or',
                    ['like', 'c_sponsor', $this->keyword],
                    ['like', 'c_title', $this->keyword],
                    ['like', 'c_address', $this->keyword]
                ]);
            }

            if ($this->status) {
                $query->andWhere(['c_status' => $this->status]);
            }

            if ($this->type) {
                $query->andWhere(['c_type' => $this->type]);
            }

            $provider_params['pagination']['pageSize'] = $this->pagesize;
            $provider_params['query'] = $query;
        }

        return new ActiveDataProvider($provider_params);
    }

}
