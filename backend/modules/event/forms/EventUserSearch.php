<?php

namespace backend\modules\event\forms;

use yii\data\ActiveDataProvider;
use common\models\EventUser;

class EventUserSearch extends EventUser {

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
        $query = EventUser::find()->with(['event']);
        if (isset($params['event_id'])) {
            $query->andWhere(['c_event_id' => (int) $params['event_id']]);
        }

        $provider_params = [
            'query' => $query,
            'sort' => ['defaultOrder' => ['c_id' => SORT_DESC]],
            'pagination' => ['pageSize' => $this->pagesize],
        ];

        if ($this->load($params) && $this->validate()) {
            if ($this->keyword) {
                $query->andWhere([
                    'or',
                    ['like', 'c_user_name', $this->keyword],
                    ['like', 'c_mobile', $this->keyword]
                ]);
            }

            if ($this->status) {
                $query->andWhere(['c_status' => $this->status]);
            }

            $provider_params['pagination']['pageSize'] = $this->pagesize;
            $provider_params['query'] = $query;
        }

        return new ActiveDataProvider($provider_params);
    }

}